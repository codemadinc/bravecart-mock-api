#!/bin/bash
# BraveCart Mock API — Endpoint Test Suite
# Usage: bash test-endpoints.sh [BASE_URL]

BASE="${1:-http://localhost:8080}"
STORE=1
PASS=0
FAIL=0
CART_TOKEN=""

green() { echo -e "\033[32m✓ $1\033[0m"; PASS=$((PASS+1)); }
red() { echo -e "\033[31m✗ $1\033[0m"; FAIL=$((FAIL+1)); }

test_endpoint() {
    local method="$1"
    local url="$2"
    local label="$3"
    local data="$4"
    local expected_status="${5:-200}"

    if [ "$method" = "GET" ]; then
        HTTP_CODE=$(curl -s -o /tmp/api-response.json -w "%{http_code}" "$url")
    else
        HTTP_CODE=$(curl -s -o /tmp/api-response.json -w "%{http_code}" -X "$method" -H "Content-Type: application/json" -d "$data" "$url")
    fi

    if [ "$HTTP_CODE" = "$expected_status" ]; then
        green "$label (HTTP $HTTP_CODE)"
    else
        red "$label (expected $expected_status, got $HTTP_CODE)"
        cat /tmp/api-response.json | head -5
    fi
}

echo "═══════════════════════════════════════════════════"
echo "  BraveCart Mock API — Endpoint Tests"
echo "  Base URL: $BASE"
echo "═══════════════════════════════════════════════════"
echo ""

# ─── Health ───────────────────────────────────────────
echo "── Health Check ──"
test_endpoint GET "$BASE/api/health" "Health check"

# ─── Store Config ─────────────────────────────────────
echo ""
echo "── Store Config (Internal) ──"
test_endpoint POST "$BASE/api/internal/store-config" "Domain detection" '{"host":"localhost"}'

# ─── Layout ───────────────────────────────────────────
echo ""
echo "── Layout ──"
test_endpoint GET "$BASE/api/stores/$STORE/layout" "Layout (shop + menus)"

# ─── Products ─────────────────────────────────────────
echo ""
echo "── Products ──"
test_endpoint GET "$BASE/api/stores/$STORE/products" "Product listing"
test_endpoint GET "$BASE/api/stores/$STORE/products?query=oxford" "Product search"
test_endpoint GET "$BASE/api/stores/$STORE/products?sortKey=PRICE&reverse=true" "Products sorted by price desc"
test_endpoint GET "$BASE/api/stores/$STORE/products/classic-oxford-shirt" "Product detail"
test_endpoint GET "$BASE/api/stores/$STORE/products/classic-oxford-shirt/variants" "Product variants"
test_endpoint POST "$BASE/api/stores/$STORE/products/recommended" "Recommended products" '{"productId":"gid://bravecart/Product/1","count":4}'

# ─── Collections ──────────────────────────────────────
echo ""
echo "── Collections ──"
test_endpoint GET "$BASE/api/stores/$STORE/collections" "All collections"
test_endpoint GET "$BASE/api/stores/$STORE/collections/new-arrivals" "Collection detail"
test_endpoint GET "$BASE/api/stores/$STORE/collections/bestsellers?sortKey=PRICE" "Collection sorted"
test_endpoint GET "$BASE/api/stores/$STORE/collections/new-arrivals/product-count" "Collection product count"

# ─── Cart (functional) ────────────────────────────────
echo ""
echo "── Cart ──"

# Create cart
HTTP_CODE=$(curl -s -o /tmp/api-response.json -w "%{http_code}" -X POST -H "Content-Type: application/json" \
    -d '{"lines":[{"merchandiseId":"gid://bravecart/ProductVariant/1","quantity":2}]}' \
    "$BASE/api/stores/$STORE/cart/create")
CART_TOKEN=$(python3 -c "import json; print(json.load(open('/tmp/api-response.json'))['cart']['token'])" 2>/dev/null)

if [ "$HTTP_CODE" = "201" ] && [ -n "$CART_TOKEN" ]; then
    green "Create cart (HTTP $HTTP_CODE, token=$CART_TOKEN)"
else
    red "Create cart (HTTP $HTTP_CODE)"
fi

# Get cart
test_endpoint GET "$BASE/api/stores/$STORE/cart/$CART_TOKEN" "Get cart"

# Add to cart
test_endpoint POST "$BASE/api/stores/$STORE/cart/$CART_TOKEN/add" "Add to cart" '{"lines":[{"merchandiseId":"gid://bravecart/ProductVariant/5","quantity":1}]}'

# Get cart again to check totals
curl -s "$BASE/api/stores/$STORE/cart/$CART_TOKEN" -o /tmp/api-response.json
TOTAL_QTY=$(python3 -c "import json; print(json.load(open('/tmp/api-response.json'))['cart']['totalQuantity'])" 2>/dev/null)
if [ "$TOTAL_QTY" = "3" ]; then
    green "Cart has 3 items after add"
else
    red "Cart quantity mismatch (expected 3, got $TOTAL_QTY)"
fi

# Update cart line
FIRST_LINE_ID=$(python3 -c "import json; print(json.load(open('/tmp/api-response.json'))['cart']['lines']['nodes'][0]['id'])" 2>/dev/null)
test_endpoint POST "$BASE/api/stores/$STORE/cart/$CART_TOKEN/update" "Update cart line" "{\"lines\":[{\"id\":\"$FIRST_LINE_ID\",\"quantity\":5}]}"

# Apply discount
test_endpoint POST "$BASE/api/stores/$STORE/cart/$CART_TOKEN/discount" "Apply discount (PILOT10)" '{"discountCode":"PILOT10"}'

# Apply invalid discount
test_endpoint POST "$BASE/api/stores/$STORE/cart/$CART_TOKEN/discount" "Invalid discount code" '{"discountCode":"INVALID"}' "422"

# Remove from cart
test_endpoint POST "$BASE/api/stores/$STORE/cart/$CART_TOKEN/remove" "Remove from cart" "{\"lineIds\":[\"$FIRST_LINE_ID\"]}"

# ─── Search ───────────────────────────────────────────
echo ""
echo "── Search ──"
test_endpoint GET "$BASE/api/stores/$STORE/search?q=leather" "Full search"
test_endpoint GET "$BASE/api/stores/$STORE/search/predictive?q=shirt&limit=3" "Predictive search"

# ─── Blog/Articles ────────────────────────────────────
echo ""
echo "── Blog/Articles ──"
test_endpoint GET "$BASE/api/stores/$STORE/blogs/journal" "Blog with articles"
test_endpoint GET "$BASE/api/stores/$STORE/blogs/journal/articles/the-art-of-capsule-wardrobes" "Single article"

# ─── Pages ────────────────────────────────────────────
echo ""
echo "── Pages ──"
test_endpoint GET "$BASE/api/stores/$STORE/pages/about" "About page"
test_endpoint GET "$BASE/api/stores/$STORE/pages/contact" "Contact page"

# ─── Policies ─────────────────────────────────────────
echo ""
echo "── Policies ──"
test_endpoint GET "$BASE/api/stores/$STORE/policies" "All policies"
test_endpoint GET "$BASE/api/stores/$STORE/policies/privacy-policy" "Privacy policy"

# ─── Customer (mock) ──────────────────────────────────
echo ""
echo "── Customer (Mock) ──"
test_endpoint GET "$BASE/api/stores/$STORE/customer" "Customer details"
test_endpoint GET "$BASE/api/stores/$STORE/customer/orders" "Customer orders"
test_endpoint GET "$BASE/api/stores/$STORE/customer/orders/1001" "Single order"

# ─── CMS (functional) ────────────────────────────────
echo ""
echo "── CMS (Theme) ──"
test_endpoint GET "$BASE/api/stores/$STORE/theme/page?type=INDEX" "Get homepage layout"
test_endpoint GET "$BASE/api/stores/$STORE/theme/page?type=PRODUCT" "Get product page layout"
test_endpoint POST "$BASE/api/stores/$STORE/theme/page" "Save page layout" '{"type":"CUSTOM","handle":"test-page","items":[{"id":"test","type":"rich-text","data":{"heading":"Test"}}]}'
test_endpoint GET "$BASE/api/stores/$STORE/theme/page?type=CUSTOM&handle=test-page" "Get saved custom page"
test_endpoint GET "$BASE/api/stores/$STORE/theme/settings" "Get theme settings"
test_endpoint POST "$BASE/api/stores/$STORE/theme/settings" "Save theme settings" '{"settings":{"colors":{"primary":"#FF0000"}}}'

# ─── SEO ──────────────────────────────────────────────
echo ""
echo "── SEO ──"
test_endpoint GET "$BASE/api/stores/$STORE/robots.txt" "Robots.txt"

# ─── Swatches ─────────────────────────────────────────
echo ""
echo "── Swatches ──"
test_endpoint GET "$BASE/api/stores/$STORE/swatches" "Color swatches"

# ─── Summary ──────────────────────────────────────────
echo ""
echo "═══════════════════════════════════════════════════"
echo "  Results: $PASS passed, $FAIL failed"
echo "═══════════════════════════════════════════════════"

exit $FAIL

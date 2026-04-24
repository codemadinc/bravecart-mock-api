# BraveCart Mock API

A Laravel 10 REST API that serves Shopify-compatible response shapes for the BraveCart V2 platform. This mock API provides all the data endpoints needed by the Pilot theme (converted from Weaverse/Hydrogen) during development, before the production Laravel API is ready.

## Key Features

- **Shopify-compatible response shapes** — MoneyV2 prices, `{ nodes: [...] }` arrays, GID identifiers, pageInfo pagination
- **Functional cart** — Token-based (stateless), real add/remove/update against mock product data
- **Functional CMS** — Real database read/write for page layouts and theme settings
- **SQLite by default** — Zero-config database, single file, ready for development
- **12 products with variants** — Realistic fashion store data with Unsplash images
- **6 collections** — New Arrivals, Bestsellers, Tops, Outerwear, Accessories, Sale
- **Full test suite** — 40 endpoint tests in `test-endpoints.sh`
- **CORS enabled** — Ready for cross-origin requests from the theme server

## Quick Start (Local)

```bash
# Prerequisites: PHP 8.1+, Composer, php-sqlite3

# Install dependencies
composer install

# Create SQLite database
touch database/database.sqlite

# Run migrations and seed data
php artisan migrate:fresh --seed --force

# Start development server
php artisan serve --host=0.0.0.0 --port=8080

# Test
curl http://localhost:8080/api/health
```

## EC2 Deployment

### 1. Launch EC2 Instance

- **AMI:** Ubuntu 22.04 LTS
- **Instance type:** t3.micro (sufficient for mock API)
- **Security group:** Open ports 22 (SSH), 80 (HTTP), 8080 (API)

### 2. Install Dependencies

```bash
sudo apt update && sudo apt upgrade -y
sudo apt install -y php8.1 php8.1-cli php8.1-sqlite3 php8.1-mbstring php8.1-xml php8.1-curl php8.1-zip unzip git nginx

# Install Composer
curl -sS https://getcomposer.org/installer | php
sudo mv composer.phar /usr/local/bin/composer
```

### 3. Deploy the Code

```bash
cd /var/www
sudo git clone https://github.com/codemadinc/bravecart-mock-api.git
cd bravecart-mock-api

sudo chown -R www-data:www-data .
sudo chmod -R 775 storage bootstrap/cache database

composer install --no-dev --optimize-autoloader

touch database/database.sqlite
sudo chown www-data:www-data database/database.sqlite

php artisan migrate:fresh --seed --force
php artisan config:cache
php artisan route:cache
```

### 4. Configure Nginx

Create `/etc/nginx/sites-available/bravecart-api`:

```nginx
server {
    listen 80;
    server_name your-ec2-public-ip;
    root /var/www/bravecart-mock-api/public;
    index index.php;

    add_header Access-Control-Allow-Origin * always;
    add_header Access-Control-Allow-Methods "GET, POST, PUT, PATCH, DELETE, OPTIONS" always;
    add_header Access-Control-Allow-Headers "Content-Type, Authorization, X-Requested-With, Accept, X-Store-Id" always;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php8.1-fpm.sock;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        include fastcgi_params;
    }

    location ~ /\.(?!well-known).* {
        deny all;
    }
}
```

```bash
sudo ln -s /etc/nginx/sites-available/bravecart-api /etc/nginx/sites-enabled/
sudo rm /etc/nginx/sites-enabled/default
sudo apt install -y php8.1-fpm
sudo nginx -t && sudo systemctl restart nginx
```

### 5. Verify Deployment

```bash
curl http://your-ec2-public-ip/api/health
bash test-endpoints.sh http://your-ec2-public-ip
```

### 6. SQLite to MySQL Migration (Later)

1. Remove `bootstrap/env-override.php`
2. Set `.env`: `DB_CONNECTION=mysql`, `DB_HOST`, `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`
3. Run `php artisan migrate:fresh --seed --force`

## API Reference

All endpoints are prefixed with `/api`. Store-scoped endpoints use `/api/stores/{storeId}/...`.

### Response Conventions

| Convention | Format | Example |
|---|---|---|
| IDs | GID string | `gid://bravecart/Product/1` |
| Prices | MoneyV2 | `{ "amount": "79.00", "currencyCode": "USD" }` |
| Arrays | Connection | `{ "nodes": [...] }` |
| Pagination | PageInfo | `{ "pageInfo": { "hasNextPage": true, "endCursor": "..." } }` |
| Images | Image object | `{ "id": "...", "url": "...", "altText": "...", "width": 800, "height": 1000 }` |

### Endpoints

#### Health & Internal

| Method | Endpoint | Description |
|---|---|---|
| GET | `/api/health` | Health check |
| POST | `/api/internal/store-config` | Domain detection (Host -> store config) |

#### Layout

| Method | Endpoint | Description |
|---|---|---|
| GET | `/api/stores/{id}/layout` | Shop info + header menu + footer menu |

#### Products

| Method | Endpoint | Description |
|---|---|---|
| GET | `/api/stores/{id}/products` | Product listing (query, sortKey, reverse, count, after) |
| GET | `/api/stores/{id}/products/{handle}` | Full product detail |
| GET | `/api/stores/{id}/products/{handle}/variants` | All variants for a product |
| POST | `/api/stores/{id}/products/recommended` | Recommended products (body: productId, count) |

**Query parameters for product listing:**

| Param | Type | Default | Description |
|---|---|---|---|
| `query` | string | — | Search text |
| `sortKey` | string | `CREATED_AT` | TITLE, PRICE, CREATED_AT, BEST_SELLING |
| `reverse` | boolean | false | Reverse sort order |
| `count` | integer | 12 | Items per page (max 50) |
| `after` | string | — | Cursor for next page |

#### Collections

| Method | Endpoint | Description |
|---|---|---|
| GET | `/api/stores/{id}/collections` | All collections |
| GET | `/api/stores/{id}/collections/{handle}` | Collection with products (sortKey, reverse, first, after) |
| GET | `/api/stores/{id}/collections/{handle}/product-count` | Product count |

#### Cart (Functional, Token-Based)

| Method | Endpoint | Description |
|---|---|---|
| POST | `/api/stores/{id}/cart/create` | Create cart (body: lines, buyerIdentity) |
| GET | `/api/stores/{id}/cart/{token}` | Get cart |
| POST | `/api/stores/{id}/cart/{token}/add` | Add lines (body: lines[{merchandiseId, quantity}]) |
| POST | `/api/stores/{id}/cart/{token}/update` | Update lines (body: lines[{id, quantity}]) |
| POST | `/api/stores/{id}/cart/{token}/remove` | Remove lines (body: lineIds[]) |
| POST | `/api/stores/{id}/cart/{token}/discount` | Apply discount (body: discountCode) |

**Mock discount codes:** `PILOT10` (10% off), `PILOT20` (20% off), `WELCOME` (15% off)

#### Search

| Method | Endpoint | Description |
|---|---|---|
| GET | `/api/stores/{id}/search` | Full search (q, type, first) |
| GET | `/api/stores/{id}/search/predictive` | Predictive search (q, limit) |

#### Blog / Articles

| Method | Endpoint | Description |
|---|---|---|
| GET | `/api/stores/{id}/blogs/{handle}` | Blog with paginated articles |
| GET | `/api/stores/{id}/blogs/{blogHandle}/articles/{articleHandle}` | Single article |

#### Pages

| Method | Endpoint | Description |
|---|---|---|
| GET | `/api/stores/{id}/pages/{handle}` | Single page (about, contact) |

#### Policies

| Method | Endpoint | Description |
|---|---|---|
| GET | `/api/stores/{id}/policies` | All policies (Shopify shop.policies shape) |
| GET | `/api/stores/{id}/policies/{handle}` | Single policy |

#### Customer (Mock)

| Method | Endpoint | Description |
|---|---|---|
| GET | `/api/stores/{id}/customer` | Mock customer details |
| GET | `/api/stores/{id}/customer/orders` | Mock customer orders |
| GET | `/api/stores/{id}/customer/orders/{orderId}` | Mock single order |

#### CMS (Functional)

| Method | Endpoint | Description |
|---|---|---|
| GET | `/api/stores/{id}/theme/page` | Get page layout (type, handle) |
| POST | `/api/stores/{id}/theme/page` | Save page layout (type, handle, items) |
| GET | `/api/stores/{id}/theme/settings` | Get theme settings |
| POST | `/api/stores/{id}/theme/settings` | Save theme settings (settings) |

#### SEO & Swatches

| Method | Endpoint | Description |
|---|---|---|
| GET | `/api/stores/{id}/robots.txt` | Robots.txt content |
| GET | `/api/stores/{id}/swatches` | Color/image swatches |

## Mock Data Summary

| Entity | Count | Details |
|---|---|---|
| Store | 1 | "Pilot Demo Store" (domain: localhost) |
| Products | 12 | Fashion items with Unsplash images |
| Variants | ~70 | Size/Color combinations |
| Collections | 6 | New Arrivals, Bestsellers, Tops, Outerwear, Accessories, Sale |
| Menus | 2 | Header (4 items with dropdown), Footer (6 items) |
| Blog | 1 | "Journal" with 3 articles |
| Pages | 2 | About, Contact |
| Policies | 4 | Privacy, Shipping, Refund, Terms |
| Swatches | 20 | Color hex values |
| Theme pages | 3 | INDEX, PRODUCT, COLLECTION layouts |
| Theme settings | 1 | Colors, typography, layout, header, footer |

## Architecture Notes

- **SQLite for development** — Switch to MySQL/RDS for production by removing `bootstrap/env-override.php`
- **Stateless API** — No sessions. Cart uses token-based identification.
- **CORS enabled** — All origins allowed via middleware (restrict in production)
- **No authentication** — Customer endpoints return mock data. Add auth middleware when ready.
- **`bootstrap/env-override.php`** — Workaround to force SQLite when the environment has `DATABASE_URL` pointing to MySQL. Delete this file when deploying with MySQL.

## File Structure

```
app/
  Helpers/
    ShopifyFormatter.php      # Shopify-compatible response shape transformers
  Http/
    Controllers/Api/
      LayoutController.php     # Shop info + menus
      ProductController.php    # Products CRUD + search + recommended
      CollectionController.php # Collections with products
      CartController.php       # Functional cart (token-based)
      SearchController.php     # Full + predictive search
      BlogController.php       # Blog + articles
      PageController.php       # Static pages
      PolicyController.php     # Store policies
      CustomerController.php   # Mock customer data
      StoreConfigController.php # Domain detection
      ThemeController.php      # CMS page layouts + theme settings
      SeoController.php        # Robots.txt
      SwatchController.php     # Color swatches
    Middleware/
      CorsMiddleware.php       # CORS headers
  Models/
    Store, Product, ProductVariant, Collection,
    Cart, CartItem, Menu, Blog, Article,
    Page, Policy, ThemePage, ThemeSettings, Swatch
database/
  migrations/                  # 11 migration files (14 tables)
  seeders/                     # 9 seeder files
  database.sqlite              # SQLite database file
bootstrap/
  env-override.php             # Forces SQLite (delete for MySQL)
routes/
  api.php                      # All API routes
test-endpoints.sh              # Full test suite (40 tests)
```

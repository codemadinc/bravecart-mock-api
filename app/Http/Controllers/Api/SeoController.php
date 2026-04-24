<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Store;
use Illuminate\Http\Response;

class SeoController extends Controller
{
    /**
     * GET /api/stores/{storeId}/robots.txt
     * Returns robots.txt content.
     */
    public function robots(int $storeId): Response
    {
        $store = Store::findOrFail($storeId);

        $content = "User-agent: *\n";
        $content .= "Allow: /\n";
        $content .= "Disallow: /admin\n";
        $content .= "Disallow: /cart\n";
        $content .= "Disallow: /checkout\n";
        $content .= "Disallow: /account\n";
        $content .= "\n";
        $content .= "Sitemap: https://{$store->domain}/sitemap.xml\n";

        return response($content, 200)
            ->header('Content-Type', 'text/plain');
    }
}

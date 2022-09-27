<?php

namespace App\Http\Controllers\Services;

use App\Enum\ProductEnum;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ScraperController extends Controller
{
    private int $totalPages = 25863;

    public static function getProducts()
    {
        $baseUrl = 'https://world.openfoodfacts.org';
        $html = file_get_contents($baseUrl);
        $dom = new \DOMDocument();
        @$dom->loadHTML($html);
        $listLinks = $dom->getElementsByTagName('a');
        $listLinksProducts = ScraperController::getLinkProducts($listLinks);
        $products = ScraperController::extractData($listLinksProducts, $baseUrl, $dom);
        return $products;
    }

    public static function getLinkProducts($links)
    {
        $productsLinks = [];
        foreach ($links as $list) {
            $href = $list->getAttribute('href');
            if (strpos($href, 'product') !== false) {
                $productsLinks[] = $href;
            }
        }
        return $productsLinks;
    }

    public static function extractData($listLinks, $baseUrl, $dom)
    {
        $products = [];

        foreach ($listLinks as $href) {
            $content = file_get_contents($baseUrl . $href);
            @$dom->loadHTML($content);

            $code = $dom->getElementById('barcode')->textContent;
            $barcode = $dom->getElementById('barcode_paragraph')->textContent;
            $productName = $dom->getElementsByTagName('h1')->item(0)->textContent;
            $quantity = $dom->getElementById('field_quantity_value')->textContent ?? '';
            $categories = $dom->getElementById('field_categories_value')->textContent ?? '';
            $packaging = $dom->getElementById('field_packaging_value')->textContent ?? '';
            $brands = $dom->getElementById('field_brands_value')->textContent ?? '';

            if ($dom->getElementById('og_image') !== null) {
                $image = $dom->getElementById('og_image')->getAttribute('src');
            } else {
                $image = '';
            }

            $products[] = [
                'code' => $code,
                'barcode' => $barcode,
                'status' => ProductEnum::IMPORTED->value,
                'imported_t' => date('Y-m-d H:i:s'),
                'url' => "https://world.openfoodfacts.org/product/$code",
                'product_name' => $productName,
                'quantity' => $quantity,
                'categories' => $categories,
                'packaging' => $packaging,
                'brands' => $brands,
                'image_url' => "https://static.openfoodfacts.org" . $image,
            ];
        }
        return $products;
    }
}

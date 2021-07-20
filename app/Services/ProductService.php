<?php

namespace App\Services;

use App\Models\Product;
use Exception;
use Illuminate\Support\Facades\DB;

class ProductService{

    public function createProduct($product)
    {
        $product = Product::create($product);
        return $product->id;
    }

    public function productDetailsToShow()
    {
        $raw_products = Product::paginate(10);

        $current_products_ids = [];

        foreach($raw_products as $products)
        {
            $products->productVariantPrice;
            array_push($current_products_ids, $products->id);
        }

        
    }

    public function deleteProduct($product)
    {
        
    }
}
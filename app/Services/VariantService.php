<?php

namespace App\Services;

use App\Models\ProductVariant;
use App\Models\ProductVariantPrice;

class VariantService{

    public function createProductVariants($productId, $variants)
    {
        $variantsIds = [];

        foreach($variants as $variant){
            foreach ($variant['tags'] as $pTag) {
                $productVariant = [
                    'variant' => $pTag,
                    'variant_id' => $variant['option'],
                    'product_id' => $productId
                ];

                $variantsIds[$pTag] = ProductVariant::firstOrCreate($productVariant)->id;
            }
        }
        return $variantsIds;
    }

    public function createVariantPrice($productId, $variants, $prices)
    {
        foreach ($prices as $price) {
            $varTitle = explode("/", $price['title']);

            $first = $variants[$varTitle[0]];
            if(isset($varTitle[1]) && $varTitle[1] != '')
            {
                $second = $variants[$varTitle[1]];
            }
            if(isset($varTitle[2]) && $varTitle[2] != '')
            {
                $third = $variants[$varTitle[2]];
            }

            $singlePrice = $price['price'];
            $stock = $price['stock'];
            $product_id = $productId;

            ProductVariantPrice::updateOrCreate([
                'product_variant_one' => ($first ?? null),
                'product_variant_two' => ($second ?? null),
                'product_variant_three' => ($third ?? null),
                'product_id' => $product_id,
            ],
            [
                'price' => $singlePrice,
                'stock' => $stock,
            ]
            );
        }
        return response()->json(['status' => true, "message" => "Porudct has ben created!"]);
    }
}
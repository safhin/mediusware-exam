<?php

namespace App\Traits;

use App\Models\ProductImage;

trait ProductImageUplad{

    public function imageUplad($produtId, $images)
    {
        $image = isset($images['thumbnail']) ? true : false;

        if(count($images) > 0){
            ProductImage::create([
                'product_id' => $produtId,
                'file_path' => $images['image'],
                'thumbnail' => $image,
            ]);
        }
    }
}
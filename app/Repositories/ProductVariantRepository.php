<?php

namespace App\Repositories;

use App\Exceptions\NotFoundException;
use Illuminate\Support\Facades\DB;
use App\Models\ProductVariant;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ProductVariantRepository
{
    public function get($id)
    {
        try {
            $productVariant = ProductVariant::findOrFail($id);
            return $productVariant;
        } catch (ModelNotFoundException $e) {
            throw new NotFoundException("Not found product variant has ID: $id");
        }
    }

    public function getForUpdate($id)
    {
        return ProductVariant::where('id', $id)->lockForUpdate()->first();
    }

    public function findByProductId($id)
    {
        return ProductVariant::where('product_id', $id)->get();
    }

    public function remove($id)
    {
        return ProductVariant::where('id', $id)->delete();
    }

    public function pagination($perPage, $page)
    {
        return ProductVariant::paginate($perPage, ['*'], 'page', $page);
    }

    public function findByProductIdAndSize($productId, $size)
    {
        return ProductVariant::where('product_id', $productId)
            ->where('size', $size)
            ->first();
    }

    public function findBySizeAndColor($productId, $size, $color)
    {
        return ProductVariant::where('product_id', $productId)
            ->where('size', $size)
            ->where('color', $color)
            ->first();
    }

    public function create($productId, $size, $extendPrice, $color, $stockQuantity)
    {
        return ProductVariant::create([
            'product_id' => $productId,
            'size' => $size,
            'extend_price' => $extendPrice,
            'stock_qty' => $stockQuantity,
            'color' => $color ?? 'none'
        ]);
    }

    public function update($data)
    {
        $fields = ['product_id', 'size', 'color', 'stock_qty', 'extend_price'];
        $updateData = [];

        foreach ($fields as $field) {
            if (isset($data[$field])) {
                $updateData[$field] = $data[$field];
            }
        }

        if (!empty($updateData)) {
            return DB::table('product_variants')
                ->where('id', $data['id'])
                ->update($updateData);
        }

        return false;
    }
}

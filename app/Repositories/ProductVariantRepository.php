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

    public function getByBarcode($variantBarcode)
    {
        try {
            $product = ProductVariant::where('variant_barcode', $variantBarcode)->firstOrFail();
            return $product;
        } catch (ModelNotFoundException $e) {
            throw new NotFoundException("Not found product with barcode: $variantBarcode");
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

    public function create($productId, $size, $extendPrice, $color, $stockQuantity, $variant_barcode)
    {
        return ProductVariant::create([
            'product_id' => $productId,
            'size' => $size,
            'extend_price' => $extendPrice,
            'stock_qty' => $stockQuantity,
            'color' => $color ?? 'none',
            'variant_barcode' => $variant_barcode
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
            $updateData['updated_at'] = now();
            DB::beginTransaction();
            try {
                if (isset($data['id'])) {
                    DB::table('product_variants')
                        ->where('id', $data['id'])
                        ->update($updateData);
                } else {
                    DB::table('product_variants')
                        ->where('variant_barcode', $data['variant_barcode'])
                        ->update($updateData);
                }

                DB::commit();
                return true;
            } catch (\Exception $e) {
                DB::rollback();
            }
        }

        return false;
    }
}

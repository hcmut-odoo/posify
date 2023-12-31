<?php

namespace App\Repositories;

use App\Exceptions\NotFoundException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Product;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use RuntimeException;

class ProductRepository
{
    public function get($id)
    {
        try {
            $product = Product::findOrFail($id);
            return $product;
        } catch (ModelNotFoundException $e) {
            throw new NotFoundException("Not found product has ID: $id");
        }
    }

    public function getProductWithVariant($id)
    {
        return Product::with('variants')->find($id);
    }

    public function findByName($name)
    {
        return Product::where('name', $name)->first();
    }

    public function findByCategory($id)
    {
        return Product::where('category_id', $id)->get();
    }

    public function search($keyword)
    {
        return Product::where('name', 'LIKE', "%$keyword%")->get();
    }

    public function remove($id)
    {
        return Product::where('id', $id)->delete();
    }

    public function getAll()
    {
        return DB::table('products')
        ->join('categories', 'products.category_id', '=', 'categories.id')
        ->select('products.*', 'categories.name as category_name')
        ->get();
    }

    public function pagination($perPage, $page)
    {
        return Product::paginate($perPage, ['*'], 'page', $page);
    }

    public function create($categoryId, $name, $price, $description, $imageUrl, $barcode)
    {
        return Product::create([
            'category_id' => $categoryId,
            'name' => $name,
            'price' => $price,
            'description' => $description,
            'image_url' => $imageUrl,
            'tax_id' => 1,
            'barcode' => $barcode
        ]);
    }

    public function update($data)
    {
        $fields = ['category_id', 'price', 'description', 'name', 'image_url', 'barcode'];
        $updateData = [];

        foreach ($fields as $field) {
            if (isset($data[$field])) {
                $updateData[$field] = $data[$field];
            }
        }

        $updateData['updated_at'] = now();

        if (!empty($updateData)) {
            return DB::table('products')
                ->where('id', $data['id'])
                ->update($updateData);
        }

        return false;
    }
}

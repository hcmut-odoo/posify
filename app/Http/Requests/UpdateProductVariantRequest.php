<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdateProductVariantRequest extends FormRequest
{
    public function rules()
    {
        return [
            'id' => 'sometimes|required|exists:product_variants,id',
            'product_id' => 'sometimes|required|exists:products,id',
            'variant_barcode' => 'sometimes|required|exists:product_variants,variant_barcode',
            'size' => 'nullable|string',
            'color' => 'nullable|string',
            'extend_price' => 'sometimes|required|numeric|min:1',
            'stock_qty' => 'sometimes|required|numeric|min:1',
            'description' => 'nullable|string',
            'image_url' => 'nullable|string',
            'category_id' => 'sometimes|numeric|min:1|exists:categories,id'
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'success'   => false,
            'message'   => 'Validation errors',
            'data'      => $validator->errors()
        ]));
    }
}

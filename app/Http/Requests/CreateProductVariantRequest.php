<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class CreateProductVariantRequest extends FormRequest
{
    public function rules()
    {
        return [
            'product_id' => 'sometimes|required|exists:products,id',
            'variant_barcode' => 'sometimes|required',
            'size' => 'nullable|string',
            'color' => 'nullable|string',
            'extend_price' => 'sometimes|required|numeric|min:1',
            'stock_qty' => 'sometimes|required|numeric|min:1',
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

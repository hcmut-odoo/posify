<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class UpdateCategoryRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $categoryId = $this->route('id') ? $this->route('id')->id : $this->input('id');

        return [
            'name' => 'required|string|max:255|unique:categories,name,' . $categoryId,
            'id' => [
                'required',
                'integer',
                Rule::exists('categories', 'id')->where(function ($query) use ($categoryId) {
                    $query->where('id', $categoryId);
                }),
            ],
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'success'   => false,
            'message'   => 'Validation errors',
            'data'      => $validator->errors()
        ], 400));
    }
}

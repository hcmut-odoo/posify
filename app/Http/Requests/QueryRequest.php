<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class QueryRequest extends FormRequest
{
    public function rules()
    {
        return [
            'filter' => 'array',
            'display' => 'array',
            'sort' => 'array',
            'date' => 'array',
            'limit' => 'integer|min:1',
            'page' => 'integer|min:1',
            'filter.*.operator' => 'required_with:filter|array|in:eq,like,lt,lteq,gt,gteq,neq',
            'filter.*.value' => 'required_with:filter|array',
            'date.start' => 'nullable|date_format:Y-m-d',
            'date.end' => 'nullable|date_format:Y-m-d|after_or_equal:date.start',
            'display.*' => 'string',
            'sort.*' => 'string|in:asc,desc',
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

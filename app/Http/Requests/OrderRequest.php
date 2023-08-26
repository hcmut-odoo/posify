<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class OrderRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $paymentMode = $this->route('payment_mode') ? $this->route('payment_mode')->id : $this->input('payment_mode');

        return [
            'payment_mode' => [
                'required',
                'string',
                'max:50',
                Rule::exists('payment_modes', 'name')->where(function ($query) use ($paymentMode) {
                    $query->where('name', $paymentMode);
                }),
            ],
        ];
    }

    /**
     * Handle a failed validation attempt.
     *
     * @param  Validator  $validator
     * @return void
     *
     * @throws HttpResponseException
     */
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'success' => false,
            'message' => 'Validation errors',
            'data'    => $validator->errors(),
        ], 422));
    }
}

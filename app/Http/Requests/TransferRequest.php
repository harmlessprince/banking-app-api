<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TransferRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'receiver_account_number' => ['required', 'string'],
            'amount' => ['required', 'numeric', 'min:10'],
            'pin' => ['required', 'string', 'min:4'],
            'description' => ['nullable', 'max:200']
        ];
    }
}

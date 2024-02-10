<?php

namespace App\Http\Requests;

use App\Enum\TransactionCategoryEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\RequiredIf;

class FilterTransactionsRequest extends FormRequest
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
            'start_date' => [Rule::requiredIf(request()->query('end_date') != null), 'date_format:Y-m-d'],
            'end_date' => [Rule::requiredIf(request()->query('start_date') != null), 'date_format:Y-m-d'],
            'category' => ['nullable', 'string', Rule::in(TransactionCategoryEnum::WITHDRAWAL->value, TransactionCategoryEnum::DEPOSIT->value)],
            'per_page' => ['nullable', 'integer', 'min:10', 'max:100']
        ];
    }
}

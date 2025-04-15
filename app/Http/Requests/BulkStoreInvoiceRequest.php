<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class BulkStoreInvoiceRequest extends FormRequest
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
            // *. prefix tells Laravel, “This is a bulk array — validate each item in it”
            // Since everything is gonna be in array we use * to validate every individual object in array for bulk insert
            // If we had array with data wrapped in another json named data (data: [{...}, {...}, {...}]) we would do: data.*.name
            '*.customerId' => ['required', 'integer'],
            '*.amount' => ['required', 'numeric'],
            '*.status' => ['required', Rule::in('billed', 'paid', 'void')],
            '*.billedDate' => ['required', 'date_format:Y-m-d H:i:s'],
            '*.paidDate' => ['date_format:Y-m-d H:i:s', 'nullable'],
        ];
    }

    /**
     * prepareForValidation prepares or sanitizes any data from the request before
     * applying validation rules (executing rules method)
     */
    protected function prepareForValidation()
    {
        $data = [];

        foreach ($this->toArray() as $obj) {
            // NOTE: Even tho we add additional underscored fields we do not remove old camelCased ones
            // As TODO: They can be deleted
            $obj['customer_id'] = $obj['customerId'] ?? null;
            $obj['billed_date'] = $obj['billedDate'] ?? null;
            $obj['paid_date'] = $obj['paidDate'] ?? null;
            $data[] = $obj;
        }

        $this->merge($data);
    }

}

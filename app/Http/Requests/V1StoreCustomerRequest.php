<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class V1StoreCustomerRequest extends FormRequest
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
            'name' => ['required'],
            'type' => ['required', Rule::in('individual', 'business')],
            'email' => ['required', 'email'],
            'address' => ['required'],
            'city' => ['required'],
            'country' => ['required'],
            'postalCode' => ['required']
        ];
    }

    /**
     * prepareForValidation prepares or sanitizes any data from the request before 
     * applying validation rules (executing rules method)
     */
    protected function prepareForValidation()
    {
        // Merge new input into the current request's input array
        $this->merge([
            // Example use:
            // 'slug' => Str::slug($this->slug) // slug field is gonna be changed with Str's static slug and be validated
            'postal_code' => $this->postalCode
        ]);
    }

}

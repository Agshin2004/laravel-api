<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateCustomerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $method = $this->method();
        if ($method === 'PUT') {
            return [
                'name' => ['required'],
                'type' => ['required', Rule::in('individual', 'business')],
                'email' => ['required', 'email'],
                'address' => ['required'],
                'city' => ['required'],
                'country' => ['required'],
                'postalCode' => ['required']
            ];
        } elseif ($method === 'PATCH') {
            return [
                'name' => ['sometimes', 'required'],
                'type' => ['sometimes', 'required', Rule::in('individual', 'business')],
                'email' => ['sometimes', 'required', 'email'],
                'address' => ['sometimes', 'required'],
                'city' => ['sometimes', 'required'],
                'country' => ['sometimes', 'required'],
                'postalCode' => ['sometimes', 'required']
            ];
        } 
    }


    /**
     * prepareForValidation prepares or sanitizes any data from the request before 
     * applying validation rules (executing rules method)
     */
    protected function prepareForValidation()
    {
        if ($this->postalCode) {
            // Merge new input into the current request's input array
            $this->merge([
                // Example use:
                // 'slug' => Str::slug($this->slug) // slug field is gonna be changed with Str's static slug and be validated
                'postal_code' => $this->postalCode
            ]);
        }
    }
}

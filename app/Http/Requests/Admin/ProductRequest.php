<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        switch($this->method()){
            case "POST":
                return [
                    'name' => ['required'],
                    'category_id' => ['required'],
                    'price' => ['required', 'numeric'],
                    'quantity' => ['required', 'numeric'],
                    'weight' => ['required', 'numeric'],
                    'description' => ['required'],
                    'details' => ['required'],
                    'tags' => ['required'],
                ];
            case "PUT":
            case "PATCH":
                return [
                    'name' => ['required'],
                    'category_id' => ['required'],
                    'price' => ['required', 'numeric'],
                    'quantity' => ['required', 'numeric'],
                    'weight' => ['required', 'numeric'],
                    'description' => ['required'],
                    'details' => ['required'],
                    'tags' => ['required'],
                ];
            default: break;      
        }
    }
}

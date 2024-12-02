<?php

namespace App\Http\Requests\City;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCityRequest extends FormRequest
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
            "name" => "sometimes|min:3|max:50|unique:cities,name",
        ];
    }
    public function messages()
    {
        return [
            "name.min" => "حقل الاسم يجب ان يكون على الاقل 3 حروف",
            "name.max" => "حقل الاسم يجب ان يكون على حد اقصى 50 حرف",
            "name.unique" => "الاسم موجود بالفعل",
        ];
    }
}

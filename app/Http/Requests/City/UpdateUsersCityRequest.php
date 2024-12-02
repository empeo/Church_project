<?php

namespace App\Http\Requests\City;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUsersCityRequest extends FormRequest
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
            "name" => "sometimes|string|min:3|max:50",
            "phone" => "sometimes|string",
            "street" => "sometimes|min:3",
            "level" => "sometimes|min:3",
            "image" => "sometimes|image",
        ];
    }
    public function messages()
    {
        return [
            "name.min" => "حقل الاسم يجب الان يكون على الاقل 3 حروف",
            "name.max" => "حقل الاسم يجب ان لا يزيد عن 50 حرف",
            "phone.string" => "حقل الهاتف يجب ان يكون نص",
            "street.min" => "حقل الشارع يجب ان يكون على الاقل 3 حروف",
            "level.min" => "حقل المستوى يجب ان يكون على الاقل 3 حروف",
        ];
    }
}

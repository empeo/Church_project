<?php

namespace App\Http\Requests\City;

use Illuminate\Foundation\Http\FormRequest;

class CreateUsersCityRequest extends FormRequest
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
            "name" => "required|string|min:3|max:50",
            "phone" => "sometimes|string",
            "street" => "required|min:3",
            "level" => "required|min:3",
            "image" => "sometimes|image",
        ];
    }
    public function messages(){
        return [
            "name.required" => "حقل الاسم مطلوب",
            "name.min" => "حقل الاسم يجب الان يكون على الاقل 3 حروف",
            "name.max" => "حقل الاسم يجب ان لا يزيد عن 50 حرف",
            "phone.string" => "حقل الهاتف يجب ان يكون نص",
            "street.required" => "حقل الشارع مطلوب",
            "street.min" => "حقل الشارع يجب ان يكون على الاقل 3 حروف",
            "level.required" => "حقل المستوى مطلوب",
            "level.min" => "حقل المستوى يجب ان يكون على الاقل 3 حروف",
        ];
    }
}

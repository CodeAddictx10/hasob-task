<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VendorFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        if(request()->routeIs('vendor.store')){
            $_rule = 'required';
        }elseif(request()->routeIs('vendor.update')){
            $_rule = 'sometimes';
        }
        return [
            "name"=>$_rule,
            "category"=>$_rule,
        ];
    }

            /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            "name.required"=>"Vendor name is required",
            "category.required"=>"Vendor category is required",
        ];
    }
}

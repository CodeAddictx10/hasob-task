<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{

    /**
     * Indicates if the validator should stop on the first rule failure.
     *
     * @var bool
     */
    protected $stopOnFirstFailure = true;

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
        if(request()->isMethod('POST')){
            $_rule = 'required';
        }elseif(request()->isMethod('PUT')){
            $_rule = 'sometimes';
        }
        return [
            "first_name"=>"$_rule|min:3",
            "last_name"=>"$_rule|min:3",
            "email"=>"$_rule|email|unique:users",
            "password"=>[Rule::when(request()->routeIs('user.store'), 'required'),Rule::when(request()->routeIs('user.store'), 'optional'), "min:6"],
            "phone_number"=>"$_rule|unique:users",
            "picture_url"=>"$_rule|url"
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
            'first_name.required' => 'Your first name is required',
            'first_name.min' => 'Your first name should be a mininum of 3 letters',
            'last_name.required' => 'Your last name is required',
            'last_name.min' => 'Your last name should be a mininum of 3 letters',
            "email.required"=>"Your email address is required",
            "email.email"=>"Enter a valid email address",
            "email.unique"=>"This email address has already been used",
            "phone_number.required"=>"Phone number is required",
            "phone_number.unique"=>"Phone number has been registered",
            "password.required"=>"Password is required",
            'password.min' => 'Your password should be a mininum of 6 characters',
            "picture_url.required"=>"Picture link is required",
            "picture_url.url"=>"Enter a valid link"
        ];
    }
}

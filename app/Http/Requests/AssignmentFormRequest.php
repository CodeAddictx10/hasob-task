<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class AssignmentFormRequest extends FormRequest
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
        if(request()->routeIs('assignment.store')){
            $_rule = 'required';
        }elseif(request()->routeIs('assignment.update')){
            $_rule = 'sometimes';
        }
        return [
            "asset_id"=>"$_rule",
            "assignment_date"=>"$_rule",
            "status"=>[$_rule,"boolean"],
            "is_due"=>[$_rule,"boolean"],
            "due_date"=>"$_rule",
            "assigned_user_id"=>"$_rule",
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
            "asset_id.required"=>"Asset ID is required",
            "assignment_date.required"=>"Asset assignment is required",
            "status.required"=>"Asset status is required",
            "is_date.required"=>"Asset due status is required",
            "due_date.required"=>"Asset due date is required",
            "assigned_user_id.required"=>"Assigned user id is required",
        ];
    }
}

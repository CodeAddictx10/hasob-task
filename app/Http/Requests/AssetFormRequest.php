<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AssetFormRequest extends FormRequest
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
        if(request()->routeIs('asset.store')){
            $_rule = 'required';
        }elseif(request()->routeIs('asset.update')){
            $_rule = 'sometimes';
        }

        return [
            "type"=>"$_rule",
            "serial_no"=>"$_rule|unique:assets",
            "description"=>"$_rule",
            "fixed_or_movable"=>["$_rule", Rule::in(["Fixed", "Movable"])],
            "picture_path"=>"$_rule",
            "purchase_date"=>"$_rule",
            "start_to_use_date"=>"$_rule",
            "purchase_price"=>"$_rule",
            "warranty_expiry_date"=>"$_rule",
            "degradation_in_years"=>"$_rule|int",
            "current_value_in_naira"=>"$_rule",
            "location"=>"$_rule",
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
            'type.required' => 'Asset type is required',
            'serial_no.required' => 'Asset serial number is required',
            'serial_no.unique' => 'Asset serial number is a unique field',
            'description.required' => 'Asset description is required',
            'fixed_or_movable.required' => 'This field is required',
            'fixed_or_movable.Rule' => 'Please specify if asset is movable or fixed',
            'picture_path.required' => 'Asset picture path is required',
            'purchase_date.required' => 'Asset purchase date is required',
            'purchase_date.date' => 'Please provide a valid date for asset purchase date',
            'start_to_use_date.required' => 'Asset start to use date is required',
            'start_to_use_date.date' => 'Please provide a valid date for asset start to use',
            'start_to_use_date.after' => 'Asset start to use must be after purchase date',
            "purchase_price"=>"Asset purchase price is required",
            'warranty_expiry_date.required' => 'Asset warranty expire date is required',
            'warranty_expiry_date.date' => 'Please provide a valid date for asset warranty expire date',
            'warranty_expiry_date.after' => 'Asset warranty expire date must be after purchase date',
            'degradation_in_years.required'=>'Asset degradation in years is required',
            'current_value_in_naira.required'=>'Asset current value in naira is required',
            'location.required'=>'Asset location is required',
        ];
    }
}

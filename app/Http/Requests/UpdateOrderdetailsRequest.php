<?php

namespace App\Http\Requests;

use App\Models\Orderdetails;
use Illuminate\Foundation\Http\FormRequest;

class UpdateOrderdetailsRequest extends FormRequest
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
        $rules = Orderdetails::$rules;
        
        return $rules;
    }
}

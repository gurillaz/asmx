<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreOrderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {


        return [

            'supplier_id' => 'required|exists:suppliers,id',
            'stock_type' => 'required|in:minimal_stock,maximal_stock,none',
        ];
    }

    public function attributes()
    {
        return [

            'supplier_id' => 'Furnitori',
            'stock_type' => 'Sipas stokut',

        ];
    }
}

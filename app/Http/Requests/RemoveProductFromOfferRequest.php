<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class RemoveProductFromOfferRequest extends FormRequest
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

            'offer_id' => 'required|exists:profactures,id',
            'product_id' => 'required|exists:products,id',
            // 'custom_product_name'=>'required|max:100',
            // 'product_order_no' => 'required|numeric|min:1',
            // 'quantity' => 'required|numeric|min:0.01',
            // 'price' => 'required|numeric|min:0.01',
            // 'discount' => 'required|min:0.001,max:1',
        ];
    }

    public function attributes()
    {
        return [
            'offer_id' => 'Oferta',
            'product_id' => 'Produkti',
            // 'custom_product_name' => 'Emri i artikullit',
            // 'product_order_no' => 'Renditja e artikullit',
            // 'quantity' => 'Sasia',
            // 'price' => 'Cmimi',
            // 'discount' => 'Zbritja',


        ];
    }
}

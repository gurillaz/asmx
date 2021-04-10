<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreProductPlaceRequest extends FormRequest
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

        // producing_company: "",
        // producing_country: "",
        // supplier_ids: [],
        return [

            'product_id' => 'required|exists:products,id',
            'place_no' => 'required|string|min:3|max:50',
            'comment' => 'max:200',
        ];
    }

    public function attributes()
    {
        return [
            'place_no' => 'Vendi',
            'info' => 'Info shtese',
            'product_id' => 'Produkti',
        ];
    }
}

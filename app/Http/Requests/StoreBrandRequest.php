<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreBrandRequest extends FormRequest
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

            'name' => 'required|max:30',
            'producing_company' => 'required|max:30',
            'producing_country' => 'required|max:30',
            'supplier_ids' => 'required|array',
            'supplier_ids.*' => 'required|exists:suppliers,id',
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'Emri i brendit',
            'producing_company' => 'Prodhuesi',
            'producing_country' => 'Vendi i origjines',
            'supplier_ids' => 'Furnitoret',
            'supplier_ids.*' => 'Furnitori',


        ];
    }
}

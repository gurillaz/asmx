<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreSubjectRequest extends FormRequest
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





            'subject_type' => 'required|in:supplier,client,other',

            'name' => 'required|min:3|max:150',
            'address' => 'min:2|max:200',
            'city' => 'required|min:2|max:100',
            'postal_code' => 'min:2|max:100',
            'country' => 'required|min:2|max:100',
            'info' => 'max:500',

            'contact_name' => 'required|min:3|max:150',
            'phone_1' => 'required|min:8|max:20',
            'phone_2' => 'min:8|max:20',
            'email' => 'min:5|max:50',
            'website' => 'min:5|max:50',


            'price_level_id' => 'required_if:subject_type,client|exists:price_levels,id',
            'price_increase_quota' => 'required_if:subject_type,client|numeric|min:1',
            'credit_limit' => 'required_if:subject_type,client|numeric|min:0',
            'payment_limit_days' => 'required_if:subject_type,client|numeric|min:0',

            'fiscal_no' => 'min:2|max:100',
            'bank_name' => 'min:2|max:100',
            'bank_account_no' => 'min:3|max:50',





        ];
    }

    public function attributes()
    {
        return [
            'subject_type' => 'Tipi i subjektit',

            'name' => 'Emri i subjektit',
            'address' => 'Adresa',
            'city' => 'Qyteti/Komuna',
            'postal_code' => 'Numri postal',
            'country' => 'Shteti',
            'info' => 'Te dhena shtese',

            'contact_name' => 'Personi Kontaktues',
            'phone_1' => 'Telefon 1',
            'phone_2' => 'Telefon 2',
            'email' => 'Email',
            'website' => 'Website',


            'price_level_id' => 'Kategoria e cmimeve',
            'price_increase_quota' => 'Kuote e ngritjes se cmimeve',
            'credit_limit' => 'Kredit limiti',
            'payment_limit_days' => 'Afati i pageses',

            'fiscal_no' => 'Numri fiskal',
            'bank_name' => 'Emri i bankes',
            'bank_account_no' => 'Llogaria e bankes',

        ];
    }
}

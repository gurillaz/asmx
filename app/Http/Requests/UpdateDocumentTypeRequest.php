<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateDocumentTypeRequest extends FormRequest
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

            'name' => 'required|min:5|max:30',
            'info' => 'nullable|max:300',
            'stock_type' => 'required|in:IN,OUT',
            'public' => 'sometimes|nullable|in:TRUE,FALSE',
            'id' => 'sometimes|numeric|unique:document_types,id',
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'Pershrkimi',
            'info' => 'Info shtese',
            'public' => 'Public',
            'stock_type' => 'Veprimi ne stok',

            'id' => 'Numri uni/identifikues i dokumentit',


        ];
    }
}

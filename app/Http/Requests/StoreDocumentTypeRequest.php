<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreDocumentTypeRequest extends FormRequest
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

            'name' => 'required|max:30',
            'info' => 'nullable|max:300',
            'public' => 'nullable|max:30',
            'id' => 'sometimes|unique:document_types,id',
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'Pershrkimi',
            'info' => 'Info shtese',
            'public' => 'Public',
            'id' => 'Numri uni/identifikues i dokumentit',


        ];
    }
}

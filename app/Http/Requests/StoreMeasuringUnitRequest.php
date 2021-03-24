<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreMeasuringUnitRequest extends FormRequest
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

            'name' => 'required|min:2|max:30',
            'info' => 'max:300',
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'Emri',
            'info' => 'Info shtese',


        ];
    }
}

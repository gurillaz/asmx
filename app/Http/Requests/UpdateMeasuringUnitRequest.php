<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateMeasuringUnitRequest extends FormRequest
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

        $unit = $this->route('measuringUnit');
        return [

            'name'=>'required|min:3|max:100|unique:measuring_units,name,'.$unit->id,
            'info'=>'max:300',
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

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateProductCategoryRequest extends FormRequest
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

        $category = $this->route('category');
        return [

            'name'=>'required|min:3|max:100|unique:categories,name,'.$category->id,
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'Emri',


        ];
    }
}

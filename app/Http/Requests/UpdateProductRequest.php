<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateProductRequest extends FormRequest
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


        $product = $this->route('product');
        return [




            'name' => 'required|min:3|max:150',
            'second_name' => 'sometimes|required|min:3|max:150',
            'stock_no' => 'required|unique:products,stock_no,'.$product->id.'|min:2|max:100',
            'supplier_no' => 'required|min:2|max:100',
            'original_no' => 'required|min:2|max:254',
            'producer_no' => 'required|min:2|max:100',
            'barcode' => 'sometimes|required|min:3|max:150',

            'quality' => 'required|in:I pacaktuar,1,2,3,4,5',
            'weight' => 'sometimes|required|numeric|min:0',
            'info' => 'sometimes|required|max:500',
            'pieces_in_set' => 'sometimes|required|numeric|min:1',
            'buying_price' => 'required|numeric|min:0',
            'cost' => 'required|numeric|min:0',
            'tax_rate' => 'required|numeric|min:0|max:100',


            // 'stock' => 'required|numeric|min:0',
            'minimal_stock' => 'present|required|numeric|min:0',
            'maximal_stock' => 'present|required_with:minimal_stock|numeric|min:0|gte:minimal_stock',

            'active' => 'sometimes|required|in:TRUE,FALSE',
            'public' => 'sometimes|required|in:TRUE,FALSE',



            'brand_id' => 'required|exists:brands,id',
            'category_id' => 'required|exists:categories,id',
            'measuring_unit_id' => 'required|exists:measuring_units,id',
            'supplier_id' => 'required|exists:subjects,id',


        ];
    }

    public function attributes()
    {
        return [
            'name' => 'Emri',
            'second_name' => 'Gjuha e dyte',
            'stock_no' => 'Numri i stokut',
            'supplier_no' => 'Numri i furnizuesit',
            'producer_no' => 'Numri i prodhuesit',
            'barcode' => 'Barkodi',

            'quality' => 'Kualiteti',
            'weight' => 'Pesha',
            'info' => 'Te dhena shtese',
            'pieces_in_set' => 'Sasia ne set',
            'buying_price' => 'Cmimi i blerjes',
            'cost' => 'Kosto e furnizimit',
            'tax_rate' => 'TVSH',


            // 'stock' => 'required|numeric|min:0',
            'minimal_stock' => 'Stoku minimal',
            'maximal_stock' => 'Stoku maksimal',
            'active' => 'Statusi',
            'public' => 'P',



            'brand_id' => 'Brendi',
            'category_id' => 'Kategoria',
            'measuring_unit_id' => 'Njesia matese',
            'supplier_id' => 'Furnitori',

        ];
    }
}

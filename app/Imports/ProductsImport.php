<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
// use Maatwebsite\Excel\Concerns\SkipsEmptyRows;

use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;

use App\Product;

class ProductsImport implements ToModel, WithCalculatedFormulas, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {

        // if (array_filter($row)) {
        //     return null;
        // }
        $category_id = request()->get('category_id');
        $supplier_id = request()->get('supplier_id');
        $brand_id = request()->get('brand_id');
        $measuring_unit = request()->get('measuring_unit');
        $quality = request()->get('quality');
        $user_id = request()->user()->id;


        return new Product([
            'name'  => $row['name'],
            'producer_no'  => $row['producer_no'],
            'supplier_no'  => $row['supplier_no'],
            'stock_no' => $row['stock_no'],
            'original_no'    => $row['original_no'],
            'barcode'    => $row['barcode'],
            'buying_price'    => $row['buying_price'],
            'cost'    => $row['cost'],
            'tax_rate'    => $row['tax_rate'],
            'fixed_selling_price'    => $row['fixed_selling_price'],


            'category_id' => $category_id,
            'supplier_id' => $supplier_id,
            'brand_id' => $brand_id,
            'measuring_unit' => $measuring_unit,
            'quality' => $quality,
            'user_id' => $user_id,


        ]);
    }
}

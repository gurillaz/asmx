<?php

namespace App\Http\Controllers;

use App\Brand;
use App\Category;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Product;
use App\Imports\ProductsImport;
use App\MeasuringUnit;
use App\PriceLevel;
use App\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Inertia\Inertia;

use Maatwebsite\Excel\Facades\Excel;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        dd("Te gjitha produktet");
    }


    /**
     * Display a import products with excel form.
     *
     * @return \Illuminate\Http\Response
     */
    public function import_create()
    {
        $suppliers = Subject::select(['id', 'name', 'user_id'])->where('subject_type', 'supplier')->get();
        $units = MeasuringUnit::select(['id', 'name'])->get();
        $brands = Brand::select(['id', 'name'])->get();
        $categories = Category::select(['id', 'name'])->get();

        $price_levels = PriceLevel::select(['id', 'name'])->get();

        $quality =  [
            ['value' => 'I pacaktuar'],
            ['value' => '1'],
            ['value' => '2'],
            ['value' => '3'],
            ['value' => '4'],
            ['value' => '5'],
        ];


        return Inertia::render(
            'Product/Import',
            [
                'categories' => $categories,
                'brands' => $brands,
                'suppliers' => $suppliers,
                'price_levels' => $price_levels,
                'units' => $units,
                'quality' => $quality
            ]
        );
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $suppliers = Subject::select(['id', 'name', 'user_id'])->where('subject_type', 'supplier')->get();
        $units = MeasuringUnit::select(['id', 'name'])->get();
        $brands = Brand::select(['id', 'name'])->get();
        $categories = Category::select(['id', 'name'])->get();

        $price_levels = PriceLevel::select(['id', 'name'])->get();


        $quality =  [
            ['value' => 'I pacaktuar'],
            ['value' => '1'],
            ['value' => '2'],
            ['value' => '3'],
            ['value' => '4'],
            ['value' => '5'],
        ];



        return Inertia::render('Product/New', [
            'suppliers' => $suppliers,
            'units' => $units,
            'brands' => $brands,
            'categories' => $categories,
            'price_levels' => $price_levels,
            'quality' => $quality,

        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductRequest $request)
    {
        $request->validated();



        $product = new Product();
        $product->name = $request->input('name');
        $product->second_name = $request->input('second_name');
        $product->stock_no = $request->input('stock_no');
        $product->supplier_no = $request->input('supplier_no');
        $product->original_no = $request->input('original_no');
        $product->producer_no = $request->input('producer_no');
        $product->barcode = $request->input('barcode');
        $product->quality = $request->input('quality');
        $product->weight = $request->input('weight')?$request->input('weight'):0;
        $product->info = $request->input('info');
        $product->pieces_in_set = $request->input('pieces_in_set')?$request->input('pieces_in_set'):1;
        $product->buying_price = $request->input('buying_price');
        $product->cost = $request->input('cost');
        $product->tax_rate = $request->input('tax_rate');

        $product->stock = 0;
        $product->minimal_stock = $request->input('minimal_stock')?$request->input('minimal_stock'):1;
        $product->maximal_stock = $request->input('maximal_stock')?$request->input('maximal_stock'):1;

        $product->public = $request->input('public')?$request->input('public'):TRUE;
        $product->active = TRUE;

        $product->brand_id = $request->input('brand_id');
        $product->category_id = $request->input('category_id');
        $product->measuring_unit_id = $request->input('measuring_unit_id');
        $product->supplier_id = $request->input('supplier_id');

        $product->user_id = $request->user()->id;

        $product->save();
        return redirect('product/'.$product->id)->with(['success' => 'Artikulli i ri u raujt!']);



    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store_api(StoreProductRequest $request)
    {
        $request->validated();



        $product = new Product();
        $product->name = $request->input('name');
        $product->second_name = $request->input('second_name');
        $product->stock_no = $request->input('stock_no');
        $product->supplier_no = $request->input('supplier_no');
        $product->original_no = $request->input('original_no');
        $product->producer_no = $request->input('producer_no');
        $product->barcode = $request->input('barcode');
        $product->quality = $request->input('quality');
        $product->weight = $request->input('weight')?$request->input('weight'):0;
        $product->info = $request->input('info');
        $product->pieces_in_set = $request->input('pieces_in_set')?$request->input('pieces_in_set'):1;
        $product->buying_price = $request->input('buying_price');
        $product->cost = $request->input('cost');
        $product->tax_rate = $request->input('tax_rate');

        $product->stock = 0;
        $product->minimal_stock = $request->input('minimal_stock')?$request->input('minimal_stock'):1;
        $product->maximal_stock = $request->input('maximal_stock')?$request->input('maximal_stock'):1;

        $product->public = $request->input('public')?$request->input('public'):TRUE;
        $product->active = TRUE;

        $product->brand_id = $request->input('brand_id');
        $product->category_id = $request->input('category_id');
        $product->measuring_unit_id = $request->input('measuring_unit_id');
        $product->supplier_id = $request->input('supplier_id');

        $product->user_id = $request->user()->id;

        $product->save();


        return Response::json([
            'product_id' => $product->id,
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show($product_id)
    {

        $product = Product::where('id', $product_id)
            ->with('places')
            ->first();
        if (!$product) {
            return redirect('product')->withErrors(['not_found' => 'Produkti nuk u gjet!']);
            // dd('Oferta nuk u gjet');
        }



        $suppliers = Subject::select(['id', 'name', 'user_id'])->get();
        $units = MeasuringUnit::select(['id', 'name'])->get();
        $brands = Brand::select(['id', 'name'])->get();
        $categories = Category::select(['id', 'name'])->get();

        $price_levels = PriceLevel::select(['id', 'name'])->get();


        $quality =  [
            ['value' => 'I pacaktuar'],
            ['value' => '1'],
            ['value' => '2'],
            ['value' => '3'],
            ['value' => '4'],
            ['value' => '5'],
        ];


        return Inertia::render('Product/View', [
            'product' => $product,

            'suppliers' => $suppliers,
            'units' => $units,
            'brands' => $brands,
            'categories' => $categories,
            'price_levels' => $price_levels,
            'quality' => $quality,

        ]);
    }
    /**
     * Show the last created product.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */

    public function show_last_product()
    {
        $last_product = Product::latest()->first();

        // dd($last_offer);
        return $this->show($last_product->id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        $request->validated();



        $product->name = $request->input('name');
        $product->second_name = $request->input('second_name');
        $product->stock_no = $request->input('stock_no');
        $product->supplier_no = $request->input('supplier_no');
        $product->original_no = $request->input('original_no');
        $product->producer_no = $request->input('producer_no');
        $product->barcode = $request->input('barcode');
        $product->quality = $request->input('quality');
        $product->weight = $request->input('weight')?$request->input('weight'):0;
        $product->info = $request->input('info');
        $product->pieces_in_set = $request->input('pieces_in_set')?$request->input('pieces_in_set'):1;
        $product->buying_price = $request->input('buying_price');
        $product->cost = $request->input('cost');
        $product->tax_rate = $request->input('tax_rate');

        $product->minimal_stock = $request->input('minimal_stock')?$request->input('minimal_stock'):1;
        $product->maximal_stock = $request->input('maximal_stock')?$request->input('maximal_stock'):1;

        $product->public = $request->input('public')?$request->input('public'):TRUE;
        $product->active = TRUE;

        $product->brand_id = $request->input('brand_id');
        $product->category_id = $request->input('category_id');
        $product->measuring_unit_id = $request->input('measuring_unit_id');
        $product->supplier_id = $request->input('supplier_id');

        $product->user_id = $request->user()->id;

        $product->save();

        return redirect('product/'.$product->id)->with(['success' => 'Te dhenat u ruajten!']);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }
}

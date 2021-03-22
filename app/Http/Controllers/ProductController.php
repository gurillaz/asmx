<?php

namespace App\Http\Controllers;

use App\Brand;
use App\Category;
use App\Product;
use App\Supplier;
use App\Imports\ProductsImport;
use Illuminate\Http\Request;
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
        //
    }


        /**
     * Display a import products with excel form.
     *
     * @return \Illuminate\Http\Response
     */
    public function import_create()
    {
        $categories = Category::all();
        $brands = Brand::all();
        $suppliers = Supplier::query()->with('subject:id,name,city')->get();



        return Inertia::render('Product/Import', ['categories' => $categories, 'brands'=>$brands,'suppliers'=>$suppliers]);
    }

            /**
     * Display a import products with excel form.
     *
     * @return \Illuminate\Http\Response
     */
    public function import_store(Request $request)
    {

        // dd($request->file('file'));
        Excel::import(new ProductsImport, $request->file('file'));

        return(Product::all());
        // return Inertia::render('Product/Import', ['categories' => $categories, 'brands'=>$brands,'suppliers'=>$suppliers]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $suppliers = Supplier::select(['id', 'subject_id'])->with('subject:id,name')->get();
        return Inertia::render('Product/New', ['suppliers' => $suppliers]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        dd($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
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
    public function update(Request $request, Product $product)
    {
        //
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

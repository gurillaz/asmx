<?php

namespace App\Http\Controllers;

use App\Brand;
use App\Http\Requests\StoreBrandRequest;
use App\Http\Requests\UpdateBrandRequest;
use App\Supplier;
use Illuminate\Http\Request;
use Inertia\Inertia;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $brands = Brand::query()
        // ->withCount('products')
            // ->with('subject:id,name,city,fiscal_no')
            // ->withCount('suppliers')
            // ->select(['id','name', 'producing_company', 'producing_country','created_at'])

            ->orderBy('created_at', 'DESC')->get();
        // dd($brands);
        return Inertia::render('Brand/Index', ['brands' => $brands]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $suppliers = Supplier::select(['id', 'subject_id'])->with('subject:id,name')->get();
        return Inertia::render('Brand/New', ['suppliers' => $suppliers]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBrandRequest $request)
    {

        $request->validated();


        // producing_company: "",
        // producing_country: "",
        // supplier_ids: [],

        $brand  = new Brand();
        $brand->name = $request->input('name');
        $brand->producing_company = $request->input('producing_company');
        $brand->producing_country = $request->input('producing_country');
        $brand->user_id = $request->user()->id;
        $brand->save();


        if ($request->input('supplier_ids') != null) {

            $brand->suppliers()->sync($request->input('supplier_ids'));
    }



        return redirect('/brand')->with('success','Brendi u shtua.');;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function show(Brand $brand)
    {
        $suppliers = Supplier::select(['id', 'subject_id'])->with('subject:id,name')->get();

        // $brand = Brand::where('id',$brand_id)->with('suppliers:id')->first();
        // $brand->suppliers = $brand->suppliers->map(function($supplier){
        //     return $supplier->id;
        // });


        return Inertia::render('Brand/View', ['suppliers' => $suppliers, 'brand' => $brand]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function edit(Brand $brand)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBrandRequest $request, Brand $brand)
    {

        $request->validated();



        $brand->name = $request->input('name');
        $brand->producing_company = $request->input('producing_company');
        $brand->producing_country = $request->input('producing_country');
        $brand->user_id = $request->user()->id;
        $brand->save();


        if ($request->input('supplier_ids') != null) {

                $brand->suppliers()->sync($request->input('supplier_ids'));
        }


        return redirect('/brand')->with('success','Ndryshimet u ruajten.');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function destroy(Brand $brand)
    {
        //
    }
}

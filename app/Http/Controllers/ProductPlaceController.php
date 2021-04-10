<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductPlaceRequest;
use App\ProductPlace;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class ProductPlaceController extends Controller
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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductPlaceRequest $request)
    {
        $request->validated();

        $place = new ProductPlace();
        $place->product_id = $request->get('product_id');
        $place->place_no = $request->get('place_no');
        $place->comment = $request->get('comment');
        $place->user_id = $request->user()->id;
        $place->save();


        return Response::json([
            'place' => $place,
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ProductPlace  $productPlace
     * @return \Illuminate\Http\Response
     */
    public function show(ProductPlace $productPlace)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ProductPlace  $productPlace
     * @return \Illuminate\Http\Response
     */
    public function edit(ProductPlace $productPlace)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ProductPlace  $productPlace
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProductPlace $productPlace)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ProductPlace  $productPlace
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductPlace $productPlace)
    {
        $productPlace->delete();

        return Response::json([
            'message' => "Product place deleted",
        ], 200);
    }
}

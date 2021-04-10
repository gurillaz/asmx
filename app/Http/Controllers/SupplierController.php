<?php

namespace App\Http\Controllers;

use App\PriceLevel;
use App\Subject;
use Illuminate\Http\Request;
use Inertia\Inertia;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        // $table->string('first_name');
        // $table->string('last_name');
        // $table->string('phone_1');
        // $table->string('phone_2')->nullable();
        // $table->string('email')->nullable();
        // $table->string('website')->nullable();
        // $table->text('info')->nullable();

        // $table->unsignedBigInteger('subject_id');
        // $table->unsignedBigInteger('user_id');
        // $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade');


        // $table->foreign('subject_id')->references('id')->on('subjects')->onUpdate('cascade');
        // $table->timestamps();

        $suppliers = Subject::query()
            ->where('subject_type', 'supplier')
            ->get();


        return Inertia::render('Supplier/Index', ['suppliers' => $suppliers]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $price_levels = PriceLevel::query()
            ->select(['id', 'name'])
            ->get();

        $subject_types =  [
            ['value' => 'client', 'text' => "Klient"],
            ['value' => 'supplier', 'text' => "Furnitor"],
            ['value' => 'other', 'text' => "Tjeter"],
        ];

        $subject_type = "supplier";

        return Inertia::render('Subject/New', [
            'price_levels' => $price_levels,
            'subject_types' => $subject_types,
            'subject_type' => $subject_type
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Subject  $supplier
     * @return \Illuminate\Http\Response
     */
    public function show($supplier_id)
    {

        $supplier = Subject::query()
            ->where('subject_type', 'supplier')
            ->where('id', $supplier_id)
            ->with('products')
            ->first();
        if (!$supplier) {
            return redirect('supplier')->withErrors(['not_found' => 'Furnitori nuk u gjet!']);
        }


        $price_levels = PriceLevel::query()
            ->select(['id', 'name'])
            ->get();

        $subject_types =  [
            ['value' => 'client', 'text' => "Klient"],
            ['value' => 'supplier', 'text' => "Furnitor"],
            ['value' => 'other', 'text' => "Tjeter"],
        ];

        $subject_type = "supplier";





        return Inertia::render('Supplier/View', [
            'supplier' => $supplier,
            'price_levels' => $price_levels,
            'subject_types' => $subject_types,
            'subject_type' => $subject_type
        ]);
    }

        /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Subject  $supplier
     * @return \Illuminate\Http\Response
     */
    public function supplier_products(Subject $supplier)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Subject  $supplier
     * @return \Illuminate\Http\Response
     */
    public function edit(Subject $supplier)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Subject  $supplier
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Subject $supplier)
    {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Subject  $supplier
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subject $supplier)
    {
        //
    }
}

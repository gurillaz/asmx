<?php

namespace App\Http\Controllers;

use App\Supplier;
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

        $suppliers = Supplier::query()
        ->with('subject:id,name,city,fiscal_no')
        ->select(['id','first_name', 'last_name', 'subject_id','email','phone_1'])
        ->get();

        return Inertia::render('Subject/Supplier/Index', ['suppliers' => $suppliers]);
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function show(Supplier $supplier)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function edit(Supplier $supplier)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Supplier $supplier)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function destroy(Supplier $supplier)
    {
        //
    }
}

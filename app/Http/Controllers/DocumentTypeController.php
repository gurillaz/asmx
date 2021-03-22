<?php

namespace App\Http\Controllers;

use App\DocumentType;
use App\Http\Requests\UpdateBrandRequest;
use App\Http\Requests\UpdateDocumentTypeRequest;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DocumentTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $document_types = DocumentType::all();

        return Inertia::render('DocumentType/Index',['document_types'=>$document_types]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('DocumentType/New');


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
     * @param  \App\DocumentType  $documentType
     * @return \Illuminate\Http\Response
     */
    public function show(DocumentType $documentType)
    {


        return Inertia::render('DocumentType/View',['document_type' => $documentType]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\DocumentType  $documentType
     * @return \Illuminate\Http\Response
     */
    public function edit(DocumentType $documentType)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\DocumentType  $documentType
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDocumentTypeRequest $request, DocumentType $documentType)
    {
        $request->validated();



        $documentType->name = $request->input('name');
        $documentType->info = $request->input('info');
        $documentType->public = $request->input('public');
        $documentType->stock_type = $request->input('stock_type');
        $documentType->user_id = $request->user()->id;
        $documentType->save();




        return redirect('/document-type')->with('success','Ndryshimet u ruajten.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\DocumentType  $documentType
     * @return \Illuminate\Http\Response
     */
    public function destroy(DocumentType $documentType)
    {
        //
    }
}

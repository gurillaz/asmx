<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreInvoiceMessageRequest;
use App\Http\Requests\UpdateInvoiceMessageRequest;
use App\InvoiceMessage;
use Illuminate\Http\Request;
use Inertia\Inertia;

class InvoiceMessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $messages = InvoiceMessage::query()

        ->orderBy('created_at', 'DESC')->get();

        return Inertia::render('Invoice/Message/Index', ['messages' => $messages]);
        // return Inertia::render('Product/Category/Index', ['categories' => $categories]);

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
    public function store(StoreInvoiceMessageRequest $request)
    {
        $request->validated();

        $message = new InvoiceMessage();
        $message->text = $request->input('text');
        $message->user_id = $request->user()->id;


        $message->save();

        return redirect('invoice/message')->with('success','Mesazhi u shtua!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\InvoiceMessage  $message
     * @return \Illuminate\Http\Response
     */
    public function show(InvoiceMessage $message)
    {   
        return Inertia::render('Invoice/Message/View', ['message' => $message]);
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\InvoiceMessage  $message
     * @return \Illuminate\Http\Response
     */
    public function edit(InvoiceMessage $message)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\InvoiceMessage  $message
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateInvoiceMessageRequest $request, InvoiceMessage $message)
    {
        $request->validated();



        $message->text = $request->input('text');
        $message->user_id = $request->user()->id;
        $message->save();




        return redirect('/invoice/message')->with('success','Ndryshimet u ruajten.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\InvoiceMessage  $message
     * @return \Illuminate\Http\Response
     */
    public function destroy(InvoiceMessage $message)
    {
        //
    }
}

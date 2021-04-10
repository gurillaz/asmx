<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSubjectRequest;
use App\Http\Requests\UpdateSubjectRequest;
use App\PriceLevel;
use App\Subject;
use Illuminate\Http\Request;
use Inertia\Inertia;

class SubjectController extends Controller
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
    public function create(Request $request)
    {
        $price_levels = PriceLevel::query()
            ->select(['id', 'name'])
            ->get();

        $subject_types =  [
            ['value' => 'client', 'text' => "Klient"],
            ['value' => 'supplier', 'text' => "Furnitor"],
            ['value' => 'other', 'text' => "Tjeter"],
        ];

        return Inertia::render('Subject/New', [
            'price_levels' => $price_levels,
            'subject_types' => $subject_types
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSubjectRequest $request)
    {
        $request->validated();

        $new_subject = new Subject();

        $new_subject->subject_type = $request->input('subject_type');
        $new_subject->name = $request->input('name');
        $new_subject->address = $request->input('address');
        $new_subject->city = $request->input('city');
        $new_subject->postal_code = $request->input('postal_code');
        $new_subject->country = $request->input('country');
        $new_subject->info = $request->input('info');

        $new_subject->contact_name = $request->input('contact_name');
        $new_subject->phone_1 = $request->input('phone_1');
        $new_subject->phone_2 = $request->input('phone_2');
        $new_subject->email = $request->input('email');
        $new_subject->website = $request->input('website');

        $new_subject->price_level_id = $request->input('price_level_id');
        $new_subject->price_increase_quota = $request->input('price_increase_quota')? $request->input('price_increase_quota'):1 ;
        $new_subject->credit_limit = $request->input('credit_limit')? $request->input('credit_limit'):0;
        $new_subject->payment_limit_days = $request->input('payment_limit_days')? $request->input('payment_limit_days'):0;

        $new_subject->fiscal_no = $request->input('fiscal_no');
        $new_subject->bank_name = $request->input('bank_name');
        $new_subject->bank_account_no = $request->input('bank_account_no');


        $new_subject->user_id = $request->user()->id;

        $new_subject->save();

        if ($new_subject->subject_type == 'client') {
            return redirect('/client')->with('success','Klienti u ruajt.');

        }
        else if ($new_subject->subject_type == 'supplier') {
            return redirect('/supplier')->with('success','Furnitori u ruajt.');

        }
        else {
            return redirect('/')->with('success','Subjekti u ruajt.');

        }


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function show(Subject $subject)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function edit(Subject $subject)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSubjectRequest $request, Subject $subject)
    {
        $request->validated();


        $subject->subject_type = $request->input('subject_type');
        $subject->name = $request->input('name');
        $subject->address = $request->input('address');
        $subject->city = $request->input('city');
        $subject->postal_code = $request->input('postal_code');
        $subject->country = $request->input('country');
        $subject->info = $request->input('info');

        $subject->contact_name = $request->input('contact_name');
        $subject->phone_1 = $request->input('phone_1');
        $subject->phone_2 = $request->input('phone_2');
        $subject->email = $request->input('email');
        $subject->website = $request->input('website');

        $subject->price_level_id = $request->input('price_level_id');
        $subject->price_increase_quota = $request->input('price_increase_quota')? $request->input('price_increase_quota'):1 ;
        $subject->credit_limit = $request->input('credit_limit')? $request->input('credit_limit'):0;
        $subject->payment_limit_days = $request->input('payment_limit_days')? $request->input('payment_limit_days'):0;

        $subject->fiscal_no = $request->input('fiscal_no');
        $subject->bank_name = $request->input('bank_name');
        $subject->bank_account_no = $request->input('bank_account_no');


        $subject->user_id = $request->user()->id;

        $subject->save();

        if ($subject->subject_type == 'client') {
            return redirect('/client')->with('success','Ndryshimet u ruajten.');

        }
        else if ($subject->subject_type == 'supplier') {
            return redirect('/supplier')->with('success','Ndryshimet u ruajten.');

        }
        else {
            return redirect('/')->with('success','Ndryshimet u ruajten.');

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subject $subject)
    {
        //
    }
}

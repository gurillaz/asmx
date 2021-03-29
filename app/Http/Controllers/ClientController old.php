<?php

namespace App\Http\Controllers;

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
        $Subjects = Subject::query()
        ->where('subject_type','client')
        ->with('price_level:id,name')
        ->select(['id','name','city','fiscal_no','first_name', 'last_name', 'price_level_id', 'subject_id','phone_1'])
        ->get();

        return Inertia::render('Subject/Subject/Index', ['Subjects' => $Subjects]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $price_leveles = PriceLevel::all();

        return Inertia::render('Subject/Subject/New', ['offer' => $price_leveles]);

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
     * @param  \App\Subject  $Subject
     * @return \Illuminate\Http\Response
     */
    public function show(Subject $Subject)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Subject  $Subject
     * @return \Illuminate\Http\Response
     */
    public function edit(Subject $Subject)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Subject  $Subject
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Subject $Subject)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Subject  $Subject
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subject $Subject)
    {
        //
    }
}

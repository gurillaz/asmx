<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMeasuringUnitRequest;
use App\Http\Requests\UpdateMeasuringUnitRequest;
use App\MeasuringUnit;
use Illuminate\Http\Request;
use Inertia\Inertia;

class MeasuringUnitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $units = MeasuringUnit::query()
            ->orderBy('created_at', 'DESC')->get();

        return Inertia::render('Product/Unit/Index', ['units' => $units]);
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
    public function store(StoreMeasuringUnitRequest $request)
    {
        $request->validated();

        $new_unit = new MeasuringUnit();
        $new_unit->name = $request->input('name');
        $new_unit->info = $request->input('info');
        $new_unit->user_id = $request->user()->id;


        $new_unit->save();

        return redirect('product/unit')->with('success','Njesia matese u shtua!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\MeasuringUnit  $measuringUnit
     * @return \Illuminate\Http\Response
     */
    public function show(MeasuringUnit $measuringUnit)
    {
        return Inertia::render('Product/Unit/View', ['unit' => $measuringUnit]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\MeasuringUnit  $measuringUnit
     * @return \Illuminate\Http\Response
     */
    public function edit(MeasuringUnit $measuringUnit)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\MeasuringUnit  $measuringUnit
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMeasuringUnitRequest $request, MeasuringUnit $measuringUnit)
    {
        $request->validated();



        $measuringUnit->name = $request->input('name');
        $measuringUnit->info = $request->input('info');
        $measuringUnit->user_id = $request->user()->id;
        $measuringUnit->save();




        return redirect('/product/unit')->with('success','Ndryshimet u ruajten.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\MeasuringUnit  $measuringUnit
     * @return \Illuminate\Http\Response
     */
    public function destroy(MeasuringUnit $measuringUnit)
    {
        //
    }
}

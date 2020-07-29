<?php

namespace App\Http\Controllers;

use App\Transportation;
use Illuminate\Http\Request;

class TransportationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $routes = Transportation::where("school_id" ,\Auth::user()->school_id)->get();

        return view("transportation.index",compact('routes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

        //dd($request);
        $school_id = \Auth::user()->school_id;
        $transportation = new Transportation();
        $transportation->name = $request->input('name');
        $transportation->number = $request->input('number');
        $transportation->school_id = $school_id;
        $transportation->ph_number = $request->input('ph_number');
        $transportation->save();

        return redirect("/transportation");

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
     * @param  \App\Transportation  $transportation
     * @return \Illuminate\Http\Response
     */
    public function show(Transportation $transportation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Transportation  $transportation
     * @return \Illuminate\Http\Response
     */
    public function edit(Transportation $transportation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Transportation  $transportation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transportation $transportation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Transportation  $transportation
     * @return \Illuminate\Http\Response
     */
    public function destroy($transportation_id)
    {
        Transportation::where('id',$transportation_id)->delete();
        return redirect("/transportation");
    }
}

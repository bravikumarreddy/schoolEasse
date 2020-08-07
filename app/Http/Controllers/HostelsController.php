<?php

namespace App\Http\Controllers;

use App\Hostels;
use Illuminate\Http\Request;

class HostelsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $rooms = Hostels::where("school_id" ,\Auth::user()->school_id)->get();
        return view("hostel.index",compact('rooms'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //
        $school_id = \Auth::user()->school_id;
        $hostel = new Hostels();
        $hostel->name = $request->input('name');
        $hostel->room_type = $request->input('room_type');
        $hostel->cost = $request->input('cost');
        $hostel->school_id = $school_id;
        $hostel->beds = $request->input('beds');
        $hostel->save();

        return redirect("/hostel");
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
     * @param  \App\Hostels  $hostels
     * @return \Illuminate\Http\Response
     */
    public function show(Hostels $hostels)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Hostels  $hostels
     * @return \Illuminate\Http\Response
     */
    public function edit(Hostels $hostels)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Hostels  $hostels
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Hostels $hostels)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Hostels  $hostels
     * @return \Illuminate\Http\Response
     */
    public function destroy($hostel_id)
    {
        //
        Hostels::where('id',$hostel_id)->delete();
        return redirect("/hostel");
    }
}

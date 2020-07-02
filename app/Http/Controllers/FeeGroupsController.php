<?php

namespace App\Http\Controllers;

use App\fee_structure;
use App\FeeGroups;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FeeGroupsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $fee_groups = FeeGroups::where("school_id","=",Auth::user()->school_id)->get()->all();
        $fee_groups = json_encode($fee_groups);
        return view("fees.fee_groups",compact("fee_groups"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

        $fee_group = new FeeGroups();
        $fee_group->name = $request->input('name');
        $fee_group->school_id = Auth::user()->school_id;
        $fee_group->save();

        return redirect('/fees/fee_groups');
    }
    public function getFeeStructures(Request $request,$fee_group_id){
        $fee_structures = fee_structure::where("fee_group_id","=",$fee_group_id)->get()->all();

        return json_encode($fee_structures);
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
     * @param  \App\FeeGroups  $feeGroups
     * @return \Illuminate\Http\Response
     */
    public function show(FeeGroups $feeGroups)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\FeeGroups  $feeGroups
     * @return \Illuminate\Http\Response
     */
    public function edit(FeeGroups $feeGroups)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\FeeGroups  $feeGroups
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FeeGroups $feeGroups)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\FeeGroups  $feeGroups
     * @return \Illuminate\Http\Response
     */
    public function destroy(FeeGroups $feeGroups,Request $request)
    {
        $fee_group = FeeGroups::find($request->id);
        $fee_group->delete();

        return redirect('fees/fee_groups');
        //
    }
}

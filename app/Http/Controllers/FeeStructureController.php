<?php

namespace App\Http\Controllers;

use App\fee_structure;
use App\fee_structure_records;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FeeStructureController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $fee_structures = fee_structure::all();
        return view("fees.fee_structures",compact("fee_structures"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //
        if($request->id){
            $records = fee_structure_records::where('fee_structure_id' ,"=",$request->id)->get()->all();
            $fee_structure = fee_structure::find($request->id);


            if(count($records) < 1){
                view("fees.fee_structure_create");
            }
            return view("fees.fee_structure_create",compact("records","fee_structure"));
        }
        return view("fees.fee_structure_create");
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
        if($request->id){
            $id = $request->id;
            fee_structure_records::where('fee_structure_id' ,"=",$request->id)->delete();
            fee_structure::where("id",$request->id)->update(["name"=>$request->input('name')]);
        }
        else {
            $id = fee_structure::create(['name' => $request->input('name'), "school_id" => Auth::user()->school_id])->id;
        }

        $feeNames = $request->input("FeeName");
        $amounts = $request->input("Amount");



        for($i=0 ; $i < count($feeNames); $i++){
            fee_structure_records::create(["fee_structure_id"=>$id,"name"=>$feeNames[$i],"amount"=>$amounts[$i]]);
        }


        return redirect('fees/fee_structures');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function duplicate(Request $request)
    {
        //
        $prev_structure = fee_structure::find($request->id);

        $prev_records  = fee_structure_records::where('fee_structure_id' ,"=",$request->id)->get()->all();

        $id = fee_structure::create(['name' => $prev_structure->name, "school_id" => Auth::user()->school_id])->id;

        for($i=0 ; $i < count($prev_records); $i++){
            fee_structure_records::create(["fee_structure_id"=>$id,"name"=>$prev_records[$i]->name,"amount"=>$prev_records[$i]->amount]);
        }

        $fee_structures = fee_structure::all();

        return redirect('fees/fee_structures');

    }


    /**
     * Display the specified resource.
     *
     * @param  \App\fee_structure  $fee_structure
     * @return \Illuminate\Http\Response
     */
    public function show(fee_structure $fee_structure)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\fee_structure  $fee_structure
     * @return \Illuminate\Http\Response
     */
    public function edit(fee_structure $fee_structure)
    {
        ddd($fee_structure);
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\fee_structure  $fee_structure
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, fee_structure $fee_structure)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\fee_structure  $fee_structure
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,fee_structure $fee_structure)
    {
        //
        $fee_structure = fee_structure::find($request->id);
        $fee_structure->delete();

        return redirect('fees/fee_structures');
    }
}

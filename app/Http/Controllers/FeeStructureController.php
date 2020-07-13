<?php

namespace App\Http\Controllers;

use App\fee_structure;
use App\fee_structure_records;
use App\FeeGroups;
use App\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\User;
use App\School;

class FeeStructureController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("fees.fee_groups");
        //
        //$fee_structures = fee_structure::where("school_id","=",Auth::user()->school_id)->get()->all();

       // return view("fees.fee_structures",compact("fee_structures"));
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
            $instalments = DB::table("instalments")->where("fee_structure_id","=",$request->id)->get()->all();

            if(count($records) < 1){
                view("fees.fee_structure_create");
            }
            return view("fees.fee_structure_create",compact("records","fee_structure","instalments"));
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
        //fee_groups::

        $fee_group_id = $request->input('fee_group_id');

        $fee_structure = new fee_structure();

        $fee_structure->fee_group_id = $fee_group_id;
        $fee_structure->name = $request->input('name');
        $fee_structure->total_instalments = $request->input('totalInstalments');
        $fee_structure->total_amount = $request->input('totalAmount');
        $fee_structure->save();

        $id = $fee_structure->id;



        $feeNames = $request->input("FeeName");
        $amounts = $request->input("Amount");
        $instalments = $request->input("Instalment");
        $instalmentAmount = $request->input("InsAmount");

        $totalAmount = 0;
        for($i=0 ; $i < count($feeNames); $i++){
            fee_structure_records::create(["fee_structure_id"=>$id,"name"=>$feeNames[$i],"amount"=>$amounts[$i]]);
            $totalAmount+=$amounts[$i];
        }

        $instalments_data=[];

        for($i=0;$i<count($instalments);$i++){
            array_push($instalments_data,["fee_structure_id"=>$id,"number"=>$i,"due_date"=>$instalments[$i],"amount"=>$instalmentAmount[$i]]);
        }
        DB::table("instalments")->insert($instalments_data);


        return redirect('fees/fee_groups');
    }

    public function sections(Request $request,$class_id){
        //dd($class_id);
        $sections=Section::where("class_id","=",$class_id)->get()->all();
        return json_encode($sections);
    }

    public function getClassStudents(Request $request,$class_id,$section_id){

        $students_with_section = DB::table('users')->where("school_id","=",Auth::user()->school_id)
            ->join("student_infos","users.id","=","student_infos.student_id")
            ->join("sections","section_id","=","sections.id")
            ->where("section_id","=",$section_id)
            ->get()->all();

        return json_encode($students_with_section);
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

        $prev_instalments = DB::table("instalments")->where("fee_structure_id","=",$request->id)->get()->all();

        $id = fee_structure::create(['name' => $prev_structure->name, "school_id" => Auth::user()->school_id])->id;

        $totalAmount = 0;
        for($i=0 ; $i < count($prev_records); $i++){
            fee_structure_records::create(["fee_structure_id"=>$id,"name"=>$prev_records[$i]->name,"amount"=>$prev_records[$i]->amount]);
            $totalAmount+=$prev_records[$i]->amount;
        }

        $instalments_data=[];
        $instalmentAmount = $totalAmount/count($prev_instalments);
        for($i=0;$i<count($prev_instalments);$i++){
            array_push($instalments_data,["fee_structure_id"=>$id,"number"=>$prev_instalments[$i]->number,"due_date"=>$prev_instalments[$i]->due_date,"amount"=>$instalmentAmount]);
        }
        DB::table("instalments")->insert($instalments_data);

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

        return redirect('fees/fee_groups');
    }
}

<?php

namespace App\Http\Controllers;

use App\fee_structure;
use App\student_instalments;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\User;

class StudentInstalmentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request,$student_id)
    {
        //
        $user = User::where("id","=",$student_id)->first();
        if($user->role != "student"){
            abort(404);
        }
        $fee_structures = fee_structure::where("school_id","=",Auth::user()->school_id)->get()->all();
        $existing = student_instalments::where("student_id","=",$student_id)->get()->pluck('fee_structure_id')->unique()->all();
        $existing_fee_structures = fee_structure::whereIn('id', $existing)->get()->all();
        $fee_list = DB::table('student_instalments')->where("student_id","=",$student_id)
                    ->select('student_instalments.id as student_instalment_id','student_instalments.paid as paid', "fee_structures.*" , "instalments.*"  )
                    ->join( "instalments", "student_instalments.instalment_id","=" ,"instalments.id" )
                    ->join( "fee_structures", "student_instalments.fee_structure_id","=" ,"fee_structures.id" )
            ->get()->all();
         //dd($fee_list);

        return view("fees.student_installment",compact("user","fee_structures","fee_list","existing_fee_structures"));
    }

    public function addFees(Request $request)
    {

        $student_id = $request->student_id;
        $fee_structure_id = $request->fee_structure;
        $check = student_instalments::where("fee_structure_id","=",$fee_structure_id)
            ->where("student_id","=",$student_id)
            ->get()->all();

        if(count($check)>0){
           return redirect()->back()->withErrors(['add'=>'already exists']);
        }

        $instalments= DB::table("instalments")->where("fee_structure_id","=",$fee_structure_id)->get()->all();

        $data=[];

        for($i=0 ; $i < count($instalments); $i++){
            array_push($data,["student_id"=>$student_id,"fee_structure_id"=>$fee_structure_id,"instalment_id"=>$instalments[$i]->id,"paid"=>0]);
        }
        student_instalments::insert($data);


        return redirect('fees/student/'.$student_id);
        //return view("fees.student_installment",compact("user","fee_structures"));
    }
    public function deleteFees(Request $request)
    {

        $student_id = $request->student_id;
        $fee_structure_id = $request->fee_structure;
        student_instalments::where("fee_structure_id","=",$fee_structure_id)
            ->where("student_id","=",$student_id)->delete();
        return redirect('fees/student/'.$student_id);
    }
    public function collectFees(Request $request)
    {

        $student_id = $request->student_id;
        student_instalments::where('id', $request->student_instalment_id)
            ->update(['paid' => 1]);


        return redirect('fees/student/'.$student_id);
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\student_instalments  $student_instalments
     * @return \Illuminate\Http\Response
     */
    public function show(student_instalments $student_instalments)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\student_instalments  $student_instalments
     * @return \Illuminate\Http\Response
     */
    public function edit(student_instalments $student_instalments)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\student_instalments  $student_instalments
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, student_instalments $student_instalments)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\student_instalments  $student_instalments
     * @return \Illuminate\Http\Response
     */
    public function destroy(student_instalments $student_instalments)
    {
        //
    }
}

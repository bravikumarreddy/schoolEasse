<?php

namespace App\Http\Controllers;

use App\fee_structure;
use App\student_instalments;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PaymentsController extends Controller
{
    //
    public function index(Request $request)
    {
        $user = Auth::user();

        $fee_list = DB::table('student_instalments')->where("student_id","=",$user->id)
            ->select('student_instalments.id as student_instalment_id','student_instalments.paid as paid', "fee_structures.*" , "instalments.*"  )
            ->join( "instalments", "student_instalments.instalment_id","=" ,"instalments.id" )
            ->join( "fee_structures", "student_instalments.fee_structure_id","=" ,"fee_structures.id" )
            ->get()->all();



        return view("payments.index",compact("user","fee_list"));
    }
}

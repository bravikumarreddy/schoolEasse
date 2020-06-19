<?php

namespace App\Http\Controllers;

use App\fee_structure;
use App\User;
use Illuminate\Http\Request;
use App\Services\User\UserService;
use App\fee_structure_records;

class FeeCollect extends Controller
{

    protected $userService;
    protected $user;

    public function __construct(UserService $userService, User $user){
        $this->userService = $userService;
        $this->user = $user;
    }

    public function index()
    {
        $students = $this->userService->getAllStudents()->get()->all();
        $fee_structures = fee_structure::all();
        return view("/fees/collect",compact("students","fee_structures"));
    }

    public function print(Request $request)
    {
        $student_name = $request->input('student_name');
        $fee_structure_id = $request->input('fee_structure');
        $records = fee_structure_records::where('fee_structure_id' ,"=",$fee_structure_id)->get();
        $school_name = auth()->user()->school->name;


        return view("/fees/printInvoice",compact("school_name","records","school_name","student_name"));

    }
}

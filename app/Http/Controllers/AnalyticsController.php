<?php

namespace App\Http\Controllers;

use App\student_instalments;
use Illuminate\Http\Request;

class AnalyticsController extends Controller
{
    //
    public function index(Request $request)
    {

        return view("fees.analytics");
    }
}

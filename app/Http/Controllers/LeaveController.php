<?php

namespace App\Http\Controllers;

use App\DailyAttendance;
use App\Leave;
use App\SchoolEvent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LeaveController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $my_leaves =  Leave::where("user_id","=",Auth::user()->id)->get();
        return view('leave.index',compact('my_leaves'));
    }

    public function requests()
    {
        //
        $leaves =  Leave::join('users','users.id','user_id')
            ->select("leaves.*",'users.name as name','users.role as role','users.email as email')
            ->where('school_id',"=",Auth::user()->school_id);

            //->paginate(10);

        if(Auth::user()->role == 'teacher'){

            $leaves = $leaves->where('users.role','=','student')
                ->where("users.section_id","=",Auth::user()->section_id);

        }
        elseif(Auth::user()->role == 'admin'){
            $leaves = $leaves->where('users.role','=','teacher');
        }

        $leaves = $leaves->paginate(10);
        return view('leave.requests',compact('leaves'));
    }


    public function approveRequests(Request $request){

        $user_name = Auth::user()->name;
        Leave::where('id','=',$request->request_id)
            ->update(['status'=> $request->status , 'comment' =>  $request->comment , 'approved_by' =>$user_name ] );

        if($request->status == 'approved') {

            $leave = Leave::where('id', '=', $request->request_id)->first();
            $school_event = new SchoolEvent();
            $school_event->category = 'absent';
            $school_event->school_id = Auth::user()->school_id;
            $school_event->individual_id = $leave->user_id;
            $school_event->title = ' Leave ';
            $school_event->color = '#fcc404';
            $school_event->from = $leave->from;
            $school_event->to = $leave->to;
            $school_event->save();
        }

        if(Auth::user()->role == 'admin')
            return redirect('/leave/requests');
        else
            return redirect('/leave/teacher/requests');

    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //

        $user_id = \Auth::user()->id;
        $status = "applied";
        $leave =  new Leave();
        $leave->from = $request->input('from');
        $leave->to = $request->input('to');
        $leave->reason = $request->input('reason');
        $leave->user_id = $user_id;
        $leave->status = $status;
        $leave->save();
        if(Auth::user()->role =='teacher')
            return redirect('/leave/teacher');
        else
            return   redirect('/leave/student');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Leave  $leave
     * @return \Illuminate\Http\Response
     */
    public function show(Leave $leave)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Leave  $leave
     * @return \Illuminate\Http\Response
     */
    public function edit(Leave $leave)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Leave  $leave
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Leave $leave)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Leave  $leave
     * @return \Illuminate\Http\Response
     */
    public function destroy(Leave $leave)
    {
        //
    }
}

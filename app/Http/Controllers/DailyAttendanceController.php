<?php

namespace App\Http\Controllers;

use App\AttendanceCheck;
use App\DailyAttendance;
use App\Myclass;
use App\SchoolEvent;
use App\StaffAttendance;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DailyAttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        //
        $classes = json_encode( Myclass::query()
            ->bySchool(\Auth::user()->school->id)->get()->all());

        return view('attendance.daily-attendance',compact("classes"));
    }
    public function classSection(Request $request,$class,$section){

        $classes = json_encode( Myclass::query()
            ->bySchool(\Auth::user()->school->id)->get()->all());

        return view('attendance.daily-attendance',compact("classes","class","section"));
    }

    public function takeAttendance(Request $request)
    {

        //dd($request);
        $section_id = $request->input('section');
        $session = $request->input('session');
        $date = $request->input('date');
        $selectStudents =$request->input('selectStudents');
        if($selectStudents==null){
            $selectStudents=[];
        }
        DailyAttendance::where("date" ,"=",$date)
                    ->where("session","=",$session)
                    ->where("section_id","=",$section_id)
                    ->delete();

        AttendanceCheck::where("date" ,"=",$date)
            ->where("session","=",$session)
            ->where("section_id","=",$section_id)
            ->delete();


        $students_with_section = DB::table('users')->where("school_id","=",Auth::user()->school_id)
            ->where('role',"=","student")
            ->whereNotIn("users.id" ,$selectStudents)
            ->join("sections","section_id","=","sections.id")
            ->where("section_id","=",$section_id)
            ->select("users.id as user_id")

            ->get()->all();




        $attendance_check = new AttendanceCheck();
        $attendance_check->user_id =Auth::user()->id;
        $attendance_check->date = $date;
        $attendance_check->section_id = $section_id;
        $attendance_check->session = $session;
        $attendance_check->save();

        for($i=0;$i<count($students_with_section);$i++){
            $daily_attendance_record = new DailyAttendance();
            $daily_attendance_record->student_id = $students_with_section[$i]->user_id;
            $daily_attendance_record->section_id = $section_id;
            $daily_attendance_record->session =  $session;
            $daily_attendance_record->date =  $date;
            $daily_attendance_record->save();

        }

        return redirect('/attendance/daily-attendance');
    }

    public function checkAttendance(Request $request){
        $section_id = $request->input('section_id');
        $session = $request->input('session');
        $date = $request->input('date');

        $user = AttendanceCheck::
            where("date","=",$date)
            ->where("session","=",$session)
            ->where("section_id","=",$section_id)
        ->first();

        if($user != null){
            $user =User::find( $user->user_id)->first()->name;

        }
        return json_encode($user);
    }
    public function student(){

        $role = Auth::user()->role;
        $user_id = Auth::user()->id;
        $school_id = Auth::user()->school_id;
        $all_events = SchoolEvent::where('school_id','=',$school_id)
                        ->where('group_name',"=","all")->get();

        $individual_events = SchoolEvent::where('school_id','=',$school_id)
            ->where('individual_id',"=",$user_id)->get();



        if($role=='student'){

            $section_id = Auth::user()->section_id;
            $classTimeTable = app(TimeTableController::class)->classTimeTable($section_id);

            $absent_details = DailyAttendance::
            where("student_id","=",Auth::user()->id)
                ->get()->all();
            $student_events = SchoolEvent::where('school_id','=',$school_id)
                ->where('group_name',"=","students")->get();

            $section_events = SchoolEvent::where('school_id','=',$school_id)
                ->where('section_id',"=","$section_id")->get();

            return view("attendance.calendar",compact('absent_details',
                'classTimeTable'
                ,'all_events'
                , 'student_events'
                ,'section_events'
                ,'individual_events'

            ));
        }
        else {
            $user_id = Auth::user()->id;
            $absent_details = StaffAttendance::
            where("user_id","=", $user_id)
                ->get()->all();

            if($role == 'teacher'){

                $teacher_events = SchoolEvent::where('school_id','=',$school_id)
                    ->where('group_name',"=","teacher")->get();
                $teacherTimeTable = app(TimeTableController::class)->teacherTimeTable( $user_id);


                return view("attendance.calendar",compact(
                    'absent_details',
                    'teacherTimeTable',
                    'all_events',
                    'teacher_events',
                    'individual_events'


                ));

            }

            $staff_events = SchoolEvent::where('school_id','=',$school_id)
                ->where('group_name',"=","staff")->get();

            return view("attendance.calendar",compact('absent_details',
            'all_events'
            ,'staff_events'
                ,'individual_events'
            ));
        }


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
     * @param  \App\DailyAttendance  $dailyAttendance
     * @return \Illuminate\Http\Response
     */
    public function show(DailyAttendance $dailyAttendance)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\DailyAttendance  $dailyAttendance
     * @return \Illuminate\Http\Response
     */
    public function edit(DailyAttendance $dailyAttendance)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\DailyAttendance  $dailyAttendance
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DailyAttendance $dailyAttendance)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\DailyAttendance  $dailyAttendance
     * @return \Illuminate\Http\Response
     */
    public function destroy(DailyAttendance $dailyAttendance)
    {
        //
    }
}

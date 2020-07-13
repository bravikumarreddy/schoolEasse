<?php

namespace App\Http\Controllers;

use App\Department;
use App\StaffAttendance;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class StaffAttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function apiGetDepartments(){

        $departments = Department::where('school_id',"=",Auth::user()->school_id)->get();
        //dd($departments);
        return json_encode($departments);

    }
    public function  apiGetTeachers(Request $request){
        $department = $request->input('department_id');
        $teachers = User:: where('school_id',"=",Auth::user()->school_id)
            ->where('role',"=",'teacher')
            ->where('department_id',"=",$department)->get();
        return json_encode($teachers);
    }

    public function  apiGetStaff(Request $request){

        $staff = User::whereNotIn('role',['teacher','student'])
                    ->where('school_id',"=",Auth::user()->school_id)->get();
        return json_encode($staff);
    }

    public function teacherAttendance()
    {
        return view('attendance.teacher-attendance');
    }

    public function takeTeacherAttendance(Request $request){

        $date = $request->input('date');
        $department_id = $request->input('department');
        $session = $request->input('session');
        $selectTeachersList =$request->input('selectTeachersList');
        if($selectTeachersList==null){
            $selectTeachersList=[];
        }

        $teachers = DB::table('users')->where("school_id","=",Auth::user()->school_id)
                    ->where('role',"=","teacher")
                    ->where('department_id','=',$department_id)
                    ->whereNotIn("users.id" ,$selectTeachersList)
                    ->get()->all();

        for($i=0;$i<count($teachers);$i++){
            $teacher_attendance_record = new StaffAttendance();
            $teacher_attendance_record->user_id = $teachers[$i]->id;
            $teacher_attendance_record->session = $session;
            $teacher_attendance_record->date = $date;
            $teacher_attendance_record->role = 'teacher';
            $teacher_attendance_record->save();
        }

        return redirect('/attendance/daily-attendance/teachers');
    }


    public function takeStaffAttendance(Request $request){

        $date = $request->input('date');

        $session = $request->input('session');
        $selectStaffList =$request->input('selectStaffList');
        if($selectStaffList==null){
            $selectStaffList=[];
        }

        $staff = DB::table('users')->where("school_id","=",Auth::user()->school_id)
            ->whereNotIn('role',["teacher","student"])

            ->whereNotIn("users.id" ,$selectStaffList)
            ->get()->all();

        for($i=0;$i<count($staff);$i++){
            $staff_attendance_record = new StaffAttendance();
            $staff_attendance_record->user_id = $staff[$i]->id;
            $staff_attendance_record->session = $session;
            $staff_attendance_record->date = $date;
            $staff_attendance_record->role = $staff[$i]->role;
            $staff_attendance_record->save();
        }

        return redirect('/attendance/daily-attendance/staff');

    }

    public function staffAttendance()
    {
        return view('attendance.staff-attendance');
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
     * @param  \App\StaffAttendance  $staffAttendance
     * @return \Illuminate\Http\Response
     */
    public function show(StaffAttendance $staffAttendance)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\StaffAttendance  $staffAttendance
     * @return \Illuminate\Http\Response
     */
    public function edit(StaffAttendance $staffAttendance)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\StaffAttendance  $staffAttendance
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, StaffAttendance $staffAttendance)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\StaffAttendance  $staffAttendance
     * @return \Illuminate\Http\Response
     */
    public function destroy(StaffAttendance $staffAttendance)
    {
        //
    }
}

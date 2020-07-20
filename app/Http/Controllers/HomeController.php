<?php

namespace App\Http\Controllers;

use App\DailyAttendance;
use App\SchoolEvent;
use App\StaffAttendance;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        if (\Auth::user()->role != 'master') {
            $minutes = 1440;// 24 hours = 1440 minutes
            $school_id = \Auth::user()->school->id;
            $classes = \Cache::remember('classes-'.$school_id, $minutes, function () use($school_id) {
              return \App\Myclass::bySchool($school_id)
                                ->pluck('id')
                                ->toArray();
            });
            $totalStudents = \Cache::remember('totalStudents-'.$school_id, $minutes, function () use($school_id) {
              return \App\User::bySchool($school_id)
                              ->where('role','student')
                              ->where('active', 1)
                              ->count();
            });
            $totalTeachers = \Cache::remember('totalTeachers-'.$school_id, $minutes, function () use($school_id) {
              return \App\User::bySchool($school_id)
                              ->where('role','teacher')
                              ->where('active', 1)
                              ->count();
            });

            $totalStaff = \Cache::remember('totalStaff-'.$school_id, $minutes, function () use($school_id) {
                return \App\User::bySchool($school_id)
                    ->whereNotIn('role',['teacher','master','student'])
                    ->where('active', 1)
                    ->count();
            });

            $totalBooks = \Cache::remember('totalBooks-'.$school_id, $minutes, function () use($school_id) {
              return \App\Book::bySchool($school_id)->count();
            });
            $totalClasses = \Cache::remember('totalClasses-'.$school_id, $minutes, function () use($school_id) {
              return \App\Myclass::bySchool($school_id)->count();
            });
            $totalSections = \Cache::remember('totalSections-'.$school_id, $minutes, function () use ($classes) {
              return \App\Section::whereIn('class_id', $classes)->count();
            });
            $notices = \Cache::remember('notices-'.$school_id, $minutes, function () use($school_id) {
              return \App\Notice::bySchool($school_id)
                                ->where('active',1)
                                ->get();
            });
            $events = \Cache::remember('events-'.$school_id, $minutes, function () use($school_id) {
              return \App\Event::bySchool($school_id)
                              ->where('active',1)
                              ->get();
            });
            $routines = \Cache::remember('routines-'.$school_id, $minutes, function () use($school_id) {
              return \App\Routine::bySchool($school_id)
                                ->where('active',1)
                                ->get();
            });
            $syllabuses = \Cache::remember('syllabuses-'.$school_id, $minutes, function () use($school_id) {
              return \App\Syllabus::bySchool($school_id)
                                  ->where('active',1)
                                  ->get();
            });
            $exams = \Cache::remember('exams-'.$school_id, $minutes, function () use($school_id) {
              return \App\Exam::bySchool($school_id)
                              ->where('active',1)
                              ->get();
            });
            // if(\Auth::user()->role == 'student')
            //   $messageCount = \App\Notification::where('student_id',\Auth::user()->id)->count();
            // else
            //   $messageCount = 0;
            $today = Carbon::today()->format('d-m-Y');
            $studentsMorning = DailyAttendance::join('users','student_id',"=","users.id")
                                ->whereDate('date','=',$today)->where('session','=','Morning')
                                ->pluck('student_id');

            $studentsEveningAndMorning = DailyAttendance::join('users','student_id',"=","users.id")
                ->whereDate('date','=',$today)->where('session','=','After-Noon')
                ->whereIn('student_id', $studentsMorning)
                ->pluck('student_id');

            $studentsHalfDay = DailyAttendance::join('users','student_id',"=","users.id")
                ->whereDate('date','=',$today)
                ->whereNotIn('student_id', $studentsEveningAndMorning)
                ->count();

            $studentsFullDay = count($studentsEveningAndMorning);



            $teachersMorning = StaffAttendance::join('users','user_id',"=","users.id")
                ->whereDate('date','=',$today)->where('session','=','Morning')
                ->where('staff_attendances.role','teacher')
                ->pluck('user_id');

            $teachersEveningAndMorning = StaffAttendance::join('users','user_id',"=","users.id")
                ->whereDate('date','=',$today)->where('session','=','After-Noon')
                ->where('staff_attendances.role','teacher')
                ->whereIn('user_id', $teachersMorning)
                ->pluck('user_id');

            $teachersHalfDay = StaffAttendance::join('users','user_id',"=","users.id")
                ->whereDate('date','=',$today)
                ->where('staff_attendances.role','teacher')
                ->whereNotIn('user_id', $teachersEveningAndMorning)
                ->pluck('user_id')
                ->count();

            $teachersFullDay = count($teachersEveningAndMorning);




            $staffMorning = StaffAttendance::join('users','user_id',"=","users.id")
                ->whereDate('date','=',$today)->where('session','=','Morning')
                ->where('staff_attendances.role','!=','teacher')
                ->pluck('user_id');

            $staffEveningAndMorning = StaffAttendance::join('users','user_id',"=","users.id")
                ->whereDate('date','=',$today)->where('session','=','After-Noon')
                ->where('staff_attendances.role','!=','teacher')
                ->whereIn('user_id', $staffMorning)
                ->pluck('user_id');

            $staffHalfDay = StaffAttendance::join('users','user_id',"=","users.id")
                ->whereDate('date','=',$today)
                ->where('staff_attendances.role','!=','teacher')
                ->whereNotIn('user_id', $staffEveningAndMorning)
                ->pluck('user_id')
                ->count();

            $staffFullDay = count($staffEveningAndMorning);

            $all_events = SchoolEvent::where('school_id','=',$school_id)
                ->where('group_name',"=","all")->get();



            return view('home',[
              'totalStudents'=>$totalStudents,
              'totalTeachers'=>$totalTeachers,
              'totalBooks'=>$totalBooks,
              'totalClasses'=>$totalClasses,
              'totalSections'=>$totalSections,
              'notices'=>$notices,
              'events'=>$events,
              'routines'=>$routines,
              'syllabuses'=>$syllabuses,
              'exams'=>$exams,
              'studentsFullDay'=>$studentsFullDay,
              'studentsHalfDay'=>$studentsHalfDay,
              'totalStaff' => $totalStaff,
              'teachersFullDay' => $teachersFullDay,
              'teachersHalfDay' => $teachersHalfDay,
              'staffHalfDay' => $staffHalfDay,
              'staffFullDay' => $staffFullDay,
                'all_events' => $all_events

              //'messageCount'=>$messageCount,
            ]);
        } else {
            return redirect('/masters');
        }
    }
}

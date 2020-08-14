<?php

namespace App\Http\Controllers;

use App\DailyAttendance;
use App\SchoolEvent;
use App\StaffAttendance;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


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
    public function sliderSetting(){
        return view("dashboard.slider-setting");
    }
    public function getImage(Request $request){
        $school_id = Auth::user()->school_id;
        $image_number = $request->input('image_number');
        $results = DB::table('slider_images')->where('school_id',"=",$school_id)
                    ->where('image_number',"=",$image_number)->get()->first();
        return json_encode($results);
    }
    public function uploadImage(Request $request){
        $file = $request->file('image');
        //return json_encode($file);
        $upload_dir = 'school-'.auth()->user()->school_id.'/slider';
        $path = \Storage::disk('public')->putFile($upload_dir,$file);
        $title = $request->input('title');
        $description = $request->input('description');
        $school_id = Auth::user()->school_id;
        $url_path = url('storage/'.$path);
        $image_number = $request->input('image_number');
        $result = DB::table('slider_images')->where('school_id',"=",$school_id)
            ->where('image_number',"=",$image_number)->get()->first();

        if($result != null)
         \Storage::disk('public')->delete($result->path);

        DB::table('slider_images')
            ->insert(["school_id"=>$school_id,
                "image_number"=>$image_number,"path"=>$path,
                "title"=>$title,"description"=>$description,
                "url_path"=>$url_path ]);

        return ($path)? response()->json([
            'imgUrlpath' => url('storage/'.$path),
            'path' => 'storage/'.$path,
            'error' => false
        ]):response()->json([
            'imgUrlpath' => null,
            'path' => null,
            'error' => true
        ]);
    }


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

            $image1 = DB::table('slider_images')->where('school_id',"=",$school_id)
                ->where('image_number',"=",1)->get()->first();

            $image2 = DB::table('slider_images')->where('school_id',"=",$school_id)
                ->where('image_number',"=",2)->get()->first();

            $image3 = DB::table('slider_images')->where('school_id',"=",$school_id)
                ->where('image_number',"=",3)->get()->first();

            return view('home',[
              'totalStudents'=>$totalStudents,
              'totalTeachers'=>$totalTeachers,
              'totalBooks'=>$totalBooks,
              'totalClasses'=>$totalClasses,
              'totalSections'=>$totalSections,
              'studentsFullDay'=>$studentsFullDay,
              'studentsHalfDay'=>$studentsHalfDay,
              'totalStaff' => $totalStaff,
              'teachersFullDay' => $teachersFullDay,
              'teachersHalfDay' => $teachersHalfDay,
              'staffHalfDay' => $staffHalfDay,
              'staffFullDay' => $staffFullDay,
                'all_events' => $all_events,
              'image1'=>$image1,
                'image2'=>$image2,
                'image3'=>$image3,

              //'messageCount'=>$messageCount,
            ]);
        } else {
            return redirect('/masters');
        }
    }
}

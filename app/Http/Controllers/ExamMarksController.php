<?php

namespace App\Http\Controllers;

use App\ExamMarks;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ExamMarksController extends Controller
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
    public function studentMarks(Request $request){
        $student_id = Auth::user()->id;
        $all_exams = ExamMarks::where('student_id',"=",$student_id)
                     ->join('class_exams','exam_id',"=","class_exams.id")
                     ->join("subjects","subject_id","=","subjects.id")
                     ->get()->groupBy(['exam_id','exam_name']);

        return view('marks.student',compact("all_exams"));
    }
    public function apiGetStudents(Request $request){

        $section_id = $request->input('section_id');
        $exam_id = $request->input('exam_id');
        $subject_id = $request->input('subject_id');


        $exam_marks_list = ExamMarks::where("subject_id","=",$subject_id)
            ->where("exam_id","=",$exam_id);

        $students_with_section = DB::table('users')->where("school_id","=",Auth::user()->school_id)
            ->join("sections","section_id","=","sections.id")
            ->where("role","=","student")
            ->where("section_id","=",$section_id)
            ->select("users.id as student_user_id","users.name as name","users.student_code as student_code","student_marks_list.*" )
            ->leftJoinSub($exam_marks_list , 'student_marks_list',function ($join){
                $join->on('users.id','=',"student_marks_list.student_id");
             })
            ->orderBy('name', 'asc')
            ->get();





        return json_encode($students_with_section);
    }

    public function apiSubmitMarks(Request $request){

        $section_id = $request->input('section_id');
        $exam_id = $request->input('exam_id');
        $subject_id = $request->input('subject_id');
        $marks= $request->input('marks');
        $student_id = $request->input('student_id');
        $max_marks = $request->input('max_marks');
        $grade = $request->input('grade');

        $exam_marks = new ExamMarks();
        $exam_marks->marks = $marks;
        $exam_marks->grade = $grade;
        $exam_marks->max_marks = $max_marks;
        $exam_marks->subject_id = $subject_id;
        $exam_marks->exam_id = $exam_id;
        $exam_marks->student_id = $student_id;
        $exam_marks->teacher_name = "test";

        $exam_marks->save();



        return $this->apiGetStudents($request);
    }
    public function apiRemoveMarks(Request $request){

        $record_id = $request->input('record_id');

        ExamMarks::where("id","=",$record_id)->delete();



        return $this->apiGetStudents($request);
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
     * @param  \App\ExamMarks  $examMarks
     * @return \Illuminate\Http\Response
     */
    public function show(ExamMarks $examMarks)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ExamMarks  $examMarks
     * @return \Illuminate\Http\Response
     */
    public function edit(ExamMarks $examMarks)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ExamMarks  $examMarks
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ExamMarks $examMarks)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ExamMarks  $examMarks
     * @return \Illuminate\Http\Response
     */
    public function destroy(ExamMarks $examMarks)
    {
        //
    }
}

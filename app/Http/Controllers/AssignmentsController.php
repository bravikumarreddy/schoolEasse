<?php

namespace App\Http\Controllers;

use App\Assignments;
use App\TeacherSubject;
use Illuminate\Http\Request;

class AssignmentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($teacher_subject_id)
    {
        $assignments = TeacherSubject::where("teacher_subjects.id","=",$teacher_subject_id)
            ->select("teacher_subjects.id as teacher_subject_id" , "subjects.*" ,"classes.*" ,"sections.*" ,"teacher_subjects.*",'assignments.id as assignment_id',"assignments.*" )
            ->join("assignments","teacher_subjects.id","=","assignments.teacher_subject_id")
            ->join("subjects","subject_id","=","subjects.id")
            ->join("classes","class_id","=","classes.id")
            ->join("sections","section_id","=","sections.id")
            ->get();

        $user_id = \Auth::user()->id;

        $subject_details = TeacherSubject::where("teacher_id","=",$user_id)
            ->where("teacher_subjects.id","=",$teacher_subject_id)
            ->select("teacher_subjects.id as teacher_subject_id" , "subjects.*" ,"classes.*" ,"sections.*" ,"teacher_subjects.*" )
            ->join("subjects","subject_id","=","subjects.id")
            ->join("classes","class_id","=","classes.id")
            ->join("sections","section_id","=","sections.id")

            ->first();
        return view("assignments.create",compact('subject_details','assignments'));
    }


    public function studentList($teacher_subject_id)
    {
        $user_id = \Auth::user()->id;
        $assignments = TeacherSubject::where("teacher_subjects.id","=",$teacher_subject_id)
            ->select("teacher_subjects.id as teacher_subject_id" , "subjects.*" ,"classes.*" ,"sections.*" ,"teacher_subjects.*",'assignments.id as assignment_id',"assignments.*" )
            ->join("assignments","teacher_subjects.id","=","assignments.teacher_subject_id")
            ->join("subjects","subject_id","=","subjects.id")
            ->join("classes","class_id","=","classes.id")
            ->join("sections","section_id","=","sections.id")
            ->get();
        //dd($assignments);
        return view("assignments.student_assignments",compact('assignments'));
    }



    public function studentSubmit($assignment_id)
    {
        $user_id = \Auth::user()->id;
        $assignment = Assignments::where("assignments.id","=",$assignment_id)
            ->select("assignments.*","assignment_submissions.id as submission_id")
            ->leftJoin('assignment_submissions',"assignments.id","=","assignment_id")
            ->first();
        //dd($assignment);
        return view("assignments.student_submit",compact('assignment'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

        $file = $request->file('attachment');
        $assignment = new Assignments();
        $teacher_subject_id = $request->input('teacher_subject_id');
        $assignment->teacher_subject_id = $teacher_subject_id;
        if($file){


            if($file->getSize() > 5*1024*1024 ){
                redirect("/assignment/".$teacher_subject_id )->with('error', 'File size should not be greater than 5 MB');
            }

            $upload_dir = 'school-'.auth()->user()->school_id.'/assignments';
            $path = \Storage::disk('public')->putFile($upload_dir,$file);
            $url_path = url('storage/'.$path);

            $assignment->path = $path;
            $assignment->url_path  = $url_path;

        }

        $assignment->title = $request->input('title');
        $assignment->due_date = $request->input('due_date');
        $assignment->description = $request->input('description');
        $assignment->save();
        return redirect("/assignment/".$teacher_subject_id );
        //dd($file->getSize());

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
     * @param  \App\Assignments  $assignments
     * @return \Illuminate\Http\Response
     */
    public function show(Assignments $assignments)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Assignments  $assignments
     * @return \Illuminate\Http\Response
     */
    public function edit(Assignments $assignments)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Assignments  $assignments
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Assignments $assignments)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Assignments  $assignments
     * @return \Illuminate\Http\Response
     */
    public function destroy(Assignments $assignments)
    {
        //
    }
}

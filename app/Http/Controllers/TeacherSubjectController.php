<?php

namespace App\Http\Controllers;

use App\Section;
use App\TeacherSubject;
use App\User;
use Illuminate\Http\Request;

class TeacherSubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('subjects.teacher_subjects');
    }

    public function apiGetTeacherSubjects(Request $request){
        $section_id = $request->input('section_id');
        $teacherSubjects = Section::where("sections.id","=",$section_id)
            ->select('sections.id as section_id',"subjects.*","teacher_subjects.id as teacher_subject_id","teacher_subjects.teacher_id as teacher_id","teacher_name as teacher_name")
            ->join("subjects","sections.class_id","=","subjects.class_id")
            ->leftJoin("teacher_subjects" ,function ($join) {
                $join->on("subjects.id","=","teacher_subjects.subject_id")
                 ->on("sections.id","=","teacher_subjects.section_id");
            })
            ->get()->all();

            //->leftJoin("teacher_subjects","subjects.id","=","teacher_subjects.subject_id")


        return json_encode($teacherSubjects);
    }
    public function removeTeacher(Request $request){

        $section_id = $request->input('section_id');
        $teacher_subject_id = $request->input('teacher_subject_id');

        TeacherSubject::where('id','=',$teacher_subject_id)->delete();

        return $this->apiGetTeacherSubjects($request);


    }


    public function assignTeacher(Request $request){

            $section_id  = $request->input('section_id');
            $subject_id = $request->input('subject_id');
            $teacher_id = $request->input('teacher_id');
            $user =   User::where("id","=",$teacher_id)->get()->first();

            $teacherSubject = new TeacherSubject();
            $teacherSubject->section_id = $section_id;
            $teacherSubject->subject_id = $subject_id;
            $teacherSubject->teacher_id = $teacher_id;
            $teacherSubject->teacher_name = $user->name;
            $teacherSubject->save();

        return $this->apiGetTeacherSubjects($request);

    }

    public function getMySubjects(){
        $user_id = \Auth::user()->id;

        $my_subjects = TeacherSubject::where("teacher_id","=",$user_id)
            ->join("subjects","subject_id","=","subjects.id")
            ->join("classes","class_id","=","classes.id")
            ->join("sections","section_id","=","sections.id")
            ->get();

        return json_encode($my_subjects);

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
     * @param  \App\TeacherSubject  $teacherSubject
     * @return \Illuminate\Http\Response
     */
    public function show(TeacherSubject $teacherSubject)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\TeacherSubject  $teacherSubject
     * @return \Illuminate\Http\Response
     */
    public function edit(TeacherSubject $teacherSubject)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\TeacherSubject  $teacherSubject
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TeacherSubject $teacherSubject)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\TeacherSubject  $teacherSubject
     * @return \Illuminate\Http\Response
     */
    public function destroy(TeacherSubject $teacherSubject)
    {
        //
    }
}

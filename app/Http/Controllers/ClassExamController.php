<?php

namespace App\Http\Controllers;

use App\ClassExam;
use Illuminate\Http\Request;

class ClassExamController extends Controller
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

    public function apiGetClassExams(Request $request){

        $class_id = $request->input('class_id');

        $class_exams = ClassExam::where('class_id',"=",$class_id)->get();

        return json_encode($class_exams);

    }
    public function apiCreateClassExams(Request $request){

        $class_id = $request->input('class_id');
        $exam_name = $request->input('exam_name');

        $class_exam = new ClassExam();
        $class_exam->class_id = $class_id;
        $class_exam->exam_name = $exam_name;

        $class_exam->save();

        return $this->apiGetClassExams($request);

    }

    public function apiDeleteClassExams(Request $request){


        $id = $request->input('exam_id');
        ClassExam::where("id","=",$id)->delete();

        return $this->apiGetClassExams($request);

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
     * @param  \App\ClassExam  $classExam
     * @return \Illuminate\Http\Response
     */
    public function show(ClassExam $classExam)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ClassExam  $classExam
     * @return \Illuminate\Http\Response
     */
    public function edit(ClassExam $classExam)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ClassExam  $classExam
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ClassExam $classExam)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ClassExam  $classExam
     * @return \Illuminate\Http\Response
     */
    public function destroy(ClassExam $classExam)
    {
        //
    }
}

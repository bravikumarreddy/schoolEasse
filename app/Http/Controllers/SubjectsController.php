<?php

namespace App\Http\Controllers;

use App\Section;
use App\Subjects;
use Illuminate\Http\Request;

class SubjectsController extends Controller
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

    public function apiGetSubjects( Request $request)
    {
        //
       $class_id = $request->input("class_id");
       $subjects =  Subjects::where("class_id","=",$class_id)->get()->all();

       return json_encode($subjects);


    }

    public function apiCreateSubjects( Request $request)
    {
        //
        $class_id = $request->input("class_id");
        $name = $request->input('name');
        $subject = new Subjects();
        $subject->class_id = $class_id;
        $subject->name = $name;
        $subject->save();

        $subjects =  Subjects::where("class_id","=",$class_id)->get()->all();

        return json_encode($subjects);


    }

    public function apiDeleteSubjects( Request $request)
    {
        //
        $subject_id = $request->input("subject_id");
        $class_id = $request->input("class_id");

        Subjects::find($subject_id)->delete();

        $subjects =  Subjects::where("class_id","=",$class_id)->get()->all();

        return json_encode($subjects);


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
     * @param  \App\Subjects  $subjects
     * @return \Illuminate\Http\Response
     */
    public function show(Subjects $subjects)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Subjects  $subjects
     * @return \Illuminate\Http\Response
     */
    public function edit(Subjects $subjects)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Subjects  $subjects
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Subjects $subjects)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Subjects  $subjects
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subjects $subjects)
    {
        //
    }
}

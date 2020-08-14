<?php

namespace App\Http\Controllers;

use App\SyllabusStatus;
use Illuminate\Http\Request;

class SyllabusStatusController extends Controller
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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //
        //dd($request);
        if($request->syllabusStatusId != null){
            SyllabusStatus::where('id',$request->syllabusStatusId)
            ->update(['status'=>$request->status]);
            return back();
        }
        $syllabus_status = new SyllabusStatus();
        $syllabus_status->teacher_subject_id = $request->teacherSubjectId;
        $syllabus_status->syllabus_id = $request->syllabusId;
        $syllabus_status->status = $request->status;
        $syllabus_status->save();

        return  back();
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
     * @param  \App\SyllabusStatus  $syllabusStatus
     * @return \Illuminate\Http\Response
     */
    public function show(SyllabusStatus $syllabusStatus)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\SyllabusStatus  $syllabusStatus
     * @return \Illuminate\Http\Response
     */
    public function edit(SyllabusStatus $syllabusStatus)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\SyllabusStatus  $syllabusStatus
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SyllabusStatus $syllabusStatus)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\SyllabusStatus  $syllabusStatus
     * @return \Illuminate\Http\Response
     */
    public function destroy(SyllabusStatus $syllabusStatus)
    {
        //
    }
}

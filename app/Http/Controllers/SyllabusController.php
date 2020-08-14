<?php

namespace App\Http\Controllers;

use App\Syllabus as Syllabus;
use App\Http\Resources\SyllabusResource;
use App\SyllabusStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class SyllabusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function index()
     {
        return view('syllabus.create');
     }

     public function apiGetSyllabus(Request $request,$subject_id){
         $syllabus = Syllabus::where('subject_id','=',$subject_id)->get();

         return json_encode($syllabus);
     }

     public function apiAddSyllabus(Request $request ){


        $syllabus = new Syllabus();

         $syllabus->subject_id = $request->subject_id;
         $syllabus->topic = $request->topic;
         $syllabus->reference = $request->reference;
         $syllabus->comments = $request->comments;

         $syllabus->save();

         return [
             'status' => 'success',
         ];
     }
    public function apiDeleteSyllabus(Request $request ){

        //dd($request);
        Syllabus::where('id',"=",$request->syllabus_id)->delete();

        return [
            'status' => 'success',
        ];
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(int $class_id)
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($teacherSubjectId,$subjectId)
    {

        $syllabus_status = SyllabusStatus::where('teacher_subject_id',$teacherSubjectId);

        $syllabuses = Syllabus::where('subject_id',"=",$subjectId)

//                    ->leftJoin('syllabus_statuses',"syllabus_id",'=',
//                    'syllabuses.id')
                    ->leftJoinSub($syllabus_status , "syllabus_status",function($join){
                        $join->on("syllabus_id","syllabuses.id");
            })
            ->select('syllabuses.*','syllabus_status.*','syllabuses.id as syllabus_id',
                'syllabus_status.id as syllabus_status_id'
            )
                    ->get();



        //$syllabus_status = SyllabusStatus::where();
        return view('syllabus.show',compact('syllabuses','teacherSubjectId','subjectId'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

    }
}

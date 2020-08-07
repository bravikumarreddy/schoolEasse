<?php

namespace App\Http\Controllers;

use App\SchoolEvent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SchoolEventController extends Controller
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
    public function apiGetEvents(Request $request){
        $school_id = \Auth::user()->school_id;

        $class_exams = DB::table('class_exams')
            ->select("class_exams.id as exam_id","class_exams.exam_name as exam_name" ,"classes.class_number as exam_class_name")
            ->join("classes","class_id","classes.id");

        $events = SchoolEvent::where('school_events.school_id','=',$school_id)
            ->select('school_events.*','section_number as section_name',
                'class_number as class_name',
                'users.name as user_name',
                'class_exams.*'
            )
            ->leftJoin('sections',"section_id","=",'sections.id')
            ->leftJoin('classes',"class_id","=",'classes.id')
            ->leftJoin('users',"individual_id","=","users.id")
            ->leftJoinSub($class_exams,"class_exams" , function ($join) {

                $join->on('school_events.exam_id', '=', 'class_exams.exam_id');
            })
            ->get();

        return json_encode($events);
    }

    public function apiDeleteEvent(Request $request){

        $events = SchoolEvent::where('id','=',$request->input('id'))->delete();

        return [
            'status' => 'success',
        ];

    }

    public function apicreateEvent(Request $request){

        $event = new SchoolEvent();
        $event->category= $request->input('category');
        $event->school_id = \Auth::user()->school_id;
        $event->title = $request->input('title');
        $event->group_name = $request->input('group');
        $event->section_id = $request->input('section_id');
        $event->individual_id = $request->input('individual_id');
        $event->exam_id = $request->input('exam_id');
        $event->from = $request->input('from');
        $event->to = $request->input('to');
        $event->color = $request->input('color');

        $event->save();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('school-events.create');
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
     * @param  \App\SchoolEvent  $schoolEvent
     * @return \Illuminate\Http\Response
     */
    public function show(SchoolEvent $schoolEvent)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\SchoolEvent  $schoolEvent
     * @return \Illuminate\Http\Response
     */
    public function edit(SchoolEvent $schoolEvent)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\SchoolEvent  $schoolEvent
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SchoolEvent $schoolEvent)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\SchoolEvent  $schoolEvent
     * @return \Illuminate\Http\Response
     */
    public function destroy(SchoolEvent $schoolEvent)
    {
        //
    }
}

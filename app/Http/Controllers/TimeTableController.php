<?php

namespace App\Http\Controllers;

use App\TimeTable;
use Illuminate\Http\Request;

class TimeTableController extends Controller
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


    public function apiGetTeacherTimeTable(Request $request)
    {
        //
        $teacher_id = $request->input('teacher_id');
        $teacherTimeTable = TimeTable::where('time_tables.teacher_id',"=",$teacher_id)
        ->select('subjects.*',"teacher_subjects.*","time_tables.id as time_table_id",
            'from as from','to as to','day_of_the_week as day_of_the_week',
            'section_number as section_number',
            'class_number as class_number'
            )
            ->join("sections","time_tables.section_id","sections.id")
            ->join("classes","sections.class_id","classes.id")
        ->join("teacher_subjects","time_tables.teacher_subjects_id","=","teacher_subjects.id")
        ->join("subjects","subject_id","=","subjects.id")
            ->get();

        return json_encode($teacherTimeTable);

    }

    public function apiGetClassTimeTable(Request $request)
    {
        //
        $section_id = $request->input('section_id');
        $classTimeTable = TimeTable::where('time_tables.section_id',"=",$section_id)
            ->select('subjects.*',"teacher_subjects.*","time_tables.id as time_table_id",
                'from as from','to as to','day_of_the_week as day_of_the_week',
                'section_number as section_number',
                'class_number as class_number')
            ->join("teacher_subjects","time_tables.teacher_subjects_id","=","teacher_subjects.id")
            ->join("sections","time_tables.section_id","sections.id")
            ->join("classes","sections.class_id","classes.id")
            ->join("subjects","subject_id","=","subjects.id")

            ->get();
        return json_encode($classTimeTable);
    }


    public function apiCreateTimeTable(Request $request)
    {
        //

        $time_table = new TimeTable();
        $time_table->teacher_id = $request->input('teacher_id');
        $time_table->section_id = $request->input('section_id');
        $time_table->day_of_the_week = $request->input('day_of_the_week');
        $time_table->teacher_subjects_id = $request->input('teacher_subjects_id');
        $time_table->from = $request->input('from');
        $time_table->to = $request->input('to');
        $time_table->save();

        return [
            'status' => 'success',
        ];


    }
    public function apiDeleteTimeTable(Request $request)
    {
        //

        TimeTable::where("id","=",$request->input('time_table_id'))
                                ->delete();

        return [
            'status' => 'success',
        ];


    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('time-table.create');
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
     * @param  \App\TimeTable  $timeTable
     * @return \Illuminate\Http\Response
     */
    public function show(TimeTable $timeTable)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\TimeTable  $timeTable
     * @return \Illuminate\Http\Response
     */
    public function edit(TimeTable $timeTable)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\TimeTable  $timeTable
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TimeTable $timeTable)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\TimeTable  $timeTable
     * @return \Illuminate\Http\Response
     */
    public function destroy(TimeTable $timeTable)
    {
        //
    }
}

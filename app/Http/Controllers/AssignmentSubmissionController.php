<?php

namespace App\Http\Controllers;

use App\Assignments;
use App\AssignmentSubmission;
use Illuminate\Http\Request;

class AssignmentSubmissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('transportation.index');
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


    public function submitAssignment(Request $request,$assignment_id){
        $file = $request->file('attachment');
        $student_id = \Auth::user()->id;
       // dd($request);
        $assignment_submisssion = new AssignmentSubmission();
        $assignment_submisssion->student_id = $student_id;
        $assignment_submisssion->assignment_id = $assignment_id;
        $assignment_submisssion->description = $request->input('description');

        if($file){


            if($file->getSize() > 5*1024*1024 ){
                redirect("/assignment/student/submit/".$assignment_id )->with('error', 'File size should not be greater than 5 MB');
            }

            $upload_dir = 'school-'.auth()->user()->school_id.'/assignments/submissions';
            $path = \Storage::disk('public')->putFile($upload_dir,$file);
            $url_path = url('storage/'.$path);

            $assignment_submisssion->path = $path;
            $assignment_submisssion->url_path  = $url_path;

        }
        $assignment_submisssion->save();
        return redirect("/assignment/student/submit/".$assignment_id );

    }

    public function submissions(Request $request,$assignment_id){
        $assignments = AssignmentSubmission::where("assignment_id","=",$assignment_id)
            ->select("*","assignment_submissions.created_at as submitted_at")
            ->join('users',"assignment_submissions.student_id","=","users.id")
            ->get();

        return view('assignments.submissions',compact('assignments'));
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\AssignmentSubmission  $assignmentSubmission
     * @return \Illuminate\Http\Response
     */
    public function show(AssignmentSubmission $assignmentSubmission)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\AssignmentSubmission  $assignmentSubmission
     * @return \Illuminate\Http\Response
     */
    public function edit(AssignmentSubmission $assignmentSubmission)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\AssignmentSubmission  $assignmentSubmission
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AssignmentSubmission $assignmentSubmission)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\AssignmentSubmission  $assignmentSubmission
     * @return \Illuminate\Http\Response
     */
    public function destroy(AssignmentSubmission $assignmentSubmission)
    {
        //
    }
}

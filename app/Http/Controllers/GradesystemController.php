<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Gradesystem as Gradesystem;
use Illuminate\Support\Facades\DB;

class GradesystemController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
    public function index(){
      return view("grade.create");
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function apiDeleteGradeSystems($id){
         return Gradesystem::where('id',"=",$id)->delete();
    }


    public function apiGetGradeSystems(){
        return Gradesystem::where('school_id',"=",\Auth::user()->school_id)
            ->join('grade_systems_field','id',"=","grade_system_id")

            ->get()->groupBy('grade_system_id')->toArray();
    }

    public function submit(Request $request){


        $school_id = \Auth::user()->school_id;

        $grade_system = new Gradesystem();
        $grade_system->school_id = $school_id;
        $grade_system->grade_system_name = $request->input('name');
        $grade_system->save();

        $grade_system_id = $grade_system->id;

        $data = [];
        $from = $request->input('from');
        $to = $request->input('to');
        $grade = $request->input('grade');

        for($i=0;$i<count($from);$i+=1 ){

            array_push($data,['grade_system_id'=>$grade_system_id, 'from'=>$from[$i],'to'=>$to[$i], 'grade'=>$grade[$i] ]);

        }

        DB::table('grade_systems_field')->insert($data);

        return redirect("/exams/grade-system");

    }
    public function create(){
      return view('gpa.create');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
      $request->validate([
        'grade_system_name' => 'required|string|max:255',
        'point' => 'required',
        'grade' => 'required',
        'from_mark' => 'required',
        'to_mark' => 'required',
      ]);
      $gpa = new Gradesystem;
      $gpa->grade_system_name = $request->grade_system_name;
      $gpa->point = $request->point;
      $gpa->grade = $request->grade;
      $gpa->from_mark = $request->from_mark;
      $gpa->to_mark = $request->to_mark;
      $gpa->school_id = \Auth::user()->school_id;
      $gpa->user_id = \Auth::user()->id;
      $gpa->save();
      return back()->with('status', __('Saved'));
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id){}
    /**
      * Show the form for editing the specified resource.
      *
      * @param  int  $id
      * @return \Illuminate\Http\Response
    */
    public function edit($id){}
      /**
       * Update the specified resource in storage.
       *
       * @param  \Illuminate\Http\Request  $request
       * @param  int  $id
       * @return \Illuminate\Http\Response
       */
    public function update(Request $request, $id){}
      /**
       * Remove the specified resource from storage.
       *
       * @param  int  $id
       * @return \Illuminate\Http\Response
       */
    public function destroy(Request $request){
      $gpa = Gradesystem::find($request->gpa_id);
      $gpa->delete();
      return back()->with('status', __('Deleted!'));
    }
}

<?php

namespace App\Http\Controllers;
use App\Message as Message;
use App\Communication;
use App\User;
use Illuminate\Http\Request;

class CommunicationController extends Controller
{



    public function apiCreateMessage(Request $request)
    {
        $category= $request->input('category');
        $school_id = \Auth::user()->school_id;
        $title = $request->input('title');
        $message = $request->input('message');
        $group_name = $request->input('group');
        $section_ids = $request->input('section_ids');
        $individual_ids = $request->input('individual_ids');
        $sender_id = \Auth::user()->id;

        $communication = new Communication();
        $communication->message = $message;
        $communication->title = $title;
        $communication->category = $category;
        $communication->sender_id = $sender_id;
        $communication->school_id = $school_id;
        $communication->save();
        $communication_id = $communication->id;
        $users = [];
        if($category == 'groups'){

                if($group_name == 'all'){
                    $users = User::where('school_id','=',$school_id)->get();
                }
                elseif ($group_name == 'students'){
                    $users = User::where('school_id','=',$school_id)
                        ->where('role',"=",'student')
                        ->get();
                }
                elseif ($group_name == 'teachers'){
                    $users = User::where('school_id','=',$school_id)
                        ->where('role',"=",'teacher')
                        ->get();

                }
                elseif ($group_name == 'staff'){
                    $users = User::where('school_id','=',$school_id)
                        ->whereNotIn('role',['teacher','master','student'])
                        ->get();

                }


        }
        elseif ($category== 'class'){
            $users = User::where('school_id','=',$school_id)
                ->whereIn('section_id',$section_ids)
                ->get();
        }
        elseif ($category == 'individual'){
            $users = User::where('school_id','=',$school_id)
                ->whereIn('id',$individual_ids)
                ->get();
        }

        foreach ($users as $user){

            $message = new Message();
            $message->communication_id = $communication_id;
            $message->user_id = $user->id;
            $message->read = 0;
            $message->save();

        }

        return [
            'status' => 'success',
        ];


    }
    public function apiGetCommunications(){
        $school_id = \Auth::user()->school_id;
        return json_encode(Communication::where('school_id','=',$school_id)->get());
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('communicate.index');
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
     * @param  \App\Communication  $communication
     * @return \Illuminate\Http\Response
     */
    public function show(Communication $communication)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Communication  $communication
     * @return \Illuminate\Http\Response
     */
    public function edit(Communication $communication)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Communication  $communication
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Communication $communication)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Communication  $communication
     * @return \Illuminate\Http\Response
     */
    public function destroy(Communication $communication)
    {
        //
    }
}

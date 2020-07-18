<?php

namespace App\Http\Controllers;

use App\Message as Message;
use App\Http\Resources\MessageResource;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = \Auth::user()->id;
        $messages =  Message::where('user_id',"=",$user_id)
            ->select('users.*','communications.*',"messages.id as message_id","read as read")
        ->join('communications','communication_id',"=","communications.id" )
        ->join('users','sender_id',"=","users.id")->paginate(10);

        return view("message.messages",compact('messages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function apiMarkRead(Request $request,$id)
    {
        Message::where('id',"=",$id)
        ->update(['read'=>1]);
        return [
            'status' => 'success',
        ];
    }

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

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

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
    public function update(Request $request, $id)
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

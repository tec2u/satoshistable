<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Chat;
use Illuminate\Support\Facades\DB;

class ChatAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $unanswereds = Chat::where('status', '0')->paginate(9);

        $answereds = Chat::where('status', '1')->paginate(9);

        $closeds = Chat::where('status', '2')->orderBy('updated_at', 'desc')->paginate(9);

        foreach ($unanswereds as $msg) {
            $msg->user_name = User::where('id', $msg->user_id)->first()->login ?? '';
            $msg->text = Message::where('chat_id', $msg->id)->latest()->first()->text ?? '';
        }

        foreach ($answereds as $msg) {
            $msg->user_name = User::where('id', $msg->user_id)->first()->login ?? '';
            $msg->text = Message::where('chat_id', $msg->id)->latest()->first()->text ?? '';
        }

        foreach ($closeds as $msg) {
            $msg->user_name = User::where('id', $msg->user_id)->first()->login ?? '';
            $msg->text = Message::where('chat_id', $msg->id)->latest()->first()->text ?? '';
        }

        return view('admin.support.support', compact('unanswereds', 'answereds', 'closeds'));
    }

    public function answerChat($id)
    {
        $messages = Chat::where('id', $id)->where('status', '!=', '2')->get();
        foreach ($messages as $msg) {
            $msg->user_name = User::where('id', $msg->user_id)->first()->login ?? '';
            $msg->text = Message::where('chat_id', $msg->id)->latest()->first()->text ?? '';
        }

        return view('admin.support.answerChat', compact('messages'));
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

    public function createMessage(Request $request)
    {
        // DB::table('message')->insert([
        //     "chat_id" => $request->chat_id,
        //     "user_id" => auth()->user()->id,
        //     "text" => $request->text,
        //     "date" => date('Y-m-d H:i:s')
        // ]);

        $msg = new Message;
        $msg->chat_id = $request->chat_id;
        $msg->user_id = auth()->user()->id;
        $msg->text = $request->text;
        $msg->date = date('Y-m-d H:i:s');
        $msg->save();

        DB::table('chat')->where("id", $request->chat_id)->update(['status' => 1]);

        return redirect()->route('admin.support');
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        //
    }

    public function closeChat($id)
    {
        $chat = Chat::where('id', $id)->first();
        $chat->status = 2;
        $chat->save();
        // DB::table('chat')->where("id", $id)->update(['status' => 2]);

        return redirect()->route('admin.support');
    }

    public function reopenChat($id)
    {
        // DB::table('chat')->where("id", $id)->update(['status' => 0]);
        $chat = Chat::where('id', $id)->first();
        $chat->status = 0;
        $chat->save();
        return redirect()->route('admin.support');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

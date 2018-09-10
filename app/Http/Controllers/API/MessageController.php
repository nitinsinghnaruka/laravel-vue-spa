<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\API\Message\StoreMessage;
use App\Message;
use App\Events\NewMessage;

class MessageController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    /**
     * Store message.
     * 
     * @param  StoreMessage  $request
     * @return \Illuminate\Http\Response|\Illuminate\Contracts\Routing\ResponseFactory
     */
    public function store(StoreMessage $request)
    {
        // Store message.
        $message = Message::create([
            'body'    => $request['message'],
            'user_id' => auth()->user()->id
        ]);

        if ($message->exists()) {
            // Load user.
            $message->load('user');

            // Broadcast message.
            broadcast(new NewMessage($message))->toOthers();
        }

        // Set response.
        if ($message->exists()) {
            $response = [
                'status'  => true,
                'message' => __('messages.message_sent'),
                'body'    => $message->body
            ];
        } else {
            $response = [
                'status'  => false,
                'message' => __('messages.message_send_failed'),
                'body'    => null
            ];
        }

        return response()->json($response, 200);
    }
}

<?php

namespace App\Http\Livewire\Chat;

use Livewire\Component;
use App\Models\User;
use App\Models\Conversation;
use App\Models\Message;
use Illuminate\Support\Facades\Auth;

class CreateChat extends Component
{
    public $user;
    public $message = 'Hello how are you?';

    // public function __construct(User $user)
    // {
    //     $this->user = $user;
    // }

    public function checkconversation($receiverId)
    {
        // dd($receiverId);

        $checkedConversation = Conversation::where('receiver_id',Auth::user()->id)->where('sender_id',$receiverId)->orWhere('receiver_id',$receiverId)->where('sender_id',Auth::user()->id)->get();
        if(count($checkedConversation)==0){

            // new object : make conversation
            $createdConversation = Conversation::create(['receiver_id' => $receiverId, 'sender_id' => Auth::user()->id, 'last_time_message' => null]);

            // new object : make message
            $createdMessage = Message::create(['conversation_id'=> $createdConversation->id, 'sender_id' =>Auth::user()->id, 'receive_id' => $receiverId, 'body' => $this->message]);

            $createdConversation->last_time_message = $createdMessage->created_at;

            $createdConversation->save();

            dd($createdMessage);
            dd('saved');
        }
        elseif(count($checkedConversation)>=1){
            dd('one or more conversation');
        }
    }


    public function render()
    {
        $users = User::where('id','!=', Auth::user()->id)->get();
        return view('livewire.chat.create-chat')
                                    ->with('users',$users)
                                    ->extends('layouts.app')
                                    ->section('content');;
    }

}

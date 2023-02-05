<?php

namespace App\Http\Livewire\Chat;

use Livewire\Component;
use App\Models\Conversation;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ChatList extends Component
{
    public $auth_id;
    public $conversations;
    public $receiverInstance;
    public $name;
    public $selectedConversation;

    protected $listeners = ['chatUserSelected'];

    // Prepare which conversation I will start
    public function chatUserSelected(Conversation $conversation, $receiverId)
    {
        dd($conversation, $receiverId);
        $this->selectedConversation = $conversation;
        $recerverInstance = User::find($receiverId);
    }

    // Identify whether counterpart is conversation receiver or sender 
    public function getChatUserInstance(Conversation $conversation,$request)
    {
        $this->auth_id = auth()->id();
        //get selected conversation

        if($conversation->sender_id == Auth::user()->id)
        {
            $this->receiverInstance = User::firstwhere('id',$conversation->receiver_id);
        }
        else
        {
            $this->receiverInstance = User::firstwhere('id',$conversation->sender_id);
        }

        if(isset($request)){
            return $this->receiverInstance->$request;
        }
    }

    public function mount()
    {
        $this->auth_id = Auth::user()->id;
        $this->conversations = Conversation::where('sender_id',$this->auth_id)->orWhere('receiver_id',$this->auth_id)->orderBy('last_time_message','DESC')->get();

    }


    public function render()
    {
        return view('livewire.chat.chat-list');
    }
}

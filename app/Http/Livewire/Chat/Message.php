<?php

namespace App\Http\Livewire\Chat;

use Livewire\Component;
use App\Models\User;
use App\Models\Conversation;
use App\Models\Message as Mes;
use Illuminate\Support\Facades\Auth;

class Message extends Component
{
    public $selectedConversation;
    public $receiverInstance;
    public $body;

    
    protected $listeners = ['updateSendMessage'];
    public function updateSendMessage(Conversation $conversation,User $receiver)
    {
        // dd($conversation,$receiver);
        
        $this->selectedConversation = $conversation;
        $this->receiverInstance = $receiver;
    }

    public function sendMessage()
    {
        if($this->body == null){
            return null;
        }

        $createdMessage = Mes::create(['conversation_id'=>$this->selectedConversation->id,'sender_id'=>Auth::user()->id,'receive_id'=> $this->receiverInstance->id,'body'=>$this->body]);
        $this->selectedConversation->last_time_message = $createdMessage->created_at;
        $createdMessage->save();


    }

    public function render()
    {
        return view('livewire.chat.message');
    }
}

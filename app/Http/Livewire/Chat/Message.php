<?php

namespace App\Http\Livewire\Chat;

use Livewire\Component;
use App\Models\User;
use App\Models\Conversation;
use App\Models\Message as Mes;
use App\Events\MessageSent;
use Illuminate\Support\Facades\Auth;

class Message extends Component
{
    public $selectedConversation;
    public $receiverInstance;
    public $body;
    public $createdMessage;

    
    protected $listeners = ['updateSendMessage','dispatchMessageSent'];
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

        $this->createdMessage = Mes::create(['conversation_id'=>$this->selectedConversation->id,'sender_id'=>Auth::user()->id,'receive_id'=> $this->receiverInstance->id,'body'=>$this->body]);
        $this->selectedConversation->last_time_message = $this->createdMessage->created_at;
        $this->createdMessage->save();

        $this->emitTo('chat.chatbox','pushMessage',$this->createdMessage->id);
        $this->emitTo('chat.chat-list','refresh');
        $this->reset('body');
        $this->emitSelf('dispatchMessageSent');
    }

    public function dispatchMessageSent()
    {
        broadcast(new MessageSent(Auth::user(),$this->createdMessage,$this->selectedConversation,$this->receiverInstance));
    }

    public function render()
    {
        return view('livewire.chat.message');
    }
}

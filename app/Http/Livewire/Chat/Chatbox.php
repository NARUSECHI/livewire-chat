<?php

namespace App\Http\Livewire\Chat;

use Livewire\Component;
use App\Models\User;
use App\Models\Conversation;
use App\Models\Message;

class Chatbox extends Component
{
    public $selectedConversation;
    public $receiverInstance;
    public $messages_count;
    public $messages;
    public $paginaterVar = 10;

    protected $listeners = ['loadConversation'];
                                    // Catch selectedConversation,receiverInstance from chatlist here
    public function loadConversation(Conversation $conversation,User $receiver)
    {
        //dd($conversation,$receiver);
        $this->selectedConversation = $conversation;
        $this->receiverInstance = $receiver;

        $this->messages_count = Message::where('conversation_id',$this->selectedConversation->id)->count();

        $this->messages = Message::where('conversation_id',$this->selectedConversation->id)
            ->skip($this->messages_count - $this->paginaterVar)
            ->take($this->paginaterVar)->get();

            $this->dispatchBrowserEvent('chatSelected');
    }

    public function render()
    {
        return view('livewire.chat.chatbox');
    }
}

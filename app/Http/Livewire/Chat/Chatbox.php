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
    public $height;

    protected $listeners = ['loadConversation','pushMessage','loadmore','updateHeight'];

    public function pushMessage($messageId)
    {
        $newMessage = Message::find($messageId);
        $this->messages->push($newMessage);

        $this->dispatchBrowserEvent('rowChatToBottom');
    }

    public function loadmore()
    {
        // dd('Top reached');
        $this->paginaterVar = $this->paginaterVar + 10;
        $this->messages = Message::where('conversation_id',$this->selectedConversation->id)
        ->skip($this->messages_count - $this->paginaterVar)
        ->take($this->paginaterVar)->get();

        $height = $this->height;
        $this->dispatchBrowserEvent('updatedHeight',($height));
    }

    public function updateHeight($height)
    {
        // dd($height);
        $this->height = $height;

    }

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

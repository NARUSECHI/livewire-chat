<?php

namespace App\Http\Livewire\Chat;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class CreateChat extends Component
{
    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function render()
    {
        $users = $this->user->where('id','!=', Auth::user()->id)->get();
        return view('livewire.chat.create-chat')->with('users',$users);
    }
}

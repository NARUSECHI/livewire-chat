    {{-- Because she competes with no one, no one can compete with her. --}}
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="chat_container">
        <div class="chat_list_container">
            @livewire('chat.chat-list')
        </div>
        <div class="chat_box_container">
            @livewire('chat.chatbox')

            @livewire('chat.message')
        </div>
    </div>
</div>

@endsection


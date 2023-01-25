    {{-- Because she competes with no one, no one can compete with her. --}}
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Chat') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
<div class="chat_container">
    <div class="chat_list_container">
        @livewire('chat.chat-list')
    </div>
    <div class="chat_box_container">
        @livewire('chat.chatbox')

        @livewire('chat.message')
    </div>
</div>
@endsection


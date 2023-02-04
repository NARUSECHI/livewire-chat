<div>
    {{-- Be like water. --}}
    <div class="chat_list_header">
        <div class="title">
            Chat
        </div>
        
        <div class="img_container">
            <img src="https://picsum.photos/id/237/200/300">
        </div>
    </div>
    <div class="chat_list_body">
        @if(count($conversations) > 0)
            @foreach ($conversations as $conversation)
            <div class="chat_list_item">
                <div class="chat_list_img_container">
                    <img src="https://picsum.photos/id/{{ $this->getChatUserInstance($conversation, $name = 'id') }}/200/300">
                </div>
                <div class="chat_list_info">
                    <div class="top_row">
                        <div class="list_username">{{ $this->getChatUserInstance($conversation, $name = 'name') }}</div>
                        <div class="date">{{ $conversation->messages->last()->created_at->shortAbsoluteDiffForHumans() }}</div>
                    </div>
    
                    <div class="bottom_row">
                        <div class="message_body text-truncate">
                            {{ $conversation->messages->last()->body }}
                        </div>
                        <div class="unread_count">
                            56
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        @else
            You have no conversations.
        @endif
    </div>    
    
</div>

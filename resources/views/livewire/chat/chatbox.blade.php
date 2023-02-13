<div>
    {{-- If you look to others for fulfillment, you will never truly be fulfilled. --}}
    @if($selectedConversation)
    <div class="chat_box_header">
        <div class="return">
            <i class="bi bi-arrow-left"></i>
        </div>
        <div class="img_container">
            <img src="https://ui-avatars.com/api/?name={{ $receiverInstance->name }}">
        </div>

        <div class="name">
            {{ $receiverInstance->name }}
        </div>
        <div class="info">
            <div class="info_item">
                <i class="bi bi-telephone-fill"></i>
            </div>
            <div class="info_item">
                <i class="bi bi-image"></i>
            </div>
            <div class="info_item">
                <i class="bi bi-info-square-fill"></i>
            </div>

        </div>
    </div>
    <div class="chat_box_body">
        @foreach ($messages as $message)
            @if ($message->sender_id == Auth::user()->id)
                <div wire:key="{{$message->id}}" class="msg_body msg_body_me">
                    {{$message->body}}
                    <div class="msg_body_footer">
                        <div class="date">
                            {{$message->created_at->format('m: i a')}}
                        </div>
                        <div class="read">
                            <i class="bi bi-check"></i>
                        </div>
                    </div>
                </div>
            @else
                <div wire:key="{{$message->id}}" class="msg_body msg_body_receiver">
                    {{$message->body}}
                    <div class="msg_body_footer">
                        <div class="date">
                            {{$message->created_at->shortAbsoluteDiffForHumans()}}
                        </div>
                        <div class="read">
                            <i class="bi bi-check"></i>
                        </div>
                    </div>
                </div>
            @endif
            
        @endforeach
    </div>
    @else
    <div class="fs-4 text-center text-primary mt-4">
        No conversation selected
    </div>
    @endif
</div>

<div>

    @if ($selectedConversation)
        <div class="chat_box_footer">
            <form wire:submit.prevent="sendMessage" action="">
                @csrf
                <div class="custom_form_group">


                <input wire:model="body" type="text" name="message" id="message" class="control" placeholder="Write message ...">
                <submit type="submit" class="submit">Send</submit>
                </div>
                
            </form>
        </div>
    @else
        
    @endif
    
</div>

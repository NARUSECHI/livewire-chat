<div>
    @if ($selectedConversation)
        <div class="chat_box_footer">
            <form wire:submit.prevent="sendMessage">
                <div class="custom_form_group">
                    <input type="text" wire:model="body" class="control" placeholder="Write message ...">
                    <button type="submit" class="submit">Send</button>
                </div>
            </form>
        </div>
    @else
        
    @endif
</div>

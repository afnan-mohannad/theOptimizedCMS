<?php

namespace App\Livewire\Admin\Messages;

use App\Models\Message;
use Livewire\Component;

class MessagesShow extends Component
{
    public $message, $name, $email, $message_content;

    protected $listeners = ['messageShow'];

    public function messageShow($id)
    {
        // fill $message with the eloquent model of the same id
        $message = Message::find($id);
        $this->name = $message->name;
        $this->email = $message->email;
        $this->message_content = $message->message;
        $this->dispatch('showModalToggle');
    }

    public function render()
    {
        return view('livewire.admin.messages.messages-show');
    }
}

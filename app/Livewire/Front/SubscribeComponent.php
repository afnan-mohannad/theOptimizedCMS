<?php

namespace App\Livewire\Front;

use Livewire\Component;
use App\Models\Subscriber;
use App\Rules\EmailValidation;

class SubscribeComponent extends Component
{
    public $email, $country_code;

    public function rules()
    {
        return [
            'email' => ['required', 'unique:subscribers,email', 'regex:/(.+)@(.+)\.(.+)/i',new EmailValidation],
        ];
    }

    public function submit()
    {
        $this->validate();
        Subscriber::storeSubscriber($this->email,$this->country_code);
        $this->reset('email');
        session()->flash('message', __('home.Email Subscribes Successfully'));
    }
    
    public function render()
    {
        return view('livewire.front.subscribe-component');
    }
}

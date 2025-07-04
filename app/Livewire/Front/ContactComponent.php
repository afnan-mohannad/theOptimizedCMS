<?php

namespace App\Livewire\Front;

use App\Models\Message;
use Livewire\Component;
use App\Rules\ReCaptcha;
use App\Rules\EmailValidation;
use Illuminate\Support\Facades\Http;

class ContactComponent extends Component
{
    public $name, $email, $message, $captcha = 0;

    public function updatedCaptcha($token)
    {
       
        $response = Http::post('https://www.google.com/recaptcha/api/siteverify?secret=' .config('customConfig.google_recaptcha_secret'). '&response=' . $token);
        $this->captcha = $response->json()['score'];

        if ($this->captcha > 0.8) {
            $this->submit();
        } else {
            return session()->flash('success', 'Google thinks you are a bot, please refresh and try again');
        }
     
    }

    public function rules()
    {
        return [
            'name' => 'required',
            'email' => ['required', 'email', 'regex:/(.+)@(.+)\.(.+)/i', new EmailValidation],
            'message' => 'required'
        ];
    }

    public function submit()
    {
        $this->validate();
        Message::storeMessage($this->name,$this->email,$this->message);
        $this->reset('name', 'email', 'message');
        session()->flash('message', __('home.Message sent successfully'));
    }

    public function render()
    {
        return view('livewire.front.contact-component');
    }
}

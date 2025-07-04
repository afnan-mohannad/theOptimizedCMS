<?php

use App\Livewire\Forms\LoginForm;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('backend.auth')] class extends Component
{
    public LoginForm $form;

    /**
     * Handle an incoming authentication request.
     */
    public function login(): void
    {
        $this->validate();

        $this->form->authenticate();

        Session::regenerate();

        $this->redirect(
            session('url.intended', RouteServiceProvider::HOME),
            navigate: false
        );
    }
}; ?>

<!-- Session Status -->
<x-auth-session-status class="mb-4" :status="session('status')" />
<!--begin::Root-->
<div class="d-flex flex-column flex-root h-100">
    <!--begin::Page bg image-->
    {{-- <style>body { background-image: url('{{asset('assets/backend/images/background/bg5-dark.jpg')}}');}</style> --}}
    <style>main{height: 100%;}</style>
    <div class='box'>
        <div class='wave -one'> </div>
        <div class='wave -two'></div>
        <div class='wave -three'></div>
    </div>
    <!--end::Page bg image-->
    <!--begin::Authentication - Sign-in -->
    <div class="d-flex flex-column flex-column-fluid flex-lg-row h-100">
        <!--begin::Aside-->
        <div class="d-flex flex-center w-lg-50 pt-15 pt-lg-0 px-10">
            <!--begin::Aside-->
            <div class="d-flex flex-column">
                <!--begin::Logo-->
                <div>
                    <a href="/" wire:navigate>
                        <x-application-logo-light-1 class="w-20 h-20 fill-current text-gray-500" />
                    </a>
                </div>
                <!--end::Logo--> 
                <!--begin::Title-->
                <h2 class="text-white fw-normal m-0">{{__('admin.auth.note2')}}</h2>
                <!--end::Title-->
            </div>
            <!--begin::Aside-->
        </div>
        <!--begin::Aside-->
        <!--begin::Body-->
        <div class="d-flex flex-center w-lg-50 p-10">
            <!--begin::Card-->
            <div class="card rounded-3 w-md-550px">
                <!--begin::Card body-->
                <div class="card-body p-10 p-lg-20">
                    <!--begin::Form-->
                    <form class="form w-100" wire:submit="login">
                        <!--begin::Heading-->
                        <div class="text-center mb-11">
                            <!--begin::Title-->
                            <h1 class="text-dark fw-bolder mb-3">{{__('admin.auth.Sign In')}}</h1>
                            <!--end::Title-->
                            <!--begin::Subtitle-->
                            <div class="text-gray-500 fw-semibold fs-6">{{__('admin.auth.note1')}}</div>
                            <!--end::Subtitle=-->
                        </div>
                        <!--begin::Heading-->
                        
                        <!-- Email Address -->
                        <div>
                            <x-text-input wire:model="form.email" id="email" class="form-control bg-transparentl" type="email" name="email" required autofocus autocomplete="username" placeholder="{{__('admin.users.Email')}}"/>
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>

                        <!-- Password -->
                        <div class="position-relative">
                            <div class="mt-4">
                                <x-text-input wire:model="form.password" id="password" class="form-control bg-transparent" placeholder="{{__('admin.users.Password')}}"
                                                type="password"
                                                name="password"
                                                required autocomplete="current-password" />
                                <x-input-error :messages="$errors->get('password')" class="mt-2" />
                            </div>
                            <i class="bi bi-eye-slash" id="togglePassword"></i>
                        </div>
                        <!-- Remember Me -->
                        <div class="checkbox-wrapper-1 mt-5">
                            <input wire:model="form.remember" id="remember" type="checkbox" class="substituted" type="checkbox" aria-hidden="true" name="remember"/>
                            <label for="remember" class="text-sm text-gray-600"> 
                                {{ __('admin.auth.Remember me') }}
                            </label>
                        </div>
                        
                        <!--begin::Submit button-->
                        <div class="flex items-center justify-end mt-4">
                            @if (Route::has('password.request'))
                                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}" wire:navigate>
                                    {{ __('Forgot your password?') }}
                                </a>
                            @endif
                
                            <x-primary-button class="ms-3 w-100 button">
                                <span>{{ __('admin.auth.Sign In') }} </span>
                            </x-primary-button>
                        </div>
                        <!--end::Submit button-->
                    </form>
                    <!--end::Form-->
                </div>
                <!--end::Card body-->
            </div>
            <!--end::Card-->
        </div>
        <!--end::Body-->
    </div>
    <!--end::Authentication - Sign-in-->
</div>
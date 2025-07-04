<form wire:submit.prevent='submit'>
    @if (session()->has('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif
    <div class="contactUsDiv">
        <div class="d-flex gap-4">
            <div class="contactUsEl">
                <label>{{__('admin.Name')}}</label>
                <input type="text" class="form-control" placeholder="{{__('home.Enter Your Name')}}" wire:model='name' required>
                @error('name') 
                   <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
            <div class="contactUsEl">
                <label>{{__('admin.users.Email')}}</label>
                <input type="email" class="form-control" placeholder="{{__('home.Enter your Email')}}" wire:model='email' required>
                @error('email') 
                    <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
        </div>
        <div class="contactUsEl">
            <label>{{__('home.Your Messages')}}</label>
            <textarea class="form-control" rows="5" placeholder="{{__('home.Enter Your Messages')}}" wire:model='message' required></textarea>
            @error('message') 
                <span class="text-danger">{{$message}}</span>
            @enderror
        </div>
        <div id="captcha" class="mt-4" wire:ignore></div>
 
        @error('captcha')
            <p class="mt-3 text-sm text-red-600 text-left">
                {{ $message }}
            </p>
        @enderror
        <button class="send-button g-recaptcha" 
                type="submit"
                data-sitekey="{{config('customConfig.google_recaptcha_key')}}"
                data-callback='handle'
                data-action='submit'
        >{{__('home.Send')}}</button>
    </div>
</form>

@section('script')
<script src="https://www.google.com/recaptcha/api.js?render={{config('customConfig.google_recaptcha_key')}}"></script>
<script>
    function handle(e) {
        grecaptcha.ready(function () {
            grecaptcha.execute('{{config('customConfig.google_recaptcha_key')}}', {action: 'submit'})
                .then(function (token) {
                    @this.set('captcha', token);
                });
        })
    }
</script>
@endsection

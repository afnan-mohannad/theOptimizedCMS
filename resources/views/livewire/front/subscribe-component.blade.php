<form class="h-100" wire:submit.prevent='submit'>
    <div class="contact h-100">
        <h2>{{__('home.Get Exclusive Content')}}</h2>
        <span>{{__('home.Get Exclusive Content')}}</span>
        <div class="position-relative w-100 mb-3">
            <input type="email" class="form-control" value="" placeholder="{{__('home.Enter Your Email')}}" wire:model='email'>
            <img src="{{config('customConfig.cdn_assets_url')}}/frontend/images/main/mail.svg" class="img-fluid emailIcon" width="17"
            height="17" alt="email" title="email" />
        </div>
        @error('email') 
            <span class="text-danger">{{ $message }}</span>
        @enderror
        @if (session()->has('message'))
            <span class="text-success">
                {{ session('message') }}
            </span>
        @endif
        <button type="submit">{{__('home.Subscribes')}}</button>
    </div>
</form>



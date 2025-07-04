{{--  Add Navbar Code Here   --}}
@section('style')

@endsection

<div class="topleft">
    <p>Logo</p>
</div>
<div class="topright">
    <p>
        @if (app()->getLocale() == 'en')
    <a href="{{ route('language', 'ar') }}" title="ar">
        ar
    </a>
    @else
    <a href="{{ route('language', 'en') }}" title="en">
        en
    </a>
    @endif
    <span> | </span>
    @auth
        <a href="{{ route('app.dashboard') }}">Dashboard</a>
    @else
        <a href="{{ route('login') }}">Log in</a>

        @if (Route::has('register'))
            <a href="{{ route('register') }}">Register</a>
        @endif
    @endauth
    </p>
</div>


</a>

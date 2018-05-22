@guest
    @include('inc.nav.guest')
@else
    @if (Auth::user()->position > 0)
        @include('inc.nav.bankoff')
    @else
        @include('inc.nav.admin')
    @endif
@endguest
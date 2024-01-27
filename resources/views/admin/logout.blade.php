@auth
<li class="nav-item dropdown">
    <a class="btn btn-outline-light dropdown-toggle" id="userDropdown" data-toggle="dropdown"
        aria-haspopup="true" aria-expanded="false">
        {{ Auth::user()->name }}
    </a>
    <div class="dropdown-menu" aria-labelledby="userDropdown">
        <a class="dropdown-item" href="{{ route('/') }}">Main</a>
        <a class="dropdown-item" href="{{ route('profile.show') }}">Profile</a>
        <a class="dropdown-item" href="{{ route('logout') }}"
            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            Logout
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST"
            style="display: none;">
            @csrf
        </form>
    </div>
</li>
@endauth

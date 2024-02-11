<!-- header section starts -->
<header class="header_section">
    <div class="container">
        <nav class="navbar navbar-expand-lg custom_nav-container">
            <a class="navbar-brand" href="{{ route('/') }}" ><img width="250" src="/home/images/logo.png" alt="#" /></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class=""> </span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav">
                    <li class="nav-item active">
                        <a class="nav-link" href="{{ route('/') }}">Home <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" role="button"
                            aria-haspopup="true" aria-expanded="true"> <span class="nav-label">Pages <span
                                    class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="about.html">About</a></li>
                            <li><a href="testimonial.html">Testimonial</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('product')}}">Products</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="blog_list.html">Blog</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="contact.html">Contact</a>
                    </li>
                    @auth
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('carts.index') }}">Cart</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('order.index') }}">Order</a>
                    </li>
                    @endauth
                    <form class="form-inline" id="shopping_cart">
                        <button class="btn  my-2 my-sm-0 nav_search-btn" type="submit">
                            <i class="fa fa-search" aria-hidden="true"></i>
                        </button>
                    </form>

                    @if (Route::has('login'))
                            @auth
                                <li class="nav-item dropdown">
                                    <a class="btn btn-outline-dark dropdown-toggle" id="userDropdown" data-toggle="dropdown"
                                        aria-haspopup="true" aria-expanded="false">
                                        {{ Auth::user()->name }}
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="userDropdown">
                                        <a class="dropdown-item" href="{{ route('redirect') }}">Dashboard</a>
                                        <a class="dropdown-item" href="{{ route('profile.show') }}">Profile</a>
                                        @if(app('App\Http\Controllers\HomeController')->user())
                                            <a class="dropdown-item" href="{{ route('carts.index') }}">My Cart</a>
                                        @endif<a class="dropdown-item" href="{{ route('logout') }}"
                                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                            style="display: none;">
                                            @csrf
                                        </form>
                                    </div>
                                </li>
                            @else
                            <li class="nav-item">
                                <a class="btn btn-primary" id="logincss" href="{{ route('login') }}">Login</a>
                            </li>
                            <li class="nav-item">
                                <a class="btn btn-success" href="{{ route('register') }}">Register</a>
                            </li>
                        @endauth
                    @endif
                </ul>
            </div>
        </nav>
    </div>
</header>
<!-- end header section -->

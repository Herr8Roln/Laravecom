<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Styles -->
    @livewireStyles

    <!-- Include header -->

    <script>
        function toggleUserDropdown() {
            const dropdown = document.getElementById('userDropdown');
            dropdown.classList.toggle('hidden');
        }

        function toggleDropdown() {
            const navbar = document.getElementById('navbarSupportedContent');
            navbar.classList.toggle('hidden');
        }
    </script>

</head>
<body class="font-sans antialiased">
    <div class="bg-white">
        <!-- header section starts -->
        <header class="header_section container mx-auto px-4 py-6">
            <div class="flex justify-between items-center">
                <a class="navbar-brand" href="{{ route('/') }}" >
                    <img class="w-64" src="/home/images/logo.png" alt="#" />
                </a>


                <button class="block lg:hidden navbar-toggler" type="button" onclick="toggleDropdown()" aria-label="Toggle navigation">
                    <span class=""> </span>
                </button>
                <div class="hidden lg:flex flex-grow items-center justify-end" id="navbarSupportedContent">
                    <ul class="flex flex-wrap items-center">
                        <!-- Other menu items -->
                        <!-- ... -->
                        <li class="nav-item dropdown relative">
                            <button class="btn btn-outline-dark" id="userDropdownBtn" onclick="toggleUserDropdown()">
                                {{ Auth::user()->name }}
                            </button>
                            <div class="dropdown-menu absolute hidden bg-white rounded shadow-lg mt-2 py-2 w-48 lg:w-auto left-0 lg:left-auto" id="userDropdown" aria-labelledby="userDropdownBtn">
                                <a class="dropdown-item block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" href="{{ route('/') }}">Home</a>
                                <a class="dropdown-item block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" href="{{ route('redirect') }}">Home</a>
                                <a class="dropdown-item block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" href="{{ route('profile.show') }}">Profile</a>
                                <a class="dropdown-item block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" href="{{ route('carts.index') }}">My Cart</a>
                                <a class="dropdown-item block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" href="{{ route('order.index') }}">My Orders</a>

                                <!-- Add more dropdown items as needed -->
                                <a class="dropdown-item block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" href="{{ route('logout') }}"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    Logout
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </header>
        <!-- end header section -->
    </div>





    <x-banner />

    <div class="min-h-screen bg-gray-100">

        <!-- Page Heading -->
        @if (isset($header))
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endif

        <!-- Page Content -->
        <main>
            {{ $slot }}
        </main>
    </div>

    @stack('modals')

    @livewireScripts
</body>
</html>

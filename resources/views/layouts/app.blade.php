<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400&display=swap" rel="stylesheet"> 
    

    <!-- Styles -->
    <link href="{{ asset('css/tailwind/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    
</head>
<body>
    <div id="app">
        <nav class="flex w-full bg-gray-800 shadow-md">
            <div class="flex justify-between items-center py-4 px-10 w-full">
                <a class="text-white font-semibold" href="{{ url('/tasks') }}">
                    {{ config('app.name', 'Laravel Test') }} | Hi {{ Auth::user()->name }}
                </a>
                <button class="lg-hide" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="text-white w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                        </svg>
                    </span>
                </button>

                <div class="flex" id="navbarSupportedContent">
                    <!-- Right Side Of Navbar -->
                    <ul class="flex gap-3" class="list-group">
                        
                        <li class="nav-item">
                            <a href="{{ route('tasks.index') }}" class="text-white">
                                Tasks
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('projects.index') }}" class="text-white">
                                Projects
                            </a>
                        </li>

                        <li class="nav-item dropdown">
                            <a href="{{ route('logout') }}" class="text-white"
                                onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <div>
                                

                                <form class="hidden" id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <main class="p-4">
            @yield('content')
        </main>
    </div>
    @yield('scripts')
</body>
</html>
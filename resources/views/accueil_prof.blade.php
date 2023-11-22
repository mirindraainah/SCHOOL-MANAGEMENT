<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    @livewireStyles
    
    <!-- TAILWIND CSS -->
    <link href="{{ asset('assets/fontawesome/css/fontawesome-all.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/tailwind.css') }}" rel="stylesheet">
    
    <script src="{{ asset('assets/js/charts.js') }}"></script>

    {{-- <style>
        @import url('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css');
    </style> --}}
    <style>
        nav{
            z-index: 3;
        }    
    </style> 

    <title>S'Cool</title>
</head>
<body class="antialiased bg-gray-100">
    <div class="flex relative" x-data="{navOpen: false}">
        <!-- NAV -->
        <nav class="absolute md:relative w-64 transform -translate-x-full md:translate-x-0 h-screen overflow-y-scroll bg-black transition-all duration-300" :class="{'-translate-x-full': !navOpen}">
            <div class="flex flex-col justify-between h-full">
                <div class="p-4">
                    <!-- LOGO -->
                    <a class="flex items-center text-white space-x-4" href="">
                        <svg class="w-7 h-7 bg-indigo-600 rounded-lg p-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l-6-6m0 0l6-6m6 6l6-6"></path></svg>
                        <span class="text-2xl font-bold">S'Cool</span>
                    </a>

                    <!-- SEARCH BAR -->
                    <div class="border-gray-700 py-5 text-white border-b rounded">
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-2">
                                <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                            </div>
                            <form action="" method="GET">
                                <input type="search" class="w-full py-2 rounded pl-10 bg-gray-800 border-none focus:outline-none focus:ring-0" placeholder="Rechercher">
                            </form>
                        </div>
                        <!-- SEARCH RESULT -->
                    </div>

                    <!-- NAV LINKS -->
                    <div class="py-4 text-gray-400 space-y-1">
                        <!-- BASIC LINK -->
                        <a href="{{ route('professor.dashboard') }}" class="block py-2.5 px-4 flex items-center space-x-2 bg-gray-800 text-white hover:bg-gray-800 hover:text-white rounded">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 8v8m-4-5v5m-4-2v2m-2 4h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            <span>Accueil</span>
                        </a>
                        <!-- DROPDOWN LINK -->
                        <div class="block" x-data="{open: localStorage.getItem('dropdownOpen') === 'true' }">
                            <div @click="open = !open; localStorage.setItem('dropdownOpen', open ? 'true' : 'false')" class="flex items-center justify-between hover:bg-gray-800 hover:text-white cursor-pointer py-2.5 px-4 rounded">
                                <div class="flex items-center space-x-2">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10m-8-14v10l8 4"></path></svg>
                                    <span>Menu</span>
                                </div>
                                <svg x-show="open" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7"></path></svg>
                                <svg x-show="!open" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                            </div>
                            <div x-show="open" class="text-sm border-l-2 border-gray-800 mx-6 my-2.5 px-2.5 flex flex-col gap-y-1">
                                <a href="{{ route('professor.students-by-class') }}" class="block py-2 px-4 hover:bg-gray-800 hover:text-white rounded">
                                    Elève
                                </a>
                                <a href="{{ route('professor.afficher-notes') }}" class="block py-2 px-4 hover:bg-gray-800 hover:text-white rounded">
                                    Affichage Notes 
                                </a>
                                
                                <a href="{{ route('professor.afficher-note') }}" class="block py-2 px-4 hover:bg-gray-800 hover:text-white rounded">
                                    Résultat
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- PROFILE -->
                <div class="text-gray-200 border-gray-800 rounded flex items-center justify-between p-2">
                    <div class="flex items-center space-x-2">
                        <!-- AVATAR IMAGE OR INITIALS -->
                        @auth
                            @if(Auth::user()->photo)
                                <img src="{{ asset('imageUser/' . Auth::user()->photo) }}" class="w-7 h-7 rounded-full" alt="Photo de profil">
                            @else
                                @php
                                    $initials = strtoupper(substr(Auth::user()->name, 0, 2)); // Obtenez les deux premières lettres du nom en majuscules
                                @endphp
                                <img src="https://ui-avatars.com/api/?name={{ urlencode($initials) }}&size=128&background=ff4433&color=fff" class="w-7 h-7 rounded-full" alt="Initiales de profil">
                            @endif
                        @endauth
                        <h1>{{ Auth::user()->name }}</h1>
                    </div>
                    <a href="{{ route('profile.edit') }}" class="hover:bg-gray-800 hover:text-white p-2 rounded" style="margin-left: 40%">
                        <i class="fas fa-user"></i>
                    </a> 
                    @auth
                    <a href="#" onclick="event.preventDefault(); document.getElementById('logoutForm').submit()" class="hover:bg-gray-800 hover:text-white p-2 rounded">
                        <form id="logoutForm" action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                            </button>
                        </form>
                    </a>
                    @endauth
                </div>
            </div>
        </nav>
        <!-- END OF NAV -->

        <!-- PAGE CONTENT -->
        <main class="flex-1 h-screen overflow-y-scroll overflow-x-hidden">
            <div class="md:hidden justify-between items-center bg-black text-white flex">
                <h1 class="text-2xl font-bold px-4">S'Cool</h1>
                <button @click="navOpen = !navOpen; localStorage.setItem('menuOpen', navOpen ? 'true' : 'false')" class="btn p-4 focus:outline-none hover:bg-gray-800">
                    <svg class="w-6 h-6 fill-current" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path></svg>
                </button>
            </div>
            <section class="max-w-7xl mx-auto py-4 px-5">
                <div class="flex justify-between items-center border-b border-gray-300">
                    <h1 class="text-2xl font-semibold pt-2 pb-6"></h1>
                </div>

                
                {{-- contenu --}}
                <div class="pt-5">
                    @yield('content')
                </div>
                <!--fin contenu -->
                
            </section>
            <!-- END OF PAGE CONTENT -->
        </main>
    </div>
    <!-- ALPINE JS -->
    <script src="{{ asset('assets/js/alpine.js') }}"></script>
    
    @include('sweetalert::alert')
    <script src="{{ asset('vendor/sweetalert/sweetalert.all.js') }}"></script>
    <script src="{{ asset('vendor/sweetalert/sweetalert.min.js') }}"></script>
    
    @livewireScripts
</body>
</html>

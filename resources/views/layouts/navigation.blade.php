<nav x-data="{ open: false }" class="bg-white/80 backdrop-blur border-b border-gray-200 shadow-sm sticky top-0 z-50">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="flex justify-between h-16">

            <!-- LEFT -->
            <div class="flex items-center gap-6">

                <!-- Logo -->
                <a href="{{ route('dashboard') }}" class="flex items-center gap-3">
                    <x-application-logo class="h-9 w-auto text-indigo-600" />
                    <span class="font-bold text-lg text-gray-800">
                        Recruitment AI
                    </span>
                </a>

                <!-- MENU -->
                <div class="hidden sm:flex items-center gap-2">

                    @php
                        $link = "px-4 py-2 rounded-xl text-sm font-medium transition";
                    @endphp

                    <a href="{{ route('dashboard') }}"
                       class="{{ $link }} {{ request()->routeIs('dashboard') ? 'bg-indigo-100 text-indigo-700' : 'text-gray-600 hover:bg-gray-100' }}">
                        Dashboard
                    </a>

                    <a href="{{ route('cv.index') }}"
                       class="{{ $link }} {{ request()->is('cv*') ? 'bg-blue-100 text-blue-700' : 'text-gray-600 hover:bg-gray-100' }}">
                        CV
                    </a>

                    <a href="{{ route('interview.index') }}"
                       class="{{ $link }} {{ request()->is('interview*') ? 'bg-green-100 text-green-700' : 'text-gray-600 hover:bg-gray-100' }}">
                        Interview
                    </a>

                    <a href="{{ route('match.index') }}"
                       class="{{ $link }} {{ request()->is('match*') ? 'bg-purple-100 text-purple-700' : 'text-gray-600 hover:bg-gray-100' }}">
                        Match
                    </a>

                    <a href="{{ route('cvbuilder.index') }}"
                       class="{{ $link }} {{ request()->is('cvbuilder*') ? 'bg-orange-100 text-orange-700' : 'text-gray-600 hover:bg-gray-100' }}">
                        Builder
                    </a>

                </div>

            </div>

            <!-- USER DROPDOWN -->
            <div class="flex items-center">

                <div x-data="{ openUser: false }" class="relative">

                    <!-- BUTTON -->
                    <button @click="openUser = !openUser"
                            class="flex items-center gap-3 px-3 py-2 rounded-xl bg-gray-50 hover:bg-gray-100 transition">

                        <div class="w-9 h-9 rounded-full bg-gradient-to-r from-indigo-500 to-purple-600 text-white flex items-center justify-center font-bold">
                            {{ strtoupper(substr(Auth::user()->name,0,1)) }}
                        </div>

                        <div class="text-left hidden sm:block">
                            <div class="text-sm font-semibold text-gray-800">
                                {{ Auth::user()->name }}
                            </div>
                        </div>

                        <svg class="w-4 h-4 text-gray-500" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                  d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z"/>
                        </svg>

                    </button>

                    <!-- DROPDOWN -->
                    <div x-show="openUser"
                         @click.away="openUser = false"
                         class="absolute right-0 mt-2 w-48 bg-white border rounded-xl shadow-lg z-50">

                        <a href="{{ route('profile.edit') }}"
                           class="block px-4 py-2 text-sm hover:bg-gray-100">
                            👤 Profil
                        </a>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit"
                                    class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50">
                                🚪 Logout
                            </button>
                        </form>

                    </div>

                </div>

            </div>

        </div>
    </div>

    <!-- MOBILE -->
    <div x-show="open" class="sm:hidden border-t bg-white">
        <div class="p-4 space-y-2">
            <a href="/dashboard" class="block">Dashboard</a>
            <a href="/cv" class="block">CV</a>
            <a href="/interview" class="block">Interview</a>
        </div>
    </div>

</nav>
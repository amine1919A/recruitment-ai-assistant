<nav x-data="{ open: false }" class="bg-white border-b border-gray-200 shadow-sm">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="flex justify-between h-16">

            <!-- LEFT -->
            <div class="flex items-center">

                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}" class="flex items-center gap-3">
                        <x-application-logo class="block h-10 w-auto fill-current text-indigo-600" />
                        <span class="font-bold text-xl text-gray-800">
                            Recruitment AI
                        </span>
                    </a>
                </div>

                <!-- Desktop Menu -->
                <div class="hidden sm:flex sm:items-center sm:space-x-2 sm:ms-10">

                    <a href="{{ route('dashboard') }}"
                       class="px-4 py-2 rounded-lg text-sm font-medium transition
                       {{ request()->routeIs('dashboard') ? 'bg-indigo-100 text-indigo-700' : 'text-gray-700 hover:bg-gray-100' }}">
                        Dashboard
                    </a>

                    <a href="{{ route('cv.index') }}"
                       class="px-4 py-2 rounded-lg text-sm font-medium transition
                       {{ request()->is('cv*') ? 'bg-blue-100 text-blue-700' : 'text-gray-700 hover:bg-gray-100' }}">
                        Analyse CV
                    </a>

                    <a href="{{ route('interview.index') }}"
                       class="px-4 py-2 rounded-lg text-sm font-medium transition
                       {{ request()->is('interview*') ? 'bg-green-100 text-green-700' : 'text-gray-700 hover:bg-gray-100' }}">
                        Interview AI
                    </a>

                    <a href="{{ route('match.index') }}"
                       class="px-4 py-2 rounded-lg text-sm font-medium transition
                       {{ request()->is('match*') ? 'bg-purple-100 text-purple-700' : 'text-gray-700 hover:bg-gray-100' }}">
                        Job Match
                    </a>

                    <a href="{{ route('cvbuilder.index') }}"
                       class="px-4 py-2 rounded-lg text-sm font-medium transition
                       {{ request()->is('cvbuilder*') ? 'bg-orange-100 text-orange-700' : 'text-gray-700 hover:bg-gray-100' }}">
                        CV Builder
                    </a>

                    <a href="{{ route('admin.index') }}"
                       class="px-4 py-2 rounded-lg text-sm font-medium transition
                       {{ request()->is('admin*') ? 'bg-gray-200 text-gray-700' : 'text-gray-700 hover:bg-gray-100' }}">
                        Admin
                    </a>

                </div>

            </div>

            <!-- USER -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">

                <x-dropdown align="right" width="56">

                    <x-slot name="trigger">
                        <button
                            class="inline-flex items-center gap-3 px-4 py-2 bg-gray-50 border border-gray-200 rounded-xl hover:bg-gray-100 transition">

                            <div
                                class="w-9 h-9 rounded-full bg-gradient-to-r from-indigo-500 to-purple-600 text-white flex items-center justify-center font-bold">
                                {{ strtoupper(substr(Auth::user()->name,0,1)) }}
                            </div>

                            <div class="text-left">
                                <div class="text-sm font-semibold text-gray-800">
                                    {{ Auth::user()->name }}
                                </div>
                                <div class="text-xs text-gray-500">
                                    {{ Auth::user()->email }}
                                </div>
                            </div>

                            <svg class="w-4 h-4 text-gray-500"
                                 xmlns="http://www.w3.org/2000/svg"
                                 viewBox="0 0 20 20"
                                 fill="currentColor">
                                <path fill-rule="evenodd"
                                      d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z"
                                      clip-rule="evenodd" />
                            </svg>

                        </button>
                    </x-slot>

                    <x-slot name="content">

                        <x-dropdown-link :href="route('profile.edit')">
                            👤 Mon Profil
                        </x-dropdown-link>

                        <div class="border-t border-gray-200 my-1"></div>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <button
                                type="submit"
                                class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50 transition">
                                🚪 Déconnexion
                            </button>

                        </form>

                    </x-slot>

                </x-dropdown>

            </div>

            <!-- Mobile Button -->
            <div class="-me-2 flex items-center sm:hidden">

                <button
                    @click="open = !open"
                    class="inline-flex items-center justify-center p-2 rounded-md text-gray-500 hover:bg-gray-100">

                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">

                        <path
                            :class="{ 'hidden': open, 'inline-flex': !open }"
                            class="inline-flex"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />

                        <path
                            :class="{ 'hidden': !open, 'inline-flex': open }"
                            class="hidden"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />

                    </svg>

                </button>

            </div>

        </div>

    </div>

    <!-- Mobile Menu -->
    <div x-show="open" class="sm:hidden border-t border-gray-200 bg-white">

        <div class="px-4 py-4 space-y-2">

            <a href="{{ route('dashboard') }}" class="block py-2">
                Dashboard
            </a>

            <a href="{{ route('cv.index') }}" class="block py-2">
                Analyse CV
            </a>

            <a href="{{ route('interview.index') }}" class="block py-2">
                Interview AI
            </a>

            <a href="{{ route('match.index') }}" class="block py-2">
                Job Match
            </a>

            <a href="{{ route('cvbuilder.index') }}" class="block py-2">
                CV Builder
            </a>

            <a href="{{ route('admin.index') }}" class="block py-2">
                Admin
            </a>

        </div>

        <div class="border-t border-gray-200 p-4">

            <div class="mb-4">
                <div class="font-semibold text-gray-800">
                    {{ Auth::user()->name }}
                </div>

                <div class="text-sm text-gray-500">
                    {{ Auth::user()->email }}
                </div>
            </div>

            <a href="{{ route('profile.edit') }}"
               class="block py-2 text-gray-700">
                👤 Mon Profil
            </a>

            <form method="POST" action="{{ route('logout') }}" class="mt-3">
                @csrf

                <button
                    type="submit"
                    class="w-full bg-red-600 text-white py-2 rounded-lg hover:bg-red-700 transition">
                    🚪 Déconnexion
                </button>
            </form>

        </div>

    </div>

</nav>
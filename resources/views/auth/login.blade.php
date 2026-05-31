<x-guest-layout>

    <div class="w-full max-w-md mx-auto">

        <div class="text-center mb-8">

            <div class="mx-auto w-20 h-20 rounded-2xl bg-gradient-to-r from-indigo-600 to-purple-600 flex items-center justify-center shadow-xl">
                <span class="text-white text-3xl font-bold">AI</span>
            </div>

            <h1 class="mt-6 text-3xl font-bold text-gray-900">
                Recruitment AI
            </h1>

            <p class="mt-2 text-gray-500">
                Connectez-vous pour analyser vos CV avec l'IA
            </p>

        </div>

        <div class="bg-white shadow-2xl rounded-3xl p-8 border border-gray-100">

            <x-auth-session-status
                class="mb-4"
                :status="session('status')" />

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- EMAIL -->
                <div>
                    <x-input-label
                        for="email"
                        value="Adresse Email" />

                    <x-text-input
                        id="email"
                        class="block mt-2 w-full rounded-xl"
                        type="email"
                        name="email"
                        :value="old('email')"
                        required
                        autofocus
                        autocomplete="username" />

                    <x-input-error
                        :messages="$errors->get('email')"
                        class="mt-2" />
                </div>

                <!-- PASSWORD -->
                <div class="mt-5">

                    <x-input-label
                        for="password"
                        value="Mot de passe" />

                    <x-text-input
                        id="password"
                        class="block mt-2 w-full rounded-xl"
                        type="password"
                        name="password"
                        required
                        autocomplete="current-password" />

                    <x-input-error
                        :messages="$errors->get('password')"
                        class="mt-2" />

                </div>

                <!-- REMEMBER -->
                <div class="flex items-center justify-between mt-5">

                    <label class="inline-flex items-center">

                        <input
                            id="remember_me"
                            type="checkbox"
                            name="remember"
                            class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">

                        <span class="ml-2 text-sm text-gray-600">
                            Se souvenir de moi
                        </span>

                    </label>

                </div>

                <!-- LOGIN BUTTON -->
                <div class="mt-8">

                    <button
                        type="submit"
                        class="w-full bg-gradient-to-r from-indigo-600 to-purple-600 text-white py-3 rounded-xl font-bold shadow-lg hover:shadow-2xl hover:scale-[1.02] transition">

                        Se connecter

                    </button>

                </div>

                <!-- FORGOT PASSWORD -->
                @if (Route::has('password.request'))

                    <div class="text-center mt-5">

                        <a href="{{ route('password.request') }}"
                           class="text-sm text-indigo-600 hover:text-indigo-800 font-medium">

                            Mot de passe oublié ?

                        </a>

                    </div>

                @endif

                <!-- REGISTER LINK -->
                <div class="text-center mt-6 border-t pt-6">

                    <p class="text-gray-600 text-sm">

                        Vous n'avez pas encore de compte ?

                    </p>

                    <a href="{{ route('register') }}"
                       class="inline-block mt-3 text-indigo-600 font-bold hover:text-indigo-800">

                        Créer un compte

                    </a>

                </div>

            </form>

        </div>

        <div class="text-center mt-6 text-sm text-gray-400">
            Recruitment AI Assistant © {{ date('Y') }}
        </div>

    </div>

</x-guest-layout>
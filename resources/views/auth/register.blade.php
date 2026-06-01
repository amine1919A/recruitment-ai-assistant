<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-indigo-50 via-white to-purple-50 px-4">

        <div class="w-full max-w-md bg-white/80 backdrop-blur border border-gray-200 shadow-xl rounded-2xl p-8">

            <!-- HEADER -->
            <div class="text-center mb-8">
                <div class="w-14 h-14 mx-auto rounded-xl bg-gradient-to-r from-indigo-500 to-purple-600 flex items-center justify-center text-white font-bold text-xl shadow-lg">
                    AI
                </div>

                <h2 class="text-2xl font-bold text-gray-900 mt-4">
                    Create Account
                </h2>

                <p class="text-gray-500 text-sm mt-1">
                    Join Recruitment AI Platform
                </p>
            </div>

            <form method="POST" action="{{ route('register') }}" class="space-y-5">
                @csrf

                <!-- NAME -->
                <div>
                    <label class="text-sm font-medium text-gray-700">Name</label>
                    <input id="name" type="text" name="name"
                           value="{{ old('name') }}"
                           required autofocus
                           class="w-full mt-1 px-4 py-3 rounded-xl border border-gray-200 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100 outline-none transition">
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <!-- EMAIL -->
                <div>
                    <label class="text-sm font-medium text-gray-700">Email</label>
                    <input id="email" type="email" name="email"
                           value="{{ old('email') }}"
                           required
                           class="w-full mt-1 px-4 py-3 rounded-xl border border-gray-200 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100 outline-none transition">
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- PASSWORD -->
                <div>
                    <label class="text-sm font-medium text-gray-700">Password</label>
                    <input id="password" type="password" name="password"
                           required
                           class="w-full mt-1 px-4 py-3 rounded-xl border border-gray-200 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100 outline-none transition">
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- CONFIRM -->
                <div>
                    <label class="text-sm font-medium text-gray-700">Confirm Password</label>
                    <input id="password_confirmation" type="password" name="password_confirmation"
                           required
                           class="w-full mt-1 px-4 py-3 rounded-xl border border-gray-200 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100 outline-none transition">
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>

                <!-- BUTTON -->
                <button type="submit"
                        class="w-full bg-gradient-to-r from-indigo-600 to-purple-600 text-white py-3 rounded-xl font-semibold shadow-lg hover:shadow-xl hover:scale-[1.02] transition">
                    Create account
                </button>

                <!-- LOGIN LINK -->
                <div class="text-center text-sm text-gray-600">
                    Already have an account?
                    <a href="{{ route('login') }}" class="text-indigo-600 font-semibold hover:underline">
                        Login
                    </a>
                </div>

            </form>
        </div>
    </div>
</x-guest-layout>
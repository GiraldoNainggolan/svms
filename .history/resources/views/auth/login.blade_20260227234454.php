<x-guest-layout>

<div class="min-h-screen flex">

    <!-- LEFT SIDE (VISUAL) -->
    <div class="hidden lg:flex w-1/2 bg-gradient-to-br from-slate-900 via-slate-800 to-slate-900 text-white items-center justify-center p-12">

        <div class="max-w-md space-y-6">

            <h1 class="text-4xl font-extrabold leading-tight">
                School Visitor Management
            </h1>

            <p class="text-slate-300 text-lg">
                Sistem digital untuk memantau dan mengelola tamu sekolah secara modern, aman, dan efisien.
            </p>

            <!-- decorative card -->
            <div class="bg-white/10 backdrop-blur-lg border border-white/20 rounded-2xl p-6 shadow-xl">
                <p class="text-slate-200">
                    🔐 Secure Login Area<br>
                    Hanya staff dan admin yang dapat mengakses dashboard.
                </p>
            </div>

        </div>

    </div>

    <!-- RIGHT SIDE (FORM) -->
    <div class="w-full lg:w-1/2 bg-slate-100 flex items-center justify-center p-6">

        <div class="w-full max-w-md bg-white shadow-xl rounded-2xl p-8">

            <!-- TITLE -->
            <div class="mb-6 text-center">
                <h2 class="text-2xl font-bold text-slate-800">
                    Login Dashboard
                </h2>
                <p class="text-slate-500 text-sm mt-1">
                    Masuk untuk mengelola data pengunjung
                </p>
            </div>

            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}" class="space-y-5">
                @csrf

                <!-- Email -->
                <div>
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input id="email"
                        class="block mt-1 w-full rounded-xl border-slate-300 focus:ring-blue-500 focus:border-blue-500"
                        type="email"
                        name="email"
                        :value="old('email')"
                        required
                        autofocus />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div>
                    <x-input-label for="password" :value="__('Password')" />
                    <x-text-input id="password"
                        class="block mt-1 w-full rounded-xl border-slate-300 focus:ring-blue-500 focus:border-blue-500"
                        type="password"
                        name="password"
                        required />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Remember -->
                <div class="flex items-center justify-between text-sm">
                    <label class="inline-flex items-center">
                        <input type="checkbox"
                            name="remember"
                            class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                        <span class="ml-2 text-slate-600">Remember me</span>
                    </label>

                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}"
                           class="text-blue-600 hover:text-blue-700">
                            Forgot password?
                        </a>
                    @endif
                </div>

                <!-- BUTTON -->
                <button type="submit"
                    class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 rounded-xl transition shadow-md">
                    Log In
                </button>

            </form>

        </div>

    </div>

</div>

</x-guest-layout>
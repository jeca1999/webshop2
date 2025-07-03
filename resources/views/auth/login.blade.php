<x-guest-layout>
    <link rel="stylesheet" href="{{ asset('css/auth-center.css') }}">
    <h1 class="text-3xl font-bold text-white center-auth-title">Login</h1>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />
    

    @php
        $errorMsg = $errors->first('email');
        $seconds = null;
        $isLockout = false;
        if ((session('lockout') || ($errorMsg && (Str::contains($errorMsg, 'Too many login attempts') || Str::contains($errorMsg, '429'))))) {
            preg_match('/in (\\d+) seconds?/', $errorMsg, $matches);
            $seconds = isset($matches[1]) ? (int)$matches[1] : 60;
            $isLockout = true;
            $errorMsg = null; // Hide the credentials error if lockout is active
        }
    @endphp
    @if ($isLockout)
        <div class="mb-4 p-3 rounded bg-yellow-100 border border-yellow-400 text-yellow-800 dark:bg-yellow-900 dark:border-yellow-700 dark:text-yellow-200 text-center font-semibold">
            <svg class="inline w-5 h-5 mr-1 -mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M12 20a8 8 0 100-16 8 8 0 000 16z" /></svg>
            Your account is temporarily locked due to too many failed login attempts.<br>
            <span id="lockout-message">You cannot log in to any account from this device for <span id="lockout-timer">{{ $seconds ?? 60 }}</span> seconds.</span>
        </div>
        <script>
            (function() {
                var seconds = {{ $seconds ?? 60 }};
                var timerSpan = document.getElementById('lockout-timer');
                var message = document.getElementById('lockout-message');
                if (timerSpan && seconds > 0) {
                    var interval = setInterval(function() {
                        seconds--;
                        timerSpan.textContent = seconds;
                        if (seconds <= 0) {
                            clearInterval(interval);
                            message.textContent = 'You can now try logging in again.';
                            window.location.reload();
                        }
                    }, 1000);
                }
            })();
        </script>
    @elseif ($errorMsg)
        <div class="mb-4 p-3 rounded bg-red-100 border border-red-400 text-red-800 dark:bg-red-900 dark:border-red-700 dark:text-red-200 text-center font-semibold">
            {{ $errorMsg }}
        </div>
    @endif

    @if (session('debug_console'))
        <script>
            const debug = @json(session('debug_console'));
            console.log('Credentials:', debug.credentials, 'isSeller:', debug.isSeller);
        </script>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label  for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
           
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />
           
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800" name="remember">
                <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4 gap-2">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800 mr-auto" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif
            @if (Route::has('register'))
                <a class="underline text-sm text-black dark:text-white hover:text-gray-900 dark:hover:text-gray-100 rounded-md ml-2 center-auth-title" href="{{ route('register') }}">
                    {{ __('Register') }}
                </a>
            @endif
            <x-primary-button class="ms-2">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>

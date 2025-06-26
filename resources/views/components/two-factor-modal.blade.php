<div x-data="{ open: true }" x-show="open" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
    <div class="bg-white dark:bg-gray-900 rounded-lg shadow-lg w-full max-w-md p-6 relative">
        <h2 class="text-2xl font-bold text-center text-gray-900 dark:text-white mb-2">Two-Factor Authentication</h2>
        <p class="text-center text-sm text-gray-600 dark:text-gray-300 mb-4">
            Please enter the 6-digit code from your authenticator app.
        </p>
        @if($errors->any())
            <div class="mb-4 p-2 bg-red-100 dark:bg-red-900 text-red-700 dark:text-red-200 rounded">
                {{ $errors->first() }}
            </div>
        @endif
        <form id="two-factor-form" method="POST" action="{{ url('/two-factor-challenge') }}">
            @csrf
            <div class="mb-4">
                <label for="code" class="sr-only">Authentication Code</label>
                <input id="code" name="code" type="text" inputmode="numeric" pattern="[0-9]*" required autofocus placeholder="123456"
                    class="appearance-none rounded relative block w-full px-3 py-2 border border-gray-300 dark:border-gray-700 placeholder-gray-500 dark:placeholder-gray-400 text-gray-900 dark:text-white bg-white dark:bg-gray-800 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
            </div>
            <button type="submit"
                class="w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                Verify Code
            </button>
        </form>
        <div class="mt-4 text-center text-xs text-gray-500 dark:text-gray-400">
            If you have recovery codes, you can enter one instead.
        </div>
        <div class="mt-2 text-xs text-gray-400 dark:text-gray-500">
            {{-- Debug: Show session keys --}}
            @php
                $sessionKeys = session()->all();
            @endphp
            <strong>Session:</strong>
            <pre>{{ print_r($sessionKeys, true) }}</pre>
        </div>
    </div>
</div>
<!-- Alpine.js required for x-data/x-show. Include in your layout if not already present. -->

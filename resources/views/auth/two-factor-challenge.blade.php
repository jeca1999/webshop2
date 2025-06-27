{{-- 2FA Challenge View Disabled --}}
{{--
@extends('layouts.app')

@section('content')
<div class="min-h-screen flex flex-col items-center justify-center bg-gray-50 dark:bg-gray-900 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full space-y-8">
        <div>
            <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900 dark:text-white">
                Two-Factor Authentication
            </h2>
            <p class="mt-2 text-center text-sm text-gray-600 dark:text-gray-300">
                Please enter the 6-digit code from your authenticator app.
            </p>
        </div>
        <form class="mt-8 space-y-6" method="POST" action="{{ url('/two-factor-challenge') }}">
            @csrf
            <div class="rounded-md shadow-sm -space-y-px">
                <div>
                    <label for="code" class="sr-only">Authentication Code</label>
                    <input id="code" name="code" type="text" inputmode="numeric" pattern="[0-9]*" required autofocus placeholder="123456"
                        class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 dark:border-gray-700 placeholder-gray-500 dark:placeholder-gray-400 text-gray-900 dark:text-white bg-white dark:bg-gray-800 rounded-t-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 focus:z-10 sm:text-sm">
                </div>
            </div>
            <div>
                <button type="submit"
                    class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    Verify Code
                </button>
            </div>
        </form>
        <div class="mt-4 text-center text-xs text-gray-500 dark:text-gray-400">
            If you have recovery codes, you can enter one instead.
        </div>
    </div>
</div>
@endsection
--}}

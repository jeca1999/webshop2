@extends('layouts.app')

@section('content')
<div class="container mx-auto max-w-md py-8">
    <h2 class="text-2xl font-bold mb-4">Verify Your Email</h2>
    <p class="mb-4">A verification code has been sent to your email. Please enter it below to verify your account.</p>
    @if ($errors->any())
        <div class="mb-4 text-red-600">
            {{ $errors->first('code') }}
        </div>
    @endif
    <form method="POST" action="{{ route('verification.code.verify') }}">
        @csrf
        <div class="mb-4">
            <label for="code" class="block mb-1">Verification Code</label>
            <input id="code" name="code" type="text" maxlength="6" class="w-full border rounded px-3 py-2" required autofocus>
        </div>
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Verify</button>
    </form>
</div>
@endsection

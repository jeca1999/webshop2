@if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::twoFactorAuthentication()))
    <div class="mt-8">
        <h3 class="text-lg font-bold mb-2 dark:text-white">Two-Factor Authentication</h3>
        @if (auth()->user()->two_factor_secret)
            <form method="POST" action="{{ url('user/two-factor-authentication', [], true) }}" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded">Disable 2FA</button>
            </form>
            <form method="POST" action="{{ url('user/two-factor-authentication', [], true) }}" style="display:inline; margin-left: 10px;">
                @csrf
                <button type="submit" class="bg-yellow-500 text-white px-4 py-2 rounded">Regenerate QR Code</button>
            </form>
            <p class="mt-2 text-green-600">2FA is enabled.</p>
            <p class="mt-2 dark:text-white">Scan this QR code with your authenticator app:</p>
            <div class="my-4">{!! auth()->user()->twoFactorQrCodeSvg() !!}</div>
        @else
            <form method="POST" action="{{ url('user/two-factor-authentication', [], true) }}">
                @csrf
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Enable Two-Factor Authentication</button>
            </form>
        @endif
    </div>
@endif

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
            <div class="my-2 text-xs break-all bg-gray-100 dark:bg-gray-800 p-2 rounded">
                <strong>key:</strong>
                {{ strtoupper(decrypt(auth()->user()->two_factor_secret)) }}
            </div>
            @if (auth()->user()->two_factor_recovery_codes)
                <div class="my-2 text-xs break-all bg-yellow-50 dark:bg-yellow-900 p-2 rounded">
                    <strong>Recovery Codes:</strong>
                    <button type="button" onclick="toggleRecoveryCodes()" class="ml-2 px-2 py-1 text-xs bg-gray-300 dark:bg-gray-700 rounded focus:outline-none">Show/Hide</button>
                    <ul id="recovery-codes-list" class="list-disc ml-4 mt-1" style="display:none;">
                        @foreach (json_decode(decrypt(auth()->user()->two_factor_recovery_codes), true) as $code)
                            <li class="font-mono">{{ $code }}</li>
                        @endforeach
                    </ul>
                    <ul id="recovery-codes-password" class="list-disc ml-4 mt-1">
                        @foreach (json_decode(decrypt(auth()->user()->two_factor_recovery_codes), true) as $code)
                            <li class="font-mono"><input type="password" value="{{ $code }}" readonly class="bg-transparent border-none p-0 m-0 w-auto"></li>
                        @endforeach
                    </ul>
                    <span class="block mt-2 text-gray-600 dark:text-gray-300">Save these codes in a safe place. Each code can be used once if you lose access to your authenticator app.</span>
                </div>
                <script>
                    function toggleRecoveryCodes() {
                        var list = document.getElementById('recovery-codes-list');
                        var pwds = document.getElementById('recovery-codes-password');
                        if (list.style.display === 'none') {
                            list.style.display = 'block';
                            pwds.style.display = 'none';
                        } else {
                            list.style.display = 'none';
                            pwds.style.display = 'block';
                        }
                    }
                </script>
            @endif
        @else
            <form method="POST" action="{{ url('user/two-factor-authentication', [], true) }}" style="display:inline;">
                @csrf
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Enable 2FA</button>
            </form>
        @endif
    </div>
@endif

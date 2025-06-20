<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight text-center">
            {{ __('Terms of Service') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-6 dark:text-white">
                <h3 class="text-lg font-bold mb-4">Terms of Service</h3>
                <ul class="list-disc ml-6 mt-4">
                    <li><strong>Account:</strong> You are responsible for maintaining the confidentiality of your account and password.</li>
                    <li><strong>Orders:</strong> All orders are subject to acceptance and availability. We reserve the right to refuse or cancel any order.</li>
                    <li><strong>Payments:</strong> Payment must be made in full before orders are processed and shipped.</li>
                    <li><strong>Prohibited Use:</strong> You may not use our site for unlawful purposes or to violate any laws.</li>
                    <li><strong>Intellectual Property:</strong> All content on this site is owned by us or our licensors and may not be used without permission.</li>
                    <li><strong>Changes:</strong> We may update these terms at any time. Continued use of the site means you accept the new terms.</li>
                </ul>
                <p class="mt-4">By using our webshop, you agree to these Terms of Service. Please review them regularly for updates.</p>
            </div>
        </div>
    </div>
</x-app-layout>

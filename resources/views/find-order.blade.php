<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight text-center">
            {{ __('Find My Order') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-6">
                <h3 class="text-lg font-bold mb-4 dark:text-white">Order Lookup</h3>
                <p class="dark:text-white">  If you have an account, please <a href="{{ route('orders') }}" class="text-blue-600 dark:text-white hover: underline">view your orders here</a>. If you checked out as a guest, please contact support for assistance.</p>
            </div>
        </div>
    </div>
</x-app-layout>

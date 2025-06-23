<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-black dark:text-white leading-tight text-center">
            Find My Order
        </h2>
    </x-slot>
    <div class="py-8 md:py-12">
        <div class="max-w-2xl mx-auto px-4">
            <div class="bg-white dark:bg-black overflow-hidden shadow-sm rounded-lg p-6">
                <h3 class="text-lg font-bold mb-4">Find My Order</h3>
                <p class="mb-4 text-black dark:text-white">Enter your order number or email address below to find your order status and details.</p>
                <form class="mb-4">
                    <label class="block mb-2 text-black dark:text-white" for="order-number">Order Number or Email</label>
                    <input id="order-number" name="order-number" type="text" class="w-full p-2 border rounded mb-4" placeholder="Order # or Email" />
                    <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">Find Order</button>
                </form>
                <p class="text-sm text-gray-500 dark:text-gray-400">For further assistance, please contact support via your dashboard.</p>
            </div>
        </div>
    </div>
</x-app-layout>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight text-center">
            {{ __('Returns and Refunds') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-6 dark:text-white">
                <h3 class="text-lg font-bold mb-4">Returns and Refunds Policy</h3>
                <ul class="list-disc ml-6 mt-4">
                    <li><strong>Eligibility:</strong> Returns are accepted within 14 days of delivery. Items must be unused and in original condition.</li>
                    <li><strong>Process:</strong> To request a return or refund, contact our support team with your order details.</li>
                    <li><strong>Refunds:</strong> Approved refunds will be processed to your original payment method within 7 business days.</li>
                    <li><strong>Non-Returnable Items:</strong> Custom or personalized items are not eligible for return unless defective.</li>
                    <li><strong>Shipping:</strong> Return shipping costs are the responsibility of the customer unless the item is defective or incorrect.</li>
                </ul>
                <p class="mt-4">If you have questions about returns or refunds, please contact our support team for assistance.</p>
            </div>
        </div>
    </div>
</x-app-layout>

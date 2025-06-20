<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight text-center">
            {{ __('Cart') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @if(!empty($cart) && count($products))
                        <form id="cart-form">
                        <table class="w-full text-left">
                            <thead>
                                <tr>
                                    <th class="py-2"><input type="checkbox" id="select-all"></th>
                                    <th class="py-2">Image</th>
                                    <th class="py-2">Product</th>
                                    <th class="py-2">Quantity</th>
                                    <th class="py-2">Price</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($products as $product)
                                    <tr>
                                        <td class="py-2">
                                            <input type="checkbox" class="product-checkbox" name="selected[]" value="{{ $product->id }}" data-price="{{ $product->price }}" data-qty="{{ $cart[$product->id] }}">
                                        </td>
                                        <td class="py-2">
                                            @if($product->image)
                                                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-16 h-16 object-contain rounded">
                                            @endif
                                        </td>
                                        <td class="py-2">{{ $product->name }}</td>
                                        <td class="py-2">{{ $cart[$product->id] }}</td>
                                        <td class="py-2">{{ $product->price }} €</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        </form>
                        <div class="mt-6 p-4 bg-gray-100 dark:bg-gray-700 rounded flex flex-col gap-2">
                            <span><span id="selected-count">0</span> product(s) selected.</span>
                            <span>Total: <span id="selected-total">0.00</span> €</span>
                            <div class="flex gap-2 mt-2">
                                <button type="button" id="remove-selected" class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">Remove Selected</button>
                                <button type="button" id="checkout-selected" class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">Checkout Selected</button>
                            </div>
                        </div>
                        <form id="remove-form" method="POST" action="/cart/remove" style="display:none;">
                            @csrf
                            <input type="hidden" name="selected_ids" id="remove-ids">
                        </form>
                        <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            const checkboxes = document.querySelectorAll('.product-checkbox');
                            const selectAll = document.getElementById('select-all');
                            const totalSpan = document.getElementById('selected-total');
                            const countSpan = document.getElementById('selected-count');
                            function updateTotal() {
                                let total = 0;
                                let count = 0;
                                checkboxes.forEach(cb => {
                                    if (cb.checked) {
                                        total += parseFloat(cb.dataset.price) * parseInt(cb.dataset.qty);
                                        count++;
                                    }
                                });
                                totalSpan.textContent = total.toFixed(2);
                                countSpan.textContent = count;
                            }
                            checkboxes.forEach(cb => cb.addEventListener('change', updateTotal));
                            selectAll.addEventListener('change', function() {
                                checkboxes.forEach(cb => cb.checked = selectAll.checked);
                                updateTotal();
                            });
                            document.getElementById('remove-selected').onclick = function() {
                                const selected = Array.from(document.querySelectorAll('.product-checkbox:checked')).map(cb => cb.value);
                                if (selected.length === 0) return alert('Select at least one product.');
                                document.getElementById('remove-ids').value = selected.join(',');
                                document.getElementById('remove-form').submit();
                            };
                            document.getElementById('checkout-selected').onclick = function() {
                                const selected = Array.from(document.querySelectorAll('.product-checkbox:checked')).map(cb => cb.value);
                                if (selected.length === 0) return alert('Select at least one product.');
                                // Redirect to checkout page with selected_ids as GET param
                                window.location.href = '/profile/check-out?selected_ids=' + selected.join(',');
                            };
                        });
                        </script>
                    @else
                        {{ __("Your cart is currently empty.") }}
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

@php
$cart = $cart ?? session('cart', []);
@endphp

<body class="bg-gray-100 text-gray-800">

  <div class="max-w-3xl mx-auto p-6 bg-white rounded-lg shadow mt-10">
    <h2 class="text-2xl font-bold mb-4">Checkout Form</h2>

    <div class="flex gap-4 mb-4">
      <button class="bg-gray-900 text-white px-4 py-2 rounded hover:bg-gray-800">Google Pay</button>
      <button class="bg-gray-900 text-white px-4 py-2 rounded hover:bg-gray-800">Apple Pay</button>
    </div>

    <div class="text-center text-gray-500 my-4">or</div>

    <form class="space-y-4">
      <div>
        <label class="block text-sm font-medium">Country/Region</label>
        <input type="text" placeholder="Country/Region" class="w-full border border-gray-300 rounded px-3 py-2" />
      </div>

      <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
          <label class="block text-sm font-medium">First Name</label>
          <input type="text" placeholder="First Name" class="w-full border border-gray-300 rounded px-3 py-2" />
        </div>
        <div>
          <label class="block text-sm font-medium">Last Name</label>
          <input type="text" placeholder="Last Name" class="w-full border border-gray-300 rounded px-3 py-2" />
        </div>
      </div>

      <div>
        <label class="block text-sm font-medium">Address</label>
        <input type="text" placeholder="Address" class="w-full border border-gray-300 rounded px-3 py-2" />
      </div>
      <div>
        <input type="text" placeholder="Apartment, suite, etc. (option)" class="w-full border border-gray-300 rounded px-3 py-2" />
      </div>

      <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <div>
          <label class="block text-sm font-medium">Postal Code</label>
          <input type="text" placeholder="Postal code" class="w-full border border-gray-300 rounded px-3 py-2" />
        </div>
        <div>
          <label class="block text-sm font-medium">City</label>
          <input type="text" placeholder="City" class="w-full border border-gray-300 rounded px-3 py-2" />
        </div>
        <div>
          <label class="block text-sm font-medium">Region</label>
          <input type="text" placeholder="Region" class="w-full border border-gray-300 rounded px-3 py-2" />
        </div>
      </div>

      <div>
        <label class="block text-sm font-medium">Shipping method</label>
        <input type="text" placeholder="Enter your shipping address" class="w-full border border-gray-300 rounded px-3 py-2" />
      </div>

      <h3 class="text-lg font-semibold mt-6">Payment</h3>

      <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <input type="text" placeholder="Card Number" class="w-full border border-gray-300 rounded px-3 py-2" />
        <input type="text" placeholder="Expiration Date" class="w-full border border-gray-300 rounded px-3 py-2" />
        <input type="text" placeholder="Security Code" class="w-full border border-gray-300 rounded px-3 py-2" />
      </div>

      <input type="text" placeholder="Name on Card" class="w-full border border-gray-300 rounded px-3 py-2 mt-4" />

      <div class="flex items-center gap-2 mt-2">
        <input type="checkbox" id="sameAsShipping" class="border-gray-300 rounded" />
        <label for="sameAsShipping" class="text-sm">Use shipping address as billing address</label>
      </div>

      <div class="flex items-center gap-2">
        <input type="checkbox" id="rememberMe" class="border-gray-300 rounded" />
        <label for="rememberMe" class="text-sm">Save my information for a faster checkout</label>
      </div>

      <button type="submit" class="bg-blue-600 text-white px-6 py-3 rounded-md mt-4 hover:bg-blue-500">Pay Now</button>
    </form>
  </div>

  <div class="max-w-3xl mx-auto mt-8 p-6 bg-white rounded-lg shadow">
    <h3 class="text-xl font-semibold mb-4">Product List</h3>
    <p>Subtotal: <strong>0.00 €</strong></p>
    <p>Shipping: <strong>0.00 €</strong></p>
    <p>Total: <strong>0.00 €</strong></p>
  </div>

  <footer class="text-center text-sm text-gray-500 mt-10">
    © 2025 3ELLLE. All rights reserved. |
    <a href="#" class="text-blue-500 hover:underline">Privacy Policy</a> |
    <a href="#" class="text-blue-500 hover:underline">Terms of Service</a>
  </footer>
</div>

@extends('layouts.app')

@section('content')
    <h1 class="text-2xl font-bold text-blue-600">Tailwind is working!</h1>
    <!-- Header -->
    <header class="w-full px-4 py-4 flex flex-col md:flex-row items-center justify-between gap-4 border-b border-gray-200 dark:border-gray-800 bg-white dark:bg-black">
        <h1 class="text-3xl font-bold text-center md:text-left text-black dark:text-white">3ELLLE</h1>
        <div class="flex gap-2">
            @if (Route::has('login'))
                @auth
                    <a href="{{ url('/dashboard') }}" class="inline-block px-5 py-1.5 border border-black dark:border-white text-black dark:text-white rounded-sm text-sm leading-normal hover:bg-red-500 hover:text-white transition">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="inline-block px-5 py-1.5 border border-black dark:border-white text-black dark:text-white rounded-sm text-sm leading-normal hover:text-red-500 hover:border-red-500 hover:shadow-[0_0_8px_2px_rgba(239,68,68,0.7)] transition">Log in</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="inline-block px-5 py-1.5 border border-black dark:border-white text-black dark:text-white rounded-sm text-sm leading-normal hover:text-red-500 hover:border-red-500 hover:shadow-[0_0_8px_2px_rgba(239,68,68,0.7)] transition">Register</a>
                    @endif
                @endauth
            @endif
        </div>
    </header>
    <!-- Navigation -->
    <nav class="flex flex-wrap items-center justify-center gap-6 py-3 bg-white dark:bg-black border-y border-red-500">
        <a href="{{route('welcome')}}" class="hover:text-red-500 transition">Home</a>
        <a href="{{route('shop')}}" class="hover:text-red-500 transition">Shop</a>
        <a href="{{route('prototype')}}" class="hover:text-red-500 transition">Prototypes</a>
        <a href="{{route('comission')}}" class="hover:text-red-500 transition">Commissions</a>
    </nav>
    <!-- Intro -->
    <section class="flex flex-col items-center justify-center text-center py-10 px-4 bg-white dark:bg-black">
        <h1 class="text-4xl font-bold mb-4 text-black dark:text-white">Prototypes</h1>
        <p class="text-lg md:text-xl max-w-2xl text-black dark:text-white">Discover our exclusive line of prototype products featuring original artwork. Each piece is a first-edition print, unique, and made to showcase our designs in new forms. Own a piece of our creative journey!</p>
    </section>
    <!-- Mats Intro -->
    <div class="flex flex-col items-center justify-center mt-10 h-screen">
         <h2 class="text-center text-5xl dark:text-white mb-5">Mats</h2>
         <p class="text-3xl dark:text-white">Get our art works printed on high quality mats!</p>
    </div>

    <!-- Deduplication array for all sections -->
    @php
    // Flatten the grouped products array for display
    $flatProducts = collect($products)->flatten(2);
    $shownIds = [];
    @endphp

    <!-- MATS -->
    <section class="relative h-screen overflow-hidden dark:text-white">
      <h2 class="text-2xl font-bold text-center mb-6 mt-10">Mats</h2>
      <div class="flex flex-wrap justify-center gap-8">
        @foreach($flatProducts as $product)
          @php if (in_array($product->id, $shownIds)) continue; @endphp
          @if(isset($product->subcategory) && strtolower(trim($product->subcategory)) === 'mats' && isset($product->category) && strtolower(trim($product->category)) === 'prototype' && (!isset($product->is_approved) || $product->is_approved))
            <div class="w-64 cursor-pointer product-card" data-product='@json($product)'>
              @if($product->image)
                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-64 object-cover" />
              @else
                <div class="w-full h-64 flex items-center justify-center bg-gray-200 dark:bg-gray-600">
                  <span class="text-4xl">🖼️</span>
                </div>
              @endif
            </div>
            @php $shownIds[] = $product->id; @endphp
          @endif
        @endforeach
      </div>
    </section>

    <!-- Pins Intro -->
    <div class="flex flex-col items-center justify-center mt-10 h-screen">
         <h2 class="text-center text-5xl dark:text-white mb-5">Pins</h2>
         <p class="text-3xl dark:text-white">Have your own pin collections of your favorite characters!</p>
    </div>

    <!-- PINS  -->
    <section class="relative h-screen overflow-hidden dark:text-white">
      <h2 class="text-2xl font-bold text-center mb-6 mt-10">Pins</h2>
      <div class="flex flex-wrap justify-center gap-8">
        @foreach($flatProducts as $product)
          @if(isset($product->subcategory) && strtolower($product->subcategory) === 'pins' && !in_array($product->id, $shownIds))
            <div class="w-64 cursor-pointer product-card" data-product='@json($product)'>
              @if($product->image)
                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-64 object-cover" />
              @else
                <div class="w-full h-64 flex items-center justify-center bg-gray-200 dark:bg-gray-600">
                  <span class="text-4xl">🖼️</span>
                </div>
              @endif
            </div>
            @php $shownIds[] = $product->id; @endphp
          @endif
        @endforeach
      </div>
    </section>

    <!-- Product Modal -->
    <div id="product-modal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black bg-opacity-70" onclick="if(event.target === this) closeProductModal()">
      <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-8 max-w-lg w-full relative flex flex-col items-center" onclick="event.stopPropagation()">
        <button onclick="closeProductModal()" class="absolute top-2 right-2 text-gray-500 hover:text-gray-800 dark:hover:text-white text-2xl">&times;</button>
        <img id="modal-image" src="" alt="Product Image" class="object-contain rounded mb-4 max-w-full max-h-[80vh] mx-auto" style="width:auto;height:auto;display:block;" />
        <h2 id="modal-name" class="text-2xl font-bold mb-2 text-center"></h2>
        <p id="modal-description" class="mb-2 text-center"></p>
        <p id="modal-size" class="mb-2 text-center text-gray-500"></p>
        <p id="modal-price" class="mb-4 text-center text-xl font-bold"></p>
        <div class="flex gap-4 justify-center">
          <button class="px-6 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 add-to-cart">Add to Cart</button>
          <button class="px-6 py-2 bg-green-600 text-white rounded hover:bg-green-700 place-order">Place Order</button>
        </div>
      </div>
    </div>

    @php $isLoggedIn = auth()->check(); @endphp
    <script>
    const isLoggedIn = @json($isLoggedIn);
    let currentProduct = null;

    document.querySelectorAll('.product-card').forEach(function(card) {
      card.addEventListener('click', function() {
        currentProduct = JSON.parse(this.getAttribute('data-product'));
        showProductModal(currentProduct);
      });
    });

    function showProductModal(product) {
      document.getElementById('product-modal').classList.remove('hidden');
      document.getElementById('product-modal').classList.add('flex');
      const modalImg = document.getElementById('modal-image');
      modalImg.src = '/storage/' + product.image;
      modalImg.alt = product.name;
      // Reset classes and styles
      modalImg.className = 'object-contain rounded mb-4 max-w-full max-h-[80vh] mx-auto';
      modalImg.style.width = 'auto';
      modalImg.style.height = 'auto';
      // Wait for image to load to get natural size
      modalImg.onload = function() {
        const w = modalImg.naturalWidth;
        const h = modalImg.naturalHeight;
        if (w && h) {
          if (w > h) {
            // Landscape
            modalImg.className = 'object-contain rounded mb-4 w-full h-auto max-w-[90vw] max-h-[80vh] mx-auto';
            modalImg.style.width = '';
            modalImg.style.height = '';
          } else if (h > w) {
            // Portrait
            modalImg.className = 'object-contain rounded mb-4 h-96 w-auto max-h-[80vh] max-w-full mx-auto';
            modalImg.style.width = '';
            modalImg.style.height = '';
          } else {
            // Square
            modalImg.className = 'object-contain rounded mb-4 w-96 h-96 max-w-full max-h-[80vh] mx-auto';
            modalImg.style.width = '';
            modalImg.style.height = '';
          }
        }
      };
      document.getElementById('modal-name').textContent = product.name;
      document.getElementById('modal-description').textContent = product.description;
      document.getElementById('modal-size').textContent = 'Size: ' + product.size;
      document.getElementById('modal-price').textContent = '₱' + Number(product.price).toLocaleString(undefined, {minimumFractionDigits: 2, maximumFractionDigits: 2});
    }
    function closeProductModal() {
      document.getElementById('product-modal').classList.add('hidden');
      document.getElementById('product-modal').classList.remove('flex');
    }

    document.addEventListener('DOMContentLoaded', function() {
      document.querySelector('#product-modal .add-to-cart').onclick = async function() {
        if (!isLoggedIn) {
          window.location.href = '/login';
          return;
        }
        if (!currentProduct) return;
        // Add to cart via AJAX
        const res = await fetch('/cart/add', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content
          },
          body: JSON.stringify({ product_id: currentProduct.id })
        });
        if (res.ok) {
          window.location.href = '/cart';
        } else {
          alert('Failed to add to cart.');
        }
      };
      document.querySelector('#product-modal .place-order').onclick = function() {
        if (!isLoggedIn) {
          window.location.href = '/login';
          return;
        }
        if (!currentProduct) return;
        // Redirect to checkout GET page with selected product ID as query param
        window.location.href = '/profile/check-out?selected_ids=' + encodeURIComponent(currentProduct.id);
      };
    });
    </script>

    <!-- Info Section -->
    <div class="flex flex-col items-center justify-center min-h-screen dark:text-white gap-y-10 mt-10">
      <!-- Top Section: 3ELLLE + Socials + Policies -->
      <div class="flex justify-center gap-x-56">
        <div class="flex flex-col gap-4">
          <h2 class="text-xl font-bold">3ELLLE</h2>
          <p>Turning Imagination into Art</p>
        </div>
        <div class="flex flex-col gap-2">
          <h2 class="mb-4 font-bold text-xl">Socials</h2>
          <a href="https://x.com/straw_zellieace?t=S2p6w7ZRz0nzI_ZuMtaVZg&s=09" target="_blank" class="hover:text-red-500">X (Twitter)</a>
          <a href="https://www.instagram.com/strawzellieace?igsh=MTQxb3RqeXZvOHd5Nw==" target="_blank" class="hover:text-red-500">Instagram</a>
          <a href="https://www.tumblr.com/strawzellieace?source=share" target="_blank" class="hover:text-red-500">Tumblr</a>
          <a href="https://www.facebook.com/share/1B2KpFju7d/" target="_blank" class="hover:text-red-500">Facebook</a>
        </div>
        <div class="flex flex-col gap-2">
          <h2 class="mb-4 font-bold text-xl">Support/Policies</h2>
          <a href="{{ url('/support/find-order') }}" class="hover:text-red-500">Find my order</a>
          <a href="{{ url('/support/returns-refunds') }}" class="hover:text-red-500">Returns and refunds</a>
          <a href="{{ url('/policies/privacy') }}" class="hover:text-red-500">Privacy Policy</a>
          <a href="{{ url('/policies/terms') }}" class="hover:text-red-500">Terms of Service</a>
        </div>
      </div>
      <!-- Newsletter -->
      <div class="flex flex-col items-center mt-11">
        <h2 class="mb-4 font-bold text-xl">Newsletter</h2>
        <p class="text-center max-w-md">Subscribe to our newsletter for the latest updates on new artworks.</p>
        <form action="" method="POST" class="flex flex-col gap-2 mt-4 w-full max-w-sm">
          <input type="email" name="email" placeholder="Enter your email" required class="border border-gray-300 rounded-md p-2">
          <button type="submit" class="bg-blue-500 text-white rounded-md p-2">Subscribe</button>
        </form>
      </div>
    </div>

      <footer>
          
            <h2 class="dark:text-white text-center"> Copyright 3ELLLE 2025</h2>
      </footer>
      
   @endsection
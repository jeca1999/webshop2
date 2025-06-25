@extends('layouts.app')

@section('content')
    <!-- Header -->
    <header class="w-full px-2 sm:px-4 py-4 flex flex-col md:flex-row items-center justify-between gap-4 border-b border-gray-200 dark:border-gray-800 bg-white dark:bg-black sticky top-0 z-20">
        <h1 class="text-3xl font-bold text-center md:text-left text-black dark:text-white">3ELLLE</h1>
        <div class="flex gap-2 flex-wrap">
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
    <nav class="flex flex-wrap items-center justify-center gap-4 sm:gap-6 py-3 bg-white dark:bg-black border-y border-red-500 sticky top-0 z-10">
        <a href="{{route('welcome')}}" class="hover:text-red-500 transition">Home</a>
        <a href="{{route('shop')}}" class="hover:text-red-500 transition">Shop</a>
        <a href="{{route('prototype')}}" class="hover:text-red-500 transition">Prototypes</a>
        <a href="{{route('comission')}}" class="hover:text-red-500 transition">Commissions</a>
    </nav>
    <!-- Hero Section -->
    <section class="flex flex-col md:flex-row items-center justify-between py-6 sm:py-10 px-2 sm:px-4 bg-white dark:bg-black">
        <div class="flex-1 flex flex-col items-center md:items-start">
            <h1 class="text-3xl md:text-5xl font-bold text-center md:text-left text-black dark:text-white mb-4">Welcome to 3ELLLE<br>official store</h1>
        </div>
        <div class="flex-1 flex justify-center md:justify-end mt-4 md:mt-0">
            <img src="/image/3ELLLE_shop.jpg" alt="Image of 3ELLLE's Character" class="w-40 h-40 sm:w-64 sm:h-64 object-cover rounded-lg shadow-lg bg-gray-100 dark:bg-gray-900" />
        </div>
    </section>
    <!-- Weekly Top Sellers -->
    <div class="py-6 sm:py-10 flex flex-col items-center justify-center dark:text-white">
        <div class="max-w-7xl w-full px-2 sm:px-4 md:px-6 lg:px-8">
            <h2 class="text-2xl font-bold text-center mb-6 text-black dark:text-white">Top Sellers This Week</h2>
            <div class="flex flex-wrap justify-center gap-4 sm:gap-8">
                @php
                    $flatProducts = collect($products)->flatten(1);
                    $uniqueProducts = $flatProducts->groupBy('name')->map(function($group) {
                        $first = $group->first();
                        $first->units_sold = $group->sum('units_sold');
                        return $first;
                    })->sortByDesc('units_sold')->take(6);
                @endphp
                @foreach($uniqueProducts as $product)
                    <div class="w-40 sm:w-64 bg-gray-100 dark:bg-gray-900 rounded-md shadow-md overflow-hidden flex flex-col mb-6">
                        <div class="p-2 sm:p-4">
                            <h3 class="text-base sm:text-lg font-semibold text-black dark:text-white text-center">{{ $product->name }}</h3>
                        </div>
                        <div class="bg-gray-300 dark:bg-gray-700 flex items-center justify-center h-32 sm:h-64">
                            @if($product->image)
                                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-full object-cover" />
                            @else
                                <span class="text-4xl">🖼️</span>
                            @endif
                        </div>
                        <div class="p-4 text-center">
                            <p class="text-gray-600 dark:text-gray-300 font-bold">
    ₱{{ number_format($product->price, 2) }}
</p>
                            <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Sold: {{ $product->units_sold ?? 0 }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- End Top Sellers -->

    <!-- Deduplication array for all sections -->
    @php $shownIds = []; @endphp
    <!-- Paintings -->
    <div class="relative h-screen py-10 dark:text-white flex flex-col justify-between overflow-hidden">
      <h2 class="text-2xl font-bold text-center mb-6 mt-10">Paintings</h2>
      <div class="flex flex-wrap justify-center gap-8">
        @foreach($products as $groupedProducts)
          @php
            $first = $groupedProducts[0] ?? null;
          @endphp
          @if($first && $first->category === 'shop' && $first->subcategory === 'paintings')
            @foreach($groupedProducts as $product)
              @if(!in_array($product->id, $shownIds))
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
          @endif
        @endforeach
      </div>
    </div>

    <!-- Sketches -->
    <div class="relative h-screen py-10 dark:text-white flex flex-col justify-between overflow-hidden">
      <h2 class="text-2xl font-bold text-center mb-6 mt-10">Sketches</h2>
      <div class="flex flex-wrap justify-center gap-8">
        @foreach($products as $groupedProducts)
          @php
            $first = $groupedProducts[0] ?? null;
          @endphp
          @if($first && $first->category === 'shop' && $first->subcategory === 'sketches')
            @foreach($groupedProducts as $product)
              @if(!in_array($product->id, $shownIds))
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
          @endif
        @endforeach
      </div>
    </div>

    <!-- Digital Arts --> 
    <div class="relative h-screen py-10 dark:text-white flex flex-col justify-between overflow-hidden">
      <h2 class="text-2xl font-bold text-center mb-6 mt-10">Digital Arts</h2>
      <div class="flex flex-wrap justify-center gap-8">
        @foreach($products as $groupedProducts)
          @php
            $first = $groupedProducts[0] ?? null;
          @endphp
          @if($first && $first->category === 'shop' && $first->subcategory === 'digital arts')
            @foreach($groupedProducts as $product)
              @if(!in_array($product->id, $shownIds))
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
          @endif
        @endforeach
      </div>
    </div>

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
      const modal = document.getElementById('product-modal');
      modal.classList.remove('hidden');
      modal.classList.add('flex');
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

      // Attach event listeners every time modal is shown
      modal.querySelector('.add-to-cart').onclick = async function() {
        if (!isLoggedIn) {
          window.location.href = '/login';
          return;
        }
        if (!currentProduct) return;
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
      modal.querySelector('.place-order').onclick = function() {
        if (!isLoggedIn) {
          window.location.href = '/login';
          return;
        }
        if (!currentProduct) return;
        window.location.href = '/profile/check-out?selected_ids=' + encodeURIComponent(currentProduct.id);
      };
    }
    function closeProductModal() {
      const modal = document.getElementById('product-modal');
      modal.classList.add('hidden');
      modal.classList.remove('flex', 'block');
      modal.style.display = 'none'; // Force hide
      setTimeout(() => { modal.style.display = ''; }, 300); // Reset after animation if any
    }

    // Optional: Close modal if clicking outside modal content
    document.addEventListener('mousedown', function(e) {
      const modal = document.getElementById('product-modal');
      if (!modal.classList.contains('hidden') && !modal.querySelector('div').contains(e.target)) {
        closeProductModal();
      }
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

    </footer>
        
    <h2 class="dark:text-white text-center"> Copyright 3ELLLE 2025</h2>
@endsection
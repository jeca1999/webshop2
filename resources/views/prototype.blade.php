<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>3ELLLE - Prototypes</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

        <!-- Styles / Scripts -->
        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @endif

        <style>
          /* Force dropdowns to use light mode and black text */
          .force-light select,
          .force-light select option {
            color: #111 !important;
            background: #fff !important;
          }
        </style>
    </head>
    <body class="bg-[#FDFDFC] dark:bg-[#0a0a0a] text-[#1b1b18]  p-6 lg:p-8 items-center lg:justify-center min-h-screen  scroll-smooth ">
        <!--header--> 
        <header class="w-100%  text-sm mb-6 not-has-[nav]:hidden lg:flex  lg:items-center justify-between lg:gap-10 position sticky top-0">
            <h1 class="text-3xl font-bold text-center lg:text-left dark:text-white">3ELLLE</h1>
       
          <div>
            @if (Route::has('login'))

                
                    @auth
                        <a
                            href="{{ url('/dashboard') }}"
                            class="inline-block px-5 py-1.5 dark:text-[#EDEDEC] border-[#19140035] hover:border-[#1915014a] border text-[#1b1b18] dark:border-[#3E3E3A] dark:hover:border-[#62605b] rounded-sm text-sm leading-normal"
                        >
                            Dashboard
                        </a>
                    @else
                        <a
                            href="{{ route('login') }}"
                            class="inline-block px-5 py-1.5 dark:text-[#EDEDEC] text-[#1b1b18] border border-transparent hover:border-[#19140035] dark:hover:border-[#3E3E3A] rounded-sm text-sm leading-normal justify-center"
                        >
                            Log in
                        </a>

                        @if (Route::has('register'))
                            <a
                                href="{{ route('register') }}"
                                class="inline-block px-5 py-1.5 dark:text-[#EDEDEC] border-[#19140035] hover:border-[#1915014a] border text-[#1b1b18] dark:border-[#3E3E3A] dark:hover:border-[#62605b] rounded-sm text-sm leading-normal">
                                Register
                            </a>
                        @endif
                    @endauth
                    
            @endif

        </header>
         <nav class="flex items-center justify-center gap-20 dark:text-white  position sticky top-0">
                   <a href="{{route('welcome')}}">Home</a>
                    <a href="{{route('shop')}}">Shop</a>
                    <a href="{{route('prototype')}}">Prototypes</a>
                    <a href="{{route('comission')}}">Comissions</a>
                </nav>

<div class="flex flex-col items-center justify-center mt-10 h-screen">
    <img src="" alt="img for Prototype" class="w-96 h-64 object-cover rounded-lg shadow-lg ">
    <h1 class="text-4xl font-bold text-center dark:text-white">Prototypes</h1> 
    <p class="dark:text-white text-center mt-10">Discover our exclusive line of prototype products featuring original artwork. Each piece is a first-edition print,unique, and made to showcase our designs in new forms. Own a  piece of our creative journey!
</p>
</div>
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
      @if(isset($product->subcategory) && strtolower($product->subcategory) === 'mats' && !in_array($product->id, $shownIds))
        <div class="w-64 cursor-pointer" onclick="showProductModal(@json($product))">
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
        <div class="w-64 cursor-pointer" onclick="showProductModal(@json($product))">
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
<div id="product-modal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black bg-opacity-70">
  <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-8 max-w-lg w-full relative flex flex-col items-center">
    <button onclick="closeProductModal()" class="absolute top-2 right-2 text-gray-500 hover:text-gray-800 dark:hover:text-white text-2xl">&times;</button>
    <img id="modal-image" src="" alt="Product Image" class="w-full h-64 object-cover rounded mb-4" />
    <h2 id="modal-name" class="text-2xl font-bold mb-2 text-center"></h2>
    <p id="modal-description" class="mb-2 text-center"></p>
    <p id="modal-size" class="mb-2 text-center text-gray-500"></p>
    <p id="modal-price" class="mb-4 text-center text-xl font-bold"></p>
    <div class="flex gap-4 justify-center">
      <button class="px-6 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Add to Cart</button>
      <button class="px-6 py-2 bg-green-600 text-white rounded hover:bg-green-700">Place Order</button>
    </div>
  </div>
</div>

<script>
function showProductModal(product) {
  document.getElementById('product-modal').classList.remove('hidden');
  document.getElementById('product-modal').classList.add('flex');
  document.getElementById('modal-image').src = '/storage/' + product.image;
  document.getElementById('modal-name').textContent = product.name;
  document.getElementById('modal-description').textContent = product.description;
  document.getElementById('modal-size').textContent = 'Size: ' + product.size;
  document.getElementById('modal-price').textContent = product.price + ' €';
}
function closeProductModal() {
  document.getElementById('product-modal').classList.add('hidden');
  document.getElementById('product-modal').classList.remove('flex');
}
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
      <a href="https://www.instagram.com/3ellle/" target="_blank">Instagram</a>
      <a href="https://www.tiktok.com/@3ellle" target="_blank">facebook</a>
      <a href="https://www.tumblr.com/3ellle" target="_blank">Tumblr</a>
      <a href="https://www.pinterest.com/3ellle" target="_blank">X</a>
    </div>
    <div class="flex flex-col gap-2">
      <h2 class="mb-4 font-bold text-xl">Support/Policies</h2>
      <a href="#">Find my order</a>
      <a href="#">Returns and refunds</a>
      <a href="#">Privacy and Policy</a>
      <a href="#">Terms of service</a>
    </div>
  </div>
  <!-- Newsletter -->
  <div class="flex flex-col items-center mt-11 force-light" style="color-scheme: light;">
    <h2 class="mb-4 font-bold text-xl">Newsletter</h2>
    <p class="text-center max-w-md">Subscribe to our newsletter for the latest updates on new artworks.</p>
    <form action="#" method="POST" class="mt-4">
      <input type="email" name="email" placeholder="Enter your email" required class="px-4 py-2 border border-gray-300 rounded-md dark:bg-gray-800 dark:text-white">
      <button type="submit" class="ml-2 px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">Subscribe</button>
  </div>
</div>

  <footer>
      
        <h2 class="dark:text-white text-center"> Copyright 3ELLLE 2025</h2>
  </footer>
    
 </body>
</html>
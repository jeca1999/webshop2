<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>3ELLLE - shop</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

        <!-- Styles / Scripts -->
        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @endif
    </head>
    <body class="bg-[#FDFDFC] dark:bg-[#0a0a0a] text-[#1b1b18]  p-6 lg:p-8 items-center lg:justify-center min-h-screen  scroll-smooth dark:text-white">
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

<!-- Shop Hero Section-->
<div class="h-screen flex items-center justify-end dark:text-white">
    <img src="" alt="Image of 3ELLLE's Character"  />
    <h1 class="text-3xl font-bold text-center lg:text-left dark:text-white">Welcome to 3ELLLE <br>official store</h1>
</div>

<!-- Weekly TPS-->
<div class=" py-10 h-screen flex items-center justify-center dark:text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-2xl font-bold dark:text-white mb-6 text-center">Top sellers this week</h2>
        <div class="flex flex-wrap -mx-3">
            <div class="w-full sm:w-1/2 lg:w-1/3 px-3 mb-6">
                <div class="bg-gray-100 rounded-md shadow-md overflow-hidden flex flex-col">
                    <div class="p-4">
                        <h3 class="text-lg font-semibold text-gray-800 text-center">Product Name 1</h3>
                    </div>
                    <div class="bg-gray-300 aspect-2/3">
                        <!-- Image -->
                    </div>
                    <div class="p-4 text-center">
                        <p class="text-gray-600">$19.99</p>
                    </div>
                </div>
            </div>
            <div class="w-full sm:w-1/2 lg:w-1/3 px-3 mb-6">
                <div class="bg-gray-100 rounded-md shadow-md overflow-hidden flex flex-col">
                     <div class="p-4">
                        <h3 class="text-lg font-semibold text-gray-800 text-center">Product Name 2</h3>
                    </div>
                    <div class="bg-gray-300 aspect-2/3">
                        <!-- Image -->
                    </div>
                    <div class="p-4 text-center">
                        <p class="text-gray-600">$29.50</p>
                    </div>
                </div>
            </div>
            <div class="w-full sm:w-1/2 lg:w-1/3 px-3 mb-6">
                <div class="bg-gray-100 rounded-md shadow-md overflow-hidden flex flex-col">
                     <div class="p-4">
                        <h3 class="text-lg font-semibold text-gray-800 text-center">Product Name 3</h3>
                    </div>
                    <div class="bg-gray-300 aspect-2/3">
                        <!-- Image -->
                    </div>
                    <div class="p-4 text-center">
                        <p class="text-gray-600">$49.00</p>
                    </div>
                </div>
            </div>
             <div class="w-full sm:w-1/2 lg:w-1/3 px-3 mb-6">
                <div class="bg-gray-100 rounded-md shadow-md overflow-hidden flex flex-col">
                     <div class="p-4">
                        <h3 class="text-lg font-semibold text-gray-800 text-center">Product Name 4</h3>
                    </div>
                    <div class="bg-gray-300 aspect-2/3">
                        <!-- Image -->
                    </div>
                    <div class="p-4 text-center">
                        <p class="text-gray-600">$12.75</p>
                    </div>
                </div>
            </div>
            <div class="w-full sm:w-1/2 lg:w-1/3 px-3 mb-6">
                <div class="bg-gray-100 rounded-md shadow-md overflow-hidden flex flex-col">
                     <div class="p-4">
                        <h3 class="text-lg font-semibold text-gray-800 text-center">Product Name 5</h3>
                    </div>
                    <div class="bg-gray-300 aspect-2/3">
                        <!--Image -->
                    </div>
                    <div class="p-4 text-center">
                        <p class="text-gray-600">$35.99</p>
                    </div>
                </div>
            </div>
            <div class="w-full sm:w-1/2 lg:w-1/3 px-3 mb-6">
                <div class="bg-gray-100 rounded-md shadow-md overflow-hidden flex flex-col">
                     <div class="p-4">
                        <h3 class="text-lg font-semibold text-gray-800 text-center">Product Name 6</h3>
                    </div>
                    <div class="bg-gray-300 aspect-2/3">
                        <!-- Image -->
                    </div>
                    <div class="p-4 text-center">
                        <p class="text-gray-600">$59.20</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--Coupons-->

<div class="h-screen flex flex-col items-center justify-center dark:text-white gap-10">
  <h2 class="text-2xl font-bold">Coupons</h2>
  <div class="flex gap-40">
    <div class="bg-gray-300 w-56 h-20 flex items-center justify-center rounded-md text-black">Coupon 1</div>
    <div class="bg-gray-300 w-56 h-20 flex items-center justify-center rounded-md text-black">Coupon 2 </div>
  </div>
</div>
<div>
  <!-- Paintings -->
<div class="relative h-screen py-10 dark:text-white flex flex-col justify-between overflow-hidden">
  <h2 class="text-2xl font-bold text-center mb-6 mt-10">Paintings</h2>
  
  <div id="product-group-paintings" class="flex h-full transition-transform duration-500">
    <!-- GROUP 1 -->
    <div class="flex flex-col h-full min-w-full px-4">
      <!-- Row 1 -->
      <div class="flex justify-center flex-1 space-x-4 mb-4">
        <div class="flex-1 bg-gray-300 rounded-md flex items-center justify-center"><span class="text-xl">Product 1</span></div>
        <div class="flex-1 bg-gray-300 rounded-md flex items-center justify-center"><span class="text-xl">Product 2</span></div>
        <div class="flex-1 bg-gray-300 rounded-md flex items-center justify-center"><span class="text-xl">Product 3</span></div>
      </div>
      <!-- Row 2 -->
      <div class="flex justify-center flex-1 space-x-4">
        <div class="flex-1 bg-gray-300 rounded-md flex items-center justify-center"><span class="text-xl">Product 4</span></div>
        <div class="flex-1 bg-gray-300 rounded-md flex items-center justify-center"><span class="text-xl">Product 5</span></div>
      </div>
    </div>

    <!-- GROUP 2 -->
    <div class="flex flex-col h-full min-w-full px-4">
      <!-- Same structure -->
      <div class="flex justify-center flex-1 space-x-4 mb-4">
        <div class="flex-1 bg-gray-300 rounded-md flex items-center justify-center"><span class="text-xl">Product 6</span></div>
        <div class="flex-1 bg-gray-300 rounded-md flex items-center justify-center"><span class="text-xl">Product 7</span></div>
        <div class="flex-1 bg-gray-300 rounded-md flex items-center justify-center"><span class="text-xl">Product 8</span></div>
      </div>
      <div class="flex justify-center flex-1 space-x-4">
        <div class="flex-1 bg-gray-300 rounded-md flex items-center justify-center"><span class="text-xl">Product 9</span></div>
        <div class="flex-1 bg-gray-300 rounded-md flex items-center justify-center"><span class="text-xl">Product 10</span></div>
      </div>
    </div>

    <!-- GROUP 3 -->
    <div class="flex flex-col h-full min-w-full px-4">
      <div class="flex justify-center flex-1 space-x-4 mb-4">
        <div class="flex-1 bg-gray-300 rounded-md flex items-center justify-center"><span class="text-xl">Product 11</span></div>
        <div class="flex-1 bg-gray-300 rounded-md flex items-center justify-center"><span class="text-xl">Product 12</span></div>
        <div class="flex-1 bg-gray-300 rounded-md flex items-center justify-center"><span class="text-xl">Product 13</span></div>
      </div>
      <div class="flex justify-center flex-1 space-x-4">
        <div class="flex-1 bg-gray-300 rounded-md flex items-center justify-center"><span class="text-xl">Product 14</span></div>
        <div class="flex-1 bg-gray-300 rounded-md flex items-center justify-center"><span class="text-xl">Product 15</span></div>
      </div>
    </div>
  </div>

  <!-- Pagination -->
  <div class="flex justify-center space-x-3 mt-8">
    <button onclick="goToGroup('product-group-paintings', 0)" class="w-3 h-3 bg-gray-400 rounded-full hover:bg-white"></button>
    <button onclick="goToGroup('product-group-paintings', 1)" class="w-3 h-3 bg-gray-400 rounded-full hover:bg-white"></button>
    <button onclick="goToGroup('product-group-paintings', 2)" class="w-3 h-3 bg-gray-400 rounded-full hover:bg-white"></button>
  </div>
</div>

<!-- Sketches -->
<div class="relative h-screen py-10 dark:text-white flex flex-col justify-between overflow-hidden">
  <h2 class="text-2xl font-bold text-center mb-6 mt-10">Sketches</h2>
  
  <div id="product-group-sketches" class="flex h-full transition-transform duration-500">
    <!-- Same structure, different IDs -->
    <!-- GROUP 1 -->
    <div class="flex flex-col h-full min-w-full px-4">
      <div class="flex justify-center flex-1 space-x-4 mb-4">
        <div class="flex-1 bg-gray-300 rounded-md flex items-center justify-center"><span class="text-xl">Product 1</span></div>
        <div class="flex-1 bg-gray-300 rounded-md flex items-center justify-center"><span class="text-xl">Product 2</span></div>
        <div class="flex-1 bg-gray-300 rounded-md flex items-center justify-center"><span class="text-xl">Product 3</span></div>
      </div>
      <div class="flex justify-center flex-1 space-x-4">
        <div class="flex-1 bg-gray-300 rounded-md flex items-center justify-center"><span class="text-xl">Product 4</span></div>
        <div class="flex-1 bg-gray-300 rounded-md flex items-center justify-center"><span class="text-xl">Product 5</span></div>
      </div>
    </div>

    <!-- GROUP 2 & 3 (copy the structure like above) -->
    <div class="flex flex-col h-full min-w-full px-4">
      <div class="flex justify-center flex-1 space-x-4 mb-4">
        <div class="flex-1 bg-gray-300 rounded-md flex items-center justify-center"><span class="text-xl">Product 6</span></div>
        <div class="flex-1 bg-gray-300 rounded-md flex items-center justify-center"><span class="text-xl">Product 7</span></div>
        <div class="flex-1 bg-gray-300 rounded-md flex items-center justify-center"><span class="text-xl">Product 8</span></div>
      </div>
      <div class="flex justify-center flex-1 space-x-4">
        <div class="flex-1 bg-gray-300 rounded-md flex items-center justify-center"><span class="text-xl">Product 9</span></div>
        <div class="flex-1 bg-gray-300 rounded-md flex items-center justify-center"><span class="text-xl">Product 10</span></div>
      </div>
    </div>

    <div class="flex flex-col h-full min-w-full px-4">
      <div class="flex justify-center flex-1 space-x-4 mb-4">
        <div class="flex-1 bg-gray-300 rounded-md flex items-center justify-center"><span class="text-xl">Product 11</span></div>
        <div class="flex-1 bg-gray-300 rounded-md flex items-center justify-center"><span class="text-xl">Product 12</span></div>
        <div class="flex-1 bg-gray-300 rounded-md flex items-center justify-center"><span class="text-xl">Product 13</span></div>
      </div>
      <div class="flex justify-center flex-1 space-x-4">
        <div class="flex-1 bg-gray-300 rounded-md flex items-center justify-center"><span class="text-xl">Product 14</span></div>
        <div class="flex-1 bg-gray-300 rounded-md flex items-center justify-center"><span class="text-xl">Product 15</span></div>
      </div>
    </div>
  </div>

  <!-- Pagination -->
  <div class="flex justify-center space-x-3 mt-8">
    <button onclick="goToGroup('product-group-sketches', 0)" class="w-3 h-3 bg-gray-400 rounded-full hover:bg-white"></button>
    <button onclick="goToGroup('product-group-sketches', 1)" class="w-3 h-3 bg-gray-400 rounded-full hover:bg-white"></button>
    <button onclick="goToGroup('product-group-sketches', 2)" class="w-3 h-3 bg-gray-400 rounded-full hover:bg-white"></button>
  </div>
</div>

<!-- Digital Arts -->
<div class="relative h-screen py-10 dark:text-white flex flex-col justify-between overflow-hidden">
  <h2 class="text-2xl font-bold text-center mb-6 mt-10">Digital Arts</h2>

  <div id="product-group-digitalarts" class="flex h-full transition-transform duration-500">
    <!-- GROUPS 1, 2, 3 here - same structure as above -->
    <div class="flex flex-col h-full min-w-full px-4">
      <div class="flex justify-center flex-1 space-x-4 mb-4">
        <div class="flex-1 bg-gray-300 rounded-md flex items-center justify-center"><span class="text-xl">Product 1</span></div>
        <div class="flex-1 bg-gray-300 rounded-md flex items-center justify-center"><span class="text-xl">Product 2</span></div>
        <div class="flex-1 bg-gray-300 rounded-md flex items-center justify-center"><span class="text-xl">Product 3</span></div>
      </div>
      <div class="flex justify-center flex-1 space-x-4">
        <div class="flex-1 bg-gray-300 rounded-md flex items-center justify-center"><span class="text-xl">Product 4</span></div>
        <div class="flex-1 bg-gray-300 rounded-md flex items-center justify-center"><span class="text-xl">Product 5</span></div>
      </div>
    </div>

    <!-- More groups -->
    <div class="flex flex-col h-full min-w-full px-4">
      <div class="flex justify-center flex-1 space-x-4 mb-4">
        <div class="flex-1 bg-gray-300 rounded-md flex items-center justify-center"><span class="text-xl">Product 6</span></div>
        <div class="flex-1 bg-gray-300 rounded-md flex items-center justify-center"><span class="text-xl">Product 7</span></div>
        <div class="flex-1 bg-gray-300 rounded-md flex items-center justify-center"><span class="text-xl">Product 8</span></div>
      </div>
      <div class="flex justify-center flex-1 space-x-4">
        <div class="flex-1 bg-gray-300 rounded-md flex items-center justify-center"><span class="text-xl">Product 9</span></div>
        <div class="flex-1 bg-gray-300 rounded-md flex items-center justify-center"><span class="text-xl">Product 10</span></div>
      </div>
    </div>

    <div class="flex flex-col h-full min-w-full px-4">
      <div class="flex justify-center flex-1 space-x-4 mb-4">
        <div class="flex-1 bg-gray-300 rounded-md flex items-center justify-center"><span class="text-xl">Product 11</span></div>
        <div class="flex-1 bg-gray-300 rounded-md flex items-center justify-center"><span class="text-xl">Product 12</span></div>
        <div class="flex-1 bg-gray-300 rounded-md flex items-center justify-center"><span class="text-xl">Product 13</span></div>
      </div>
      <div class="flex justify-center flex-1 space-x-4">
        <div class="flex-1 bg-gray-300 rounded-md flex items-center justify-center"><span class="text-xl">Product 14</span></div>
        <div class="flex-1 bg-gray-300 rounded-md flex items-center justify-center"><span class="text-xl">Product 15</span></div>
      </div>
    </div>
  </div>

  <!-- Pagination -->
  <div class="flex justify-center space-x-3 mt-8">
    <button onclick="goToGroup('product-group-digitalarts', 0)" class="w-3 h-3 bg-gray-400 rounded-full hover:bg-white"></button>
    <button onclick="goToGroup('product-group-digitalarts', 1)" class="w-3 h-3 bg-gray-400 rounded-full hover:bg-white"></button>
    <button onclick="goToGroup('product-group-digitalarts', 2)" class="w-3 h-3 bg-gray-400 rounded-full hover:bg-white"></button>
  </div>
</div>


<script>
function goToGroup(groupId, index) {
    const productGroup = document.getElementById(groupId);
    productGroup.style.transform = `translateX(-${index * 100}%)`;
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
      <a href="https://www.tiktok.com/@3ellle" target="_blank">Tiktok</a>
      <a href="https://www.tumblr.com/3ellle" target="_blank">Tumblr</a>
      <a href="https://www.pinterest.com/3ellle" target="_blank">Pinterest</a>
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
 </body>
</html>
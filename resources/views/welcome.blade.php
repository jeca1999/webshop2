<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>3ELLLE - Home</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
    <style>
      body { font-family: 'Instrument Sans', sans-serif; }
      .hidden, [x-cloak] {
        display: none !important;
        pointer-events: none !important;
        opacity: 0 !important;
      }
    </style>
</head>
<body class="bg-white dark:bg-black text-black dark:text-white min-h-screen flex flex-col">
    <!-- Header -->
    <header class="w-full px-2 sm:px-4 py-4 flex flex-col md:flex-row items-center justify-between gap-4 border-b border-gray-200 dark:border-gray-800 bg-white dark:bg-black">
        <h1 class="text-3xl font-bold text-center md:text-left text-black dark:text-white">3ELLLE</h1>
        <div class="flex gap-2 flex-wrap">
            @auth
                @if (!auth()->user()->hasRole('seller'))
                    <a href="{{ url('/dashboard') }}" class="inline-block px-5 py-1.5 border border-black dark:border-white text-black dark:text-white rounded-sm text-sm leading-normal hover:bg-red-500 hover:text-white transition">Dashboard</a>
                @endif
            @else
                <a href="{{ route('login') }}" class="inline-block px-5 py-1.5 border border-black dark:border-white text-black dark:text-white rounded-sm text-sm leading-normal hover:text-red-500 hover:border-red-500 hover:shadow-[0_0_8px_2px_rgba(239,68,68,0.7)] transition">Log in</a>
                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="inline-block px-5 py-1.5 border border-black dark:border-white text-black dark:text-white rounded-sm text-sm leading-normal hover:text-red-500 hover:border-red-500 hover:shadow-[0_0_8px_2px_rgba(239,68,68,0.7)] transition">Register</a>
                @endif
            @endauth
        </div>
    </header>
    <!-- Navigation -->
    <nav class="flex flex-wrap items-center justify-center gap-4 sm:gap-6 py-3 bg-white dark:bg-black border-y border-red-500">
        <a href="{{route('welcome')}}" class="hover:text-red-500 transition">Home</a>
        <a href="{{route('shop')}}" class="hover:text-red-500 transition">Shop</a>
        <a href="{{route('prototype')}}" class="hover:text-red-500 transition">Prototypes</a>
        <a href="{{route('comission')}}" class="hover:text-red-500 transition">Commissions</a>
    </nav>
    <!-- Home Hero Image -->
    <section class="w-full">
        <img 
            src="/image/3ELLLE_home.jpg" 
            alt="3ELLLE Home Hero" 
            class="w-full h-48 sm:h-64 md:h-96 object-cover object-center border-b-4 border-red-500"
            loading="lazy"
            width="1920" height="400"
        >
    </section>
    <!-- Welcome Section (directly below image, with more space) -->
    <section class="flex flex-col items-center justify-center text-center pt-12 sm:pt-20 pb-10 sm:pb-16 px-2 sm:px-4 bg-white dark:bg-black">
        <h1 class="font-bold text-3xl sm:text-5xl text-black dark:text-white mb-8 sm:mb-14">Welcome to 3ELLLE official shop</h1>
    </section>
    <br><br><br>

    <!-- Content Section -->
    <div class="flex flex-col items-center justify-center min-h-[50vh] dark:text-white px-2 sm:px-0 my-10 sm:my-20">
        <h2 class="font-bold text-2xl sm:text-3xl text-center mb-6">Meet 3ELLLE</h2>
        <p class="text-center max-w-2xl text-base sm:text-lg">
            3ELLLE is an independent artist from the Philippines specializing in painting, drawings, and digital art.<br> With a unique style that blends creativity and emotion, 3ELLLE brings ideas to life through vibrant colors and intricate designs.<br> Explore the world of 3ELLLE and discover art that inspires and captivates.
        </p>
    </div>
    <!-- CTA Section -->
    <div class="flex flex-col items-center justify-center min-h-[40vh] dark:text-white px-2 sm:px-0 mt-20 sm:mt-32 mb-16 sm:mb-28">
        <h1 class="text-center text-3xl sm:text-6xl font-bold mb-10 sm:mb-16">Join the adventure by buying some of our Merch!</h1>
        <a href="{{ route('shop') }}" class="dark:border-white text-lg mt-8 sm:mt-12 text-center hover:text-red-500">Shop Now</a>
    </div>
    <!-- Info Section -->
    <div class="flex flex-col items-center justify-center min-h-[30vh] dark:text-white gap-y-10 mt-16 px-2 sm:px-0 mb-16 sm:mb-28">
      <!-- Top Section: 3ELLLE + Socials + Policies -->
      <div class="flex flex-col md:flex-row justify-center gap-x-10 md:gap-x-56 w-full">
        
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
          <a href="{{ route('find-order') }}" class="hover:text-red-500">Find my order</a>
          <a href="{{ route('returns-refunds') }}" class="hover:text-red-500">Returns and refunds</a>
          <a href="{{ route('privacy-policy') }}" class="hover:text-red-500">Privacy Policy</a>
          <a href="{{ route('terms-of-service') }}" class="hover:text-red-500">Terms of Service</a>
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

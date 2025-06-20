<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>3ELLLE - Commissions</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
    <link rel="stylesheet" href="./css/slider.css">
    <link rel="preload" as="image" href="/image/jen_gala.jpg">
    <link rel="preload" as="image" href="/image/jenart_gala.png">
    <link rel="preload" as="image" href="/image/jen_front view.jpg">
    <link rel="preload" as="image" href="/image/jenart_frtview.png">
    <link rel="preload" as="image" href="/image/rards_nakatayo.jpg">
    <link rel="preload" as="image" href="/image/rardsart_tayo.png">
    <link rel="preload" as="image" href="/image/rards_nakaupo.jpg">
    <link rel="preload" as="image" href="/image/rardsart_upo.png">
    <style>
      body { font-family: 'Instrument Sans', sans-serif; }
      .hidden, [x-cloak] { display: none !important; pointer-events: none !important; }
      /* Ensure overlays/modals never block clicks when hidden */
      [x-cloak], .hidden {
        pointer-events: none !important;
        display: none !important;
        opacity: 0 !important;
      }
    </style>
</head>
<body class="bg-white dark:bg-black text-black dark:text-white min-h-screen flex flex-col">
    <!-- Header -->
    <header class="w-full px-2 sm:px-4 py-4 flex flex-col md:flex-row items-center justify-between gap-4 border-b border-gray-200 dark:border-gray-800 bg-white dark:bg-black">
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
    <nav class="flex flex-wrap items-center justify-center gap-4 sm:gap-6 py-3 bg-white dark:bg-black border-y border-red-500">
        <a href="{{route('welcome')}}" class="hover:text-red-500 transition">Home</a>
        <a href="{{route('shop')}}" class="hover:text-red-500 transition">Shop</a>
        <a href="{{route('prototype')}}" class="hover:text-red-500 transition">Prototypes</a>
        <a href="{{route('comission')}}" class="hover:text-red-500 transition">Commissions</a>
    </nav>
    <!-- Intro -->
    <section class="flex flex-col items-center justify-center text-center py-6 sm:py-10 px-2 sm:px-4 bg-white dark:bg-black">
        <p class="text-xl sm:text-2xl md:text-4xl font-semibold max-w-2xl text-black dark:text-white">Bring your imagination to life with 3ELLLE's Art!<br>
            Whether you want a custom design, a unique piece of art, or a personalized gift, I am here to help you create something special.
        </p>
    </section>
    <!-- Sliders -->
    <section class="flex flex-col gap-8 w-full max-w-5xl mx-auto px-2 md:px-0">
        <!-- Portrait Slider 1 -->
        <div class="flex items-center justify-center min-h-[60vh]">
            <div x-data="carousel(['/image/jen_gala.jpg','/image/jenart_gala.png'])" class="relative w-full max-w-xs sm:max-w-sm md:max-w-md overflow-hidden">
                <div class="relative h-64 sm:h-[400px] md:h-[600px]">
                    <template x-for="(slide, index) in slides" :key="index">
                        <div x-show="current === index" x-transition:enter="transition ease-out duration-700" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100" class="absolute inset-0 flex items-center justify-center">
                            <img :src="slide" class="w-full h-full object-cover rounded-xl shadow-md" loading="lazy" width="400" height="600" />
                        </div>
                    </template>
                </div>
                <div class="absolute bottom-5 left-1/2 transform -translate-x-1/2 flex space-x-2 z-10">
                    <template x-for="(slide, index) in slides" :key="index">
                        <button @click="goTo(index)" :class="{'bg-black': current === index, 'bg-gray-400': current !== index}" class="w-3 h-3 rounded-full transition-all duration-300"></button>
                    </template>
                </div>
                <button @click="prev" class="absolute top-1/2 left-4 transform -translate-y-1/2 bg-white/70 hover:bg-white p-2 rounded-full shadow z-10">&#8592;</button>
                <button @click="next" class="absolute top-1/2 right-4 transform -translate-y-1/2 bg-white/70 hover:bg-white p-2 rounded-full shadow z-10">&#8594;</button>
            </div>
        </div>
        <!-- Portrait Slider 2 -->
        <div class="flex items-center justify-center min-h-[60vh]">
            <div x-data="carousel(['/image/jen_front view.jpg','/image/jenart_frtview.png'])" class="relative w-full max-w-xs sm:max-w-sm md:max-w-md overflow-hidden">
                <div class="relative h-64 sm:h-[400px] md:h-[600px]">
                    <template x-for="(slide, index) in slides" :key="index">
                        <div x-show="current === index" x-transition:enter="transition ease-out duration-700" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100" class="absolute inset-0 flex items-center justify-center">
                            <img :src="slide" class="w-full h-full object-cover rounded-xl shadow-md" loading="lazy" width="400" height="600" />
                        </div>
                    </template>
                </div>
                <div class="absolute bottom-5 left-1/2 transform -translate-x-1/2 flex space-x-2 z-10">
                    <template x-for="(slide, index) in slides" :key="index">
                        <button @click="goTo(index)" :class="{'bg-black': current === index, 'bg-gray-400': current !== index}" class="w-3 h-3 rounded-full transition-all duration-300"></button>
                    </template>
                </div>
                <button @click="prev" class="absolute top-1/2 left-4 transform -translate-y-1/2 bg-white/70 hover:bg-white p-2 rounded-full shadow z-10">&#8592;</button>
                <button @click="next" class="absolute top-1/2 right-4 transform -translate-y-1/2 bg-white/70 hover:bg-white p-2 rounded-full shadow z-10">&#8594;</button>
            </div>
        </div>
        <!-- Portrait Slider 3 -->
        <div class="flex items-center justify-center min-h-[60vh]">
            <div x-data="carousel(['/image/rards_nakatayo.jpg','/image/rardsart_tayo.png'])" class="relative w-full max-w-xs sm:max-w-sm md:max-w-md overflow-hidden">
                <div class="relative h-64 sm:h-[400px] md:h-[600px]">
                    <template x-for="(slide, index) in slides" :key="index">
                        <div x-show="current === index" x-transition:enter="transition ease-out duration-700" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100" class="absolute inset-0 flex items-center justify-center">
                            <img :src="slide" class="w-full h-full object-contain rounded-xl shadow-md" loading="lazy" width="400" height="600" />
                        </div>
                    </template>
                </div>
                <div class="absolute bottom-5 left-1/2 transform -translate-x-1/2 flex space-x-2 z-10">
                    <template x-for="(slide, index) in slides" :key="index">
                        <button @click="goTo(index)" :class="{'bg-black': current === index, 'bg-gray-400': current !== index}" class="w-3 h-3 rounded-full transition-all duration-300"></button>
                    </template>
                </div>
                <button @click="prev" class="absolute top-1/2 left-4 transform -translate-y-1/2 bg-white/70 hover:bg-white p-2 rounded-full shadow z-10">&#8592;</button>
                <button @click="next" class="absolute top-1/2 right-4 transform -translate-y-1/2 bg-white/70 hover:bg-white p-2 rounded-full shadow z-10">&#8594;</button>
            </div>
        </div>
        <!-- Landscape Slider -->
        <div class="flex items-center justify-center min-h-[60vh]">
            <div x-data="carousel(['/image/rards_nakaupo.jpg','/image/rardsart_upo.png'])" class="relative w-full max-w-2xl overflow-hidden">
                <div class="relative h-64 sm:h-[400px] md:h-[600px]">
                    <template x-for="(slide, index) in slides" :key="index">
                        <div x-show="current === index" x-transition:enter="transition ease-out duration-700" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100" class="absolute inset-0 flex items-center justify-center">
                            <img :src="slide" class="w-full h-full object-contain rounded-xl shadow-md" loading="lazy" width="800" height="600" />
                        </div>
                    </template>
                </div>
                <div class="absolute bottom-5 left-1/2 transform -translate-x-1/2 flex space-x-2 z-10">
                    <template x-for="(slide, index) in slides" :key="index">
                        <button @click="goTo(index)" :class="{'bg-black': current === index, 'bg-gray-400': current !== index}" class="w-3 h-3 rounded-full transition-all duration-300"></button>
                    </template>
                </div>
                <button @click="prev" class="absolute top-1/2 left-4 transform -translate-y-1/2 bg-white/70 hover:bg-white p-2 rounded-full shadow z-10">&#8592;</button>
                <button @click="next" class="absolute top-1/2 right-4 transform -translate-y-1/2 bg-white/70 hover:bg-white p-2 rounded-full shadow z-10">&#8594;</button>
            </div>
        </div>
    </section>
    <script>
    function carousel(slides) {
      return {
        current: 0,
        slides: slides,
        next() { this.current = (this.current + 1) % this.slides.length; },
        prev() { this.current = (this.current - 1 + this.slides.length) % this.slides.length; },
        goTo(index) { this.current = index; }
      }
    }
    </script>
    <!-- CTA Comissions-->
    <div class="h-screen flex flex-col items-center justify-center text-center dark:text-white" x-data="{ highlight: false }">
        <h1 class="text-6xl font-bold">Let's turn your ideas into art</h1>
       <a href="" class="dark:text-white rounded-sm mt-10 h-7 w-35 justify-center focus:outline-none hover:text-red-500"
          @mouseenter="highlight = true" @mouseleave="highlight = false" 
          @focus="highlight = true" @blur="highlight = false" tabindex="0">
          Make a Comission!
       </a>
       <div class="flex flex-row gap-6 mt-6 justify-center">
          <a href="https://x.com/straw_zellieace?t=S2p6w7ZRz0nzI_ZuMtaVZg&s=09" target="_blank" title="X (Twitter)"
             :class="highlight ? 'ring-2 ring-blue-400' : ''" class="hover:text-red-500">
            <svg width="32" height="32" fill="currentColor" class="text-black dark:text-white hover:text-blue-500" viewBox="0 0 32 32"><path d="M19.48 13.4 28.06 4h-2.13l-7.6 8.4L12.1 4H4.5l9.02 13.2L4.5 28h2.13l8.01-8.85 6.6 8.85h7.6l-9.36-14.6Zm-2.84 3.13-.93-1.32L6.1 5.5h4.5l5.1 7.2.93 1.32 9.7 13.8h-4.5l-5.1-7.2Z"/></svg>
          </a>
          <a href="https://www.instagram.com/strawzellieace?igsh=MTQxb3RqeXZvOHd5Nw==" target="_blank" title="Instagram"
             :class="highlight ? 'ring-2 ring-pink-400' : ''" class="hover:text-red-500">
            <svg width="32" height="32" fill="currentColor" class="text-black dark:text-white hover:text-pink-500" viewBox="0 0 32 32"><path d="M16 11.6A4.4 4.4 0 1 0 16 20.4 4.4 4.4 0 1 0 16 11.6zm0 7.2A2.8 2.8 0 1 1 16 13.2a2.8 2.8 0 0 1 0 5.6zm5.6-7.44a1.04 1.04 0 1 1-2.08 0 1.04 1.04 0 0 1 2.08 0zM28 9.6a7.2 7.2 0 0 0-1.92-5.08A7.2 7.2 0 0 0 21 2.6C19.2 2.08 12.8 2.08 11 2.6A7.2 7.2 0 0 0 5.92 4.52 7.2 7.2 0 0 0 4 9.6C3.48 11.4 3.48 17.6 4 19.4a7.2 7.2 0 0 0 1.92 5.08A7.2 7.2 0 0 0 11 29.4c1.8.52 8.2.52 10 0a7.2 7.2 0 0 0 5.08-1.92A7.2 7.2 0 0 0 28 22.4c.52-1.8.52-8.2 0-10zm-2.4 12.8a4.8 4.8 0 0 1-2.72 2.72c-1.88.75-6.36.58-8.88.58s-7 .17-8.88-.58A4.8 4.8 0 0 1 6.4 22.4c-.75-1.88-.58-6.36-.58-8.88s-.17-7 .58-8.88A4.8 4.8 0 0 1 9.6 6.4c1.88-.75 6.36-.58 8.88-.58s7-.17 8.88.58a4.8 4.8 0 0 1 2.72 2.72c.75 1.88.58 6.36.58 8.88s.17 7-.58 8.88z"/></svg>
          </a>
          <a href="https://www.tumblr.com/strawzellieace?source=share" target="_blank" title="Tumblr"
             :class="highlight ? 'ring-2 ring-blue-700' : ''" class="hover:text-red-500">
            <svg width="32" height="32" fill="currentColor" class="text-black dark:text-white hover:text-blue-700" viewBox="0 0 32 32"><path d="M21.5 25.7c-1.1.5-2.1.8-3.3.8-2.7 0-4.5-1.4-4.5-4.1v-7.2h6.2V12h-6.2V6.7h-3.1c-.1 0-.2.1-.2.2-.2 2.1-1.1 5.8-4.9 7.3v2.4h2.5v7.3c0 4.1 3 6.1 7.5 6.1 1.7 0 3.1-.2 4.2-.6l-.7-2.7z"/></svg>
          </a>
          <a href="https://www.facebook.com/share/1B2KpFju7d/" target="_blank" title="Facebook"
             :class="highlight ? 'ring-2 ring-blue-600' : ''" class="hover:text-red-500">
            <svg width="32" height="32" fill="currentColor" class="text-black dark:text-white hover:text-blue-600" viewBox="0 0 32 32"><path d="M29 0H3C1.3 0 0 1.3 0 3v26c0 1.7 1.3 3 3 3h13V20h-4v-5h4v-3.7c0-4 2.4-6.3 6-6.3 1.7 0 3.3.1 3.7.2v4.3h-2.6c-2 0-2.4.9-2.4 2.3V15h5l-1 5h-4v12h7c1.7 0 3-1.3 3-3V3c0-1.7-1.3-3-3-3z"/></svg>
          </a>
       </div>
    </div>
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
          <a href="{{ route('find-order') }}" class="hover:text-red-500 text-black dark:text-white">Find my order</a>
          <a href="{{ route('returns-refunds') }}" class="hover:text-red-500 text-black dark:text-white">Returns and refunds</a>
          <a href="{{ route('privacy-policy') }}" class="hover:text-red-500 text-black dark:text-white">Privacy Policy</a>
          <a href="{{ route('terms-of-service') }}" class="hover:text-red-500 text-black dark:text-white">Terms of Service</a>
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
  
      <footer class="bg-white dark:bg-black py-8">
        <h2 class="dark:text-white text-center"> Copyright 3ELLLE 2025</h2>
     </body>
     </body>
</html>
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>3ELLLE - Comissions</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

        <!-- Styles / Scripts -->
        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @endif

          <style>
            
  </style>
  <link rel="stylesheet" href="./css/slider.css">
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

<!-- Comissions intro -->
<div class="align-items-center flex flex-col justify-center h-screen text-4xl text-center ">
    <p> Bring your imagination to life with 3ELLLE's Art! <br> 
    Wether you want a custom design, a unique piece of art, or a personalized gift, I am here to help you create something special.
    </p>
</div>

<!-- Comissions slider -->

 <div class="flex items-center justify-center min-h-screen ">

<div x-data="carousel()" class="relative w-full max-w-5xl overflow-hidden">
  <!-- Slides -->
  <div class="relative h-[600px]">
    <template x-for="(slide, index) in slides" :key="index">
      <div 
        x-show="current === index"
        x-transition:enter="transition ease-out duration-700"
        x-transition:enter-start="opacity-0 scale-95"
        x-transition:enter-end="opacity-100 scale-100"
        class="absolute inset-0 flex items-center justify-center"
      >
        <img :src="slide" class="w-full h-full object-cover rounded-xl shadow-md" />
      </div>
    </template>
  </div>

  <!-- Pagination Dots -->
  <div class="absolute bottom-5 left-1/2 transform -translate-x-1/2 flex space-x-2 z-10">
    <template x-for="(slide, index) in slides" :key="index">
      <button
        @click="goTo(index)"
        :class="{
          'bg-black': current === index,
          'bg-gray-400': current !== index
        }"
        class="w-3 h-3 rounded-full transition-all duration-300"
      ></button>
    </template>
  </div>

  <!-- Controls -->
  <button
    @click="prev"
    class="absolute top-1/2 left-4 transform -translate-y-1/2 bg-white/70 hover:bg-white p-2 rounded-full shadow z-10"
  >
    &#8592;
  </button>
  <button
    @click="next"
    class="absolute top-1/2 right-4 transform -translate-y-1/2 bg-white/70 hover:bg-white p-2 rounded-full shadow z-10"
  >
    &#8594;
  </button>
</div>

<script>
function carousel() {
  return {
    current: 0,
    slides: [
'https://picsum.photos/id/1015/1200/600',
'https://picsum.photos/id/1016/1200/600',
'https://picsum.photos/id/1018/1200/600',
'https://picsum.photos/id/1024/1200/600',
'https://picsum.photos/id/1025/1200/600',
    ],
    next() {
      this.current = (this.current + 1) % this.slides.length;
    },
    prev() {
      this.current = (this.current - 1 + this.slides.length) % this.slides.length;
    },
    goTo(index) {
      this.current = index;
    }
  }
}
</script>
</div>
<!-- CTA Comissions-->
<div class="h-screen flex flex-col items-center justify-center text-center dark:text-white">
    <h1 class="text-6xl font-bold">Let's turn your ideas into art</h1>
   <a href="" class="bg- bg-gray-100 rounded-sm mt-10 h-7   w-35 justify-center " > Make a Comission!</a>
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
 </body>
</html>
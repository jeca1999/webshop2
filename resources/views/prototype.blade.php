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

<!-- MATS -->
<section class="relative h-screen overflow-hidden dark:text-white">
  <div id="mats-slider" class="flex transition-transform duration-500 h-full">

    <div class="min-w-full flex flex-col items-center justify-center">
      <div class="w-full h-3/4 bg-gray-700 flex items-center justify-center">
        <span class="text-4xl">Mat 1</span>
      </div>
      <h2 class="text-2xl font-bold ">Mat 1 Name</h2>
      <p class="text-lg text-gray-400 mb-2">$19.99</p>
    </div>
    <div class="min-w-full flex flex-col items-center justify-center">
      <div class="w-full h-3/4 bg-gray-600 flex items-center justify-center">
        <span class="text-4xl">Mat 2</span>
      </div>
      <h2 class="text-2xl font-bold ">Mat 2 Name</h2>
      <p class="text-lg text-gray-400 mb-2">$24.99</p>
    </div>
    <div class="min-w-full flex flex-col items-center justify-center">
      <div class="w-full h-3/4 bg-gray-600 flex items-center justify-center">
        <span class="text-4xl">Mat 3</span>
      </div>
      <h2 class="text-2xl font-bold ">Mat 3 Name</h2>
      <p class="text-lg text-gray-400 mb-2">$24.99</p>
    </div>
    <div class="min-w-full flex flex-col items-center justify-center">
      <div class="w-full h-3/4 bg-gray-600 flex items-center justify-center">
        <span class="text-4xl">Mat 4</span>
      </div>
      <h2 class="text-2xl font-bold ">Mat 4 Name</h2>
      <p class="text-lg text-gray-400 mb-2">$24.99</p>
    </div>
    <div class="min-w-full flex flex-col items-center justify-center">
      <div class="w-full h-3/4 bg-gray-600 flex items-center justify-center">
        <span class="text-4xl">Mat 5</span>
      </div>
      <h2 class="text-2xl font-bold ">Mat 5 Name</h2>
      <p class="text-lg text-gray-400 mb-2">$24.99</p>
    </div>
    <div class="min-w-full flex flex-col items-center justify-center">
      <div class="w-full h-3/4 bg-gray-600 flex items-center justify-center">
        <span class="text-4xl">Mat 6</span>
      </div>
      <h2 class="text-2xl font-bold ">Mat 6 Name</h2>
      <p class="text-lg text-gray-400 mb-2">$24.99</p>
    </div>
  
  </div>

  <!-- Pagination  -->
  <div id="mats-dots" class="absolute bottom-10 w-full flex justify-center space-x-4"></div>
</section>

<!-- Shirts/Hoodies Intro -->
<div class="flex flex-col items-center justify-center mt-10 h-screen">
     <h2 class="text-center text-5xl dark:text-white mb-5">Shirts/Hoodies</h2>
     <p class="text-3xl dark:text-white">High quality and comfy shirts and hoodies customised in your design!</p>
</div>

<!-- SHIRTS/HOODIES -->
<section class="relative h-screen overflow-hidden dark:text-white">
  <div id="shirts-slider" class="flex transition-transform duration-500 h-full">
  
    <div class="min-w-full flex flex-col items-center justify-center">
      <div class="w-full h-3/4 bg-blue-700 flex items-center justify-center">
        <span class="text-4xl">Shirt 1</span>
      </div>
      <h2 class="text-2xl font-bold ">Shirt 1 Name</h2>
      <p class="text-lg text-gray-400 mb-2">$29.99</p>
    </div>
    <div class="min-w-full flex flex-col items-center justify-center">
      <div class="w-full h-3/4 bg-blue-600 flex items-center justify-center">
        <span class="text-4xl">Hoodie 1</span>
      </div>
      <h2 class="text-2xl font-bold ">Hoodie 1 Name</h2>
      <p class="text-lg text-gray-400 mb-2">$39.99</p>
    </div>
    <div class="min-w-full flex flex-col items-center justify-center">
      <div class="w-full h-3/4 bg-blue-600 flex items-center justify-center">
        <span class="text-4xl">Shirt 2</span>
      </div>
      <h2 class="text-2xl font-bold ">Shirt 2 Name</h2>
      <p class="text-lg text-gray-400 mb-2">$39.99</p>
    </div>
    <div class="min-w-full flex flex-col items-center justify-center">
      <div class="w-full h-3/4 bg-blue-600 flex items-center justify-center">
        <span class="text-4xl"> Hoodie 2 </span>
      </div>
      <h2 class="text-2xl font-bold ">Hoodie 2 Name</h2>
      <p class="text-lg text-gray-400 mb-2">$39.99</p>
    </div>
    <div class="min-w-full flex flex-col items-center justify-center">
      <div class="w-full h-3/4 bg-blue-600 flex items-center justify-center">
        <span class="text-4xl">Shirt 3</span>
      </div>
      <h2 class="text-2xl font-bold ">Shirt 3 Name</h2>
      <p class="text-lg text-gray-400 mb-2">$39.99</p>
    </div>
    <div class="min-w-full flex flex-col items-center justify-center">
      <div class="w-full h-3/4 bg-blue-600 flex items-center justify-center">
        <span class="text-4xl">Hoodie 3</span>
      </div>
      <h2 class="text-2xl font-bold ">Hoodie 3 Name</h2>
      <p class="text-lg text-gray-400 mb-2">$39.99</p>
    </div>
   
  </div>

  <!-- Pagination -->
  <div id="shirts-dots" class="absolute bottom-10 w-full flex justify-center space-x-4"></div>
</section>

<!-- Mats Intro -->
<div class="flex flex-col items-center justify-center mt-10 h-screen">
     <h2 class="text-center text-5xl dark:text-white mb-5">Pins</h2>
     <p class="text-3xl dark:text-white">Have your own pin collections of your favorite characters!</p>
</div>

<!-- PINS  -->
<section class="relative h-screen overflow-hidden dark:text-white">
  <div id="pins-slider" class="flex transition-transform duration-500 h-full">
   
    <div class="min-w-full flex flex-col items-center justify-center">
      <div class="w-full h-3/4 bg-green-700 flex items-center justify-center">
        <span class="text-4xl">Pin 1</span>
      </div>
      <h2 class="text-2xl font-bold ">Pin 1 Name</h2>
      <p class="text-lg text-gray-400 mb-2">$9.99</p>
    </div>
    <div class="min-w-full flex flex-col items-center justify-center">
      <div class="w-full h-3/4 bg-green-600 flex items-center justify-center">
        <span class="text-4xl">Pin 2</span>
      </div>
      <h2 class="text-2xl font-bold ">Pin 2 Name</h2>
      <p class="text-lg text-gray-400 mb-2">$11.99</p>
    </div>
     <div class="min-w-full flex flex-col items-center justify-center">
      <div class="w-full h-3/4 bg-green-600 flex items-center justify-center">
        <span class="text-4xl">Pin 3</span>
      </div>
      <h2 class="text-2xl font-bold ">Pin 3 Name</h2>
      <p class="text-lg text-gray-400 mb-2">$11.99</p>
    </div>
     <div class="min-w-full flex flex-col items-center justify-center">
      <div class="w-full h-3/4 bg-green-600 flex items-center justify-center">
        <span class="text-4xl">Pin 4</span>
      </div>
      <h2 class="text-2xl font-bold ">Pin 4 Name</h2>
      <p class="text-lg text-gray-400 mb-2">$11.99</p>
    </div>
     <div class="min-w-full flex flex-col items-center justify-center">
      <div class="w-full h-3/4 bg-green-600 flex items-center justify-center">
        <span class="text-4xl">Pin 5</span>
      </div>
      <h2 class="text-2xl font-bold ">Pin 5 Name</h2>
      <p class="text-lg text-gray-400 mb-2">$11.99</p>
    </div>
     <div class="min-w-full flex flex-col items-center justify-center">
      <div class="w-full h-3/4 bg-green-600 flex items-center justify-center">
        <span class="text-4xl">Pin 6</span>
      </div>
      <h2 class="text-2xl font-bold ">Pin 6 Name</h2>
      <p class="text-lg text-gray-400 mb-2">$11.99</p>
    </div>
  
  </div>

  <!-- Pagination -->
  <div id="pins-dots" class="absolute bottom-10 w-full flex justify-center space-x-4"></div>
</section>


<script>
function createSlider(sliderId, dotsId, totalSlides) {
  const slider = document.getElementById(sliderId);
  const dotsContainer = document.getElementById(dotsId);

  let currentSlide = 0;

  function goToSlide(index) {
    slider.style.transform = `translateX(-${index * 100}%)`;
    Array.from(dotsContainer.children).forEach(dot => dot.classList.remove('bg-white'));
    dotsContainer.children[index].classList.add('bg-white');
  }

  // Create pagination dots dynamically (sakit sa ulo)
  for (let i = 0; i < totalSlides; i++) {
    const dot = document.createElement('div');
    dot.className = "w-3 h-3 bg-gray-500 rounded-full cursor-pointer transition-all";
    dot.addEventListener('click', () => {
      currentSlide = i;
      goToSlide(currentSlide);
    });
    dotsContainer.appendChild(dot);
  }

  goToSlide(0); // Initialize at first slide
}

// Initialize sliders
createSlider('mats-slider', 'mats-dots', 6);
createSlider('shirts-slider', 'shirts-dots', 6);
createSlider('pins-slider', 'pins-dots', 6);
</script>


<!-- Info Section -->
<div class="flex flex-col items-center justify-center min-h-screen dark:text-white gap-y-10">
  
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
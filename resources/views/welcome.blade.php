<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>3ELLLE - Home</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

        <!-- Styles / Scripts -->
        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @endif
    </head>
    <body class="bg-[#FDFDFC] dark:bg-[#0a0a0a] text-[#1b1b18]  p-6 lg:p-8 items-center lg:justify-center min-h-screen  scroll-smooth">
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

        <!-- Hero Section -->
 <div class="align-items-center flex flex-col justify-center h-screen">

        <div class="text-center ">
            <h1 class=" font-bold text-5xl dark:text-white"> Welcome to 3ELLLE official shop</h1>
        </div> 
</div>

<!-- Content Section -->
<div class="align-items-center flex flex-col justify-center h-screen dark:text-white">
    <h2 class="font-bold text-2x1 align text-center">Meet 3ELLLE</h2>
    <p  class="align text-center     justify-center">
        3ELLLE is an independen artist from the Philippines specializing in painting, drawings, and digital art. With a unique style that blends creativity and emotion, 3ELLLE brings ideas to lifethrough vibrant colors and intricate designs. Explore the world of 3ELLLE and discover
        art that inspires and captivates.
    </p>
</div>

<!-- CTA Section -->
<div class="align-items-center flex flex-col justify-center h-screen dark:text-white">
    <h1 class="text-center text-6xl font-bold">Join the adventure by buying some of our Merch!</h1>
    <a href="{{ route('shop') }}" class="dark:border-white text-lg mt-10 text-center">Shop Now</a>
</div>
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

        <!-- Floating Messaging Icon -->
        <div class="fixed bottom-5 right-5">
            @auth
                <a href="{{ route('messages') }}" class="bg-blue-600 text-white p-4 rounded-full shadow-lg hover:bg-blue-700">
                    💬
                </a>
            @else
                <a href="{{ route('register') }}" class="bg-blue-600 text-white p-4 rounded-full shadow-lg hover:bg-blue-700"
                   onclick="alert('Please register or log in first to use the messaging feature!');">
                    💬
                </a>
            @endauth
        </div>

        <div id="messaging-icon" class="fixed bottom-4 right-4 bg-blue-600 text-white p-4 rounded-full shadow-lg cursor-pointer">
    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
        <path stroke-linecap="round" stroke-linejoin="round" d="M12 20.25c4.97 0 9-3.806 9-8.5S16.97 3.25 12 3.25 3 7.056 3 11.75c0 1.61.53 3.11 1.44 4.35L3 20.25l4.5-1.5c1.11.5 2.34.75 3.5.75z" />
    </svg>
</div>

<div id="messaging-modal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden">
    <div class="bg-white rounded-lg shadow-lg p-6 w-full max-w-md">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-lg font-semibold">Message Seller</h3>
            <button id="close-messaging-modal" class="text-gray-500 hover:text-gray-700">&times;</button>
        </div>
        <div id="messages-container" class="h-64 overflow-y-auto border border-gray-300 rounded-lg p-4 mb-4">
            <!-- Messages will be dynamically loaded here -->
        </div>
        <form id="message-form" action="{{ route('send.message') }}" method="POST">
            @csrf
            <textarea name="message" id="message-input" rows="3" required
                class="w-full border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                placeholder="Type your message here..."></textarea>
            <button type="submit"
                class="mt-2 w-full bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700 transition-colors">
                Send
            </button>
        </form>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const messagingIcon = document.getElementById('messaging-icon');
        const messagingModal = document.getElementById('messaging-modal');
        const closeMessagingModal = document.getElementById('close-messaging-modal');

        messagingIcon.addEventListener('click', function () {
            messagingModal.classList.remove('hidden');
        });

        closeMessagingModal.addEventListener('click', function () {
            messagingModal.classList.add('hidden');
        });

        // Fetch and display messages dynamically
        async function fetchMessages() {
            const response = await fetch('{{ route('fetch.messages') }}');
            const messages = await response.json();
            const messagesContainer = document.getElementById('messages-container');
            messagesContainer.innerHTML = '';
            messages.forEach(message => {
                const messageElement = document.createElement('div');
                messageElement.className = 'mb-2 p-2 rounded-lg bg-blue-100 dark:bg-blue-800';
                messageElement.textContent = message.content;
                messagesContainer.appendChild(messageElement);
            });
        }

        fetchMessages();

        // Handle form submission
        const messageForm = document.getElementById('message-form');
        const messageInput = document.getElementById('message-input');
        messageForm.addEventListener('submit', async function (e) {
            e.preventDefault();
            const formData = new FormData(messageForm);
            await fetch(messageForm.action, {
                method: 'POST',
                body: formData,
            });
            messageInput.value = '';
            fetchMessages();
        });
    });
</script>
    </body>
</html>

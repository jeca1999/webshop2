<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight text-center">
            {{ __('Messages') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-semibold">Inbox</h3>
                        <div id="notification-indicator" class="relative">
                            <span class="absolute top-0 right-0 inline-block w-3 h-3 bg-red-600 rounded-full"></span>
                            <button id="refresh-inbox" class="text-blue-600 hover:underline">Refresh</button>
                        </div>
                    </div>
                    <div id="inbox-container" class="h-96 overflow-y-auto border border-gray-300 dark:border-gray-700 rounded-lg p-4 bg-gray-50 dark:bg-gray-900">
                        
                    </div>
                    <div id="messages-container" class="h-96 overflow-y-auto border border-gray-300 dark:border-gray-700 rounded-lg p-4 bg-gray-50 dark:bg-gray-900 mt-4">
                        <!-- Messages will be dynamically loaded here -->
                    </div>
                    <form id="message-form" action="{{ route('send.message') }}" method="POST" class="mt-4">
                        @csrf
                        <div class="flex items-center">
                            <input type="text" name="message" id="message-input" required
                                class="flex-grow px-4 py-2 border border-gray-300 dark:border-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 bg-gray-50 dark:bg-gray-900 text-gray-900 dark:text-gray-100"
                                placeholder="Type your message here...">
                            <button type="submit"
                                class="ml-4 px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                                {{ __('Send') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const inboxContainer = document.getElementById('inbox-container');
            const messagesContainer = document.getElementById('messages-container');
            const notificationIndicator = document.getElementById('notification-indicator');
            const refreshInboxButton = document.getElementById('refresh-inbox');
            const messageForm = document.getElementById('message-form');
            const messageInput = document.getElementById('message-input');

            // Function to fetch inbox messages
            async function fetchInbox() {
                const response = await fetch('{{ route('fetch.inbox') }}');
                const messages = await response.json();
                inboxContainer.innerHTML = '';
                messages.forEach(message => {
                    const messageElement = document.createElement('div');
                    messageElement.className = 'mb-2 p-2 rounded-lg bg-blue-100 dark:bg-blue-800';
                    messageElement.textContent = message.content;
                    inboxContainer.appendChild(messageElement);
                });
                notificationIndicator.querySelector('span').classList.add('hidden');
            }

            // Function to fetch and display messages
            async function fetchMessages() {
                const response = await fetch('{{ route('fetch.messages') }}');
                const messages = await response.json();
                messagesContainer.innerHTML = '';
                messages.forEach(message => {
                    const messageElement = document.createElement('div');
                    messageElement.className = 'mb-2 p-2 rounded-lg bg-blue-100 dark:bg-blue-800';
                    messageElement.textContent = message.content;
                    messagesContainer.appendChild(messageElement);
                });
                messagesContainer.scrollTop = messagesContainer.scrollHeight;
            }

            // Fetch inbox messages and regular messages on page load
            fetchInbox();
            fetchMessages();

            // Refresh inbox on button click
            refreshInboxButton.addEventListener('click', fetchInbox);

            // Handle form submission
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

            // Poll for new messages every 5 seconds
            setInterval(fetchMessages, 5000);

            // Simulate new message notification
            setInterval(() => {
                notificationIndicator.querySelector('span').classList.remove('hidden');
            }, 10000); // Every 10 seconds
        });
    </script>
</x-app-layout>

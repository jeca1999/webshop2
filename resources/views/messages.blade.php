<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight text-center">
            {{ __('Messages') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-lg sm:rounded-lg flex h-[70vh]">
                <!-- Sidebar: Conversation List -->
                <div class="w-1/3 border-r border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-900 flex flex-col">
                    <div class="p-4 border-b border-gray-200 dark:border-gray-700">
                        <input type="text" placeholder="Search Messages" class="w-full rounded-full px-4 py-2 bg-gray-200 dark:bg-gray-800 text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500" />
                    </div>
                    <ul class="flex-1 overflow-y-auto divide-y divide-gray-200 dark:divide-gray-700">
                        <li class="flex items-center gap-3 px-4 py-3 cursor-pointer hover:bg-blue-100 dark:hover:bg-blue-900 transition">
                            <img src="https://randomuser.me/api/portraits/men/32.jpg" class="w-10 h-10 rounded-full" />
                            <div class="flex-1 ml-2">
                                <div class="font-semibold">John Doe</div>
                                <div class="text-xs text-gray-500 dark:text-gray-400 truncate">Last message preview...</div>
                            </div>
                            <span class="text-xs text-gray-400">2m</span>
                        </li>
                        <li class="flex items-center gap-3 px-4 py-3 cursor-pointer hover:bg-blue-100 dark:hover:bg-blue-900 transition">
                            <img src="https://randomuser.me/api/portraits/women/44.jpg" class="w-10 h-10 rounded-full" />
                            <div class="flex-1 ml-2">
                                <div class="font-semibold">Jane Smith</div>
                                <div class="text-xs text-gray-500 dark:text-gray-400 truncate">Another message preview...</div>
                            </div>
                            <span class="text-xs text-gray-400">5m</span>
                        </li>
                    </ul>
                </div>
                <!-- Main: Chat Thread -->
                <div class="flex-1 flex flex-col bg-white dark:bg-gray-800">
                    <!-- Chat Header -->
                    <div class="flex items-center gap-3 border-b border-gray-200 dark:border-gray-700 px-6 py-4 bg-gray-100 dark:bg-gray-900">
                        <img src="https://randomuser.me/api/portraits/men/32.jpg" class="w-10 h-10 rounded-full" />
                        <div class="ml-2">
                            <div class="font-semibold text-lg">John Doe</div>
                            <div class="text-xs text-gray-500 dark:text-gray-400">Active now</div>
                        </div>
                    </div>
                    <!-- Chat Messages -->
                    <div class="flex-1 overflow-y-auto px-6 py-4 flex flex-col gap-3 bg-white dark:bg-gray-800">
                        <div class="self-start max-w-xs">
                            <div class="bg-gray-200 dark:bg-gray-700 text-gray-900 dark:text-gray-100 rounded-2xl px-4 py-2">Hi, I have a question about your product.</div>
                            <div class="text-xs text-gray-400 mt-1 ml-2">10:00 AM</div>
                        </div>
                        <div class="self-end max-w-xs">
                            <div class="bg-blue-600 text-white rounded-2xl px-4 py-2">Sure! How can I help you?</div>
                            <div class="text-xs text-gray-400 mt-1 mr-2 text-right">10:01 AM</div>
                        </div>
                        <div class="self-start max-w-xs">
                            <div class="bg-gray-200 dark:bg-gray-700 text-gray-900 dark:text-gray-100 rounded-2xl px-4 py-2">Can you make it in a different color?</div>
                            <div class="text-xs text-gray-400 mt-1 ml-2">10:02 AM</div>
                        </div>
                        <div class="self-end max-w-xs">
                            <div class="bg-blue-600 text-white rounded-2xl px-4 py-2">Yes, I can customize the color for you.</div>
                            <div class="text-xs text-gray-400 mt-1 mr-2 text-right">10:03 AM</div>
                        </div>
                    </div>
                    <!-- Message Input -->
                    <form class="flex gap-2 p-4 border-t border-gray-200 dark:border-gray-700 bg-gray-100 dark:bg-gray-900">
                        <input type="text" class="flex-1 rounded-full border border-gray-300 dark:border-gray-700 px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100" placeholder="Type a message...">
                        <button type="submit" class="px-6 py-2 rounded-full bg-blue-600 text-white font-semibold hover:bg-blue-700 transition">Send</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

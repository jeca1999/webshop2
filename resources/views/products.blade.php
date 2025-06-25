<x-app-layout>
    <div>
        <!-- Header -->
        <header class="w-full px-2 sm:px-4 py-4 flex flex-col md:flex-row items-center justify-between gap-4 border-b border-gray-200 dark:border-gray-800 bg-white dark:bg-black">
            <h1 class="text-3xl font-bold text-center md:text-left text-black dark:text-white">3ELLLE</h1>
            <div class="flex gap-2 flex-wrap">
                <a href="{{ route('seller.dashboard') }}" class="inline-block px-5 py-1.5 border border-black dark:border-white text-black dark:text-white rounded-sm text-sm leading-normal hover:bg-red-500 hover:text-white transition">Dashboard</a>
                <a href="{{ route('seller.products') }}" class="inline-block px-5 py-1.5 border border-black dark:border-white text-black dark:text-white rounded-sm text-sm leading-normal hover:bg-red-500 hover:text-white transition">Products</a>
            </div>
        </header>

        <div class="py-6 sm:py-10 lg:py-12">
            <div class="max-w-7xl mx-auto px-2 sm:px-4 md:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="flex flex-col lg:flex-row gap-y-8 gap-x-12 p-4 sm:p-6 md:p-8">
                        <div class="flex flex-col lg:flex-row w-full">
                            <form id="image-upload-form" action="{{ route('seller.products.store') }}" method="POST" enctype="multipart/form-data" class="w-full flex flex-col lg:flex-row items-center lg:items-start lg:pl-8 mt-8 lg:mt-0 gap-y-8 gap-x-8">
                                @csrf
                                <div class="flex flex-col items-center justify-center w-full lg:w-1/2 border-b lg:border-b-0 lg:border-r border-gray-300 dark:border-gray-700 lg:pr-8 pb-8 lg:pb-0">
                                    <div class="mb-4 text-white text-center">{{ __("Product Image") }}</div>
                                    <div class="flex justify-center w-full">
                                        <div id="drop-area" class="flex flex-col items-center justify-center w-full max-w-xs sm:max-w-sm md:max-w-md lg:w-96 h-64 sm:h-80 md:h-96 border-2 border-dashed border-gray-400 rounded-lg cursor-pointer hover:border-blue-500 transition-colors bg-gray-50 dark:bg-gray-700 relative overflow-hidden">
                                            <svg class="w-10 h-10 sm:w-12 sm:h-12 text-gray-400 mb-2 z-10 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 48 48">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M8 32V40a4 4 0 004 4h24a4 4 0 004-4V32M32 16l-8-8-8 8M24 8v24" />
                                            </svg>
                                            <span class="text-gray-600 dark:text-gray-300 mb-2 z-10 pointer-events-none text-xs sm:text-sm text-center">Drag & drop an image here, or click to select</span>
                                            <input id="product-image-input" name="image" type="file" accept="image/png, image/jpeg" class="w-full h-full absolute inset-0 opacity-0 cursor-pointer" />
                                            <img id="preview-image" class="absolute inset-0 w-full h-full object-cover m-auto rounded z-20 hidden bg-white/80" />
                                        </div>
                                    </div>
                                </div>
                                <div class="w-full lg:w-1/2 flex flex-col items-center lg:items-start lg:pl-8 mt-8 lg:mt-0 gap-y-4">
                                    <div class="mb-6 relative w-full max-w-xs sm:max-w-sm md:max-w-md">
                                        <input type="text" name="name" id="product-name" required
                                            class="peer block w-full pt-10 px-3 pb-2 bg-transparent border-b-2 border-white focus:outline-none focus:border-blue-500 text-base border-l-0 border-t-0 border-r-0 text-white"
                                            placeholder=" " />
                                        <label for="product-name"
                                            class="absolute left-3 top-1 text-gray-500 dark:text-gray-400 text-sm transition-all peer-placeholder-shown:translate-y-4 peer-placeholder-shown:scale-100 peer-focus:scale-75 peer-focus:-translate-y-3 pointer-events-none">
                                            {{ __('Product Name') }}
                                        </label>
                                    </div>
                                    <div class="mb-6 relative w-full max-w-xs sm:max-w-sm md:max-w-md">
                                        <textarea name="description" id="product-description" required rows="3"
                                            class="peer block w-full pt-5 px-3 pb-2 bg-transparent border-b-2 border-white focus:outline-none focus:border-blue-500 text-base resize-none border-l-0 border-t-0 border-r-0 text-white"
                                            placeholder=" "></textarea>
                                        <label for="product-description"
                                            class="absolute left-3 top-1 text-gray-500 dark:text-gray-400 text-sm transition-all peer-placeholder-shown:translate-y-4 peer-placeholder-shown:scale-100 peer-focus:scale-75 peer-focus:-translate-y-3 pointer-events-none">
                                            {{ __('Description') }}
                                        </label>
                                    </div>
                                    <div class="mb-6 relative w-full max-w-xs sm:max-w-sm md:max-w-md">
                                        <input type="number" name="price" id="product-price" required step="0.01" min="0"
                                            class="peer block w-full pt-5 px-3 pb-2 bg-transparent border-b-2 border-white focus:outline-none focus:border-blue-500 text-base border-l-0 border-t-0 border-r-0 text-white"
                                            placeholder=" " />
                                        <label for="product-price"
                                            class="absolute left-3 top-1 text-gray-500 dark:text-gray-400 text-sm transition-all peer-placeholder-shown:translate-y-4 peer-placeholder-shown:scale-100 peer-focus:scale-75 peer-focus:-translate-y-3 pointer-events-none">
                                            {{ __('Price') }}
                                        </label>
                                    </div>
                                    <div class="mb-6 relative w-full max-w-xs sm:max-w-sm md:max-w-md">
                                        <input type="text" name="size" id="product-size" required
                                            class="peer block w-full pt-5 px-3 pb-2 bg-transparent border-b-2 border-white focus:outline-none focus:border-blue-500 text-base border-l-0 border-t-0 border-r-0 text-white"
                                            placeholder=" " />
                                        <label for="product-size"
                                            class="absolute left-3 top-1 text-gray-500 dark:text-gray-400 text-sm transition-all peer-placeholder-shown:translate-y-4 peer-placeholder-shown:scale-100 peer-focus:scale-75 peer-focus:-translate-y-3 pointer-events-none">
                                            {{ __('Size') }}
                                        </label>
                                    </div>
                                    <div class="mb-6 relative w-full max-w-xs sm:max-w-sm md:max-w-md">
                                        <select name="category" id="product-category" required
                                            class="peer block w-full pt-5 px-3 pb-2 bg-transparent border-b-2 border-white focus:outline-none focus:border-blue-500 text-base appearance-none border-l-0 border-t-0 border-r-0 text-white">
                                            <option value="shop" class="text-black bg-white">{{ __('Shop') }}</option>
                                            <option value="prototype" class="text-black bg-white">{{ __('Prototype') }}</option>
                                        </select>
                                        <label for="product-category"
                                            class="absolute left-3 top-1 text-gray-500 text-sm transition-all peer-placeholder-shown:translate-y-4 peer-placeholder-shown:scale-100 peer-focus:scale-75 peer-focus:-translate-y-3 pointer-events-none">
                                            {{ __('Category') }}
                                        </label>
                                    </div>
                                    <div class="mb-6 relative w-full max-w-xs sm:max-w-sm md:max-w-md">
                                        <select name="subcategory" id="product-subcategory" required
                                            class="peer block w-full pt-5 px-3 pb-2 bg-transparent border-b-2 border-white focus:outline-none focus:border-blue-500 text-base appearance-none border-l-0 border-t-0 border-r-0 text-white">
                                            <option value="" disabled selected hidden class="text-black bg-white"></option>
                                        </select>
                                        <label for="product-subcategory"
                                            class="absolute left-3 top-1 text-gray-500 text-sm transition-all peer-placeholder-shown:translate-y-4 peer-placeholder-shown:scale-100 peer-focus:scale-75 peer-focus:-translate-y-3 pointer-events-none">
                                            {{ __('Subcategory') }}
                                        </label>
                                    </div>
                                    <div class="flex justify-center lg:justify-start w-full max-w-xs sm:max-w-sm md:max-w-md">
                                        <button type="submit"
                                            class="px-10 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors w-full sm:w-auto">
                                            {{ __('Add') }}
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <div>
            <!-- displays product if seller adds product -->
            @foreach(['shop', 'prototype'] as $cat)
            <div class="max-w-7xl mx-auto mt-12 px-2 sm:px-4 md:px-6 lg:px-8">
                <h3 class="text-2xl font-bold mb-4 text-center text-gray-800 dark:text-gray-200">{{ __(ucfirst($cat)) }}</h3>
                <div id="{{ $cat }}-products" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-4 sm:gap-6 text-center text-gray-900 dark:text-gray-100">
                    @forelse($products as $product)
                        @if($product->category === $cat)
                            <div class="bg-white dark:bg-gray-700 rounded-lg shadow-md p-4 flex flex-col items-center product-card cursor-pointer relative group min-w-0 w-full max-w-xs mx-auto transition-transform duration-200 hover:scale-105"
                                data-product-id="{{ $product->id }}"
                                data-product-name="{{ $product->name }}"
                                data-product-description="{{ $product->description }}"
                                data-product-price="{{ $product->price }}"
                                data-product-size="{{ $product->size }}"
                                data-product-category="{{ $product->category }}"
                                data-product-subcategory="{{ $product->subcategory }}"
                                data-product-image="{{ $product->image ? asset('storage/' . ltrim($product->image, '/')) : '' }}"
                                data-product-orientation="{{ $product->image ? (getimagesize(public_path('storage/' . ltrim($product->image, '/')))[0] < getimagesize(public_path('storage/' . ltrim($product->image, '/')))[1] ? 'portrait' : 'landscape') : 'landscape' }}">
                                @if($product->image)
                                    <img src="{{ asset('storage/' . ltrim($product->image, '/')) }}" alt="{{ $product->name }}" class="w-20 h-20 sm:w-24 sm:h-24 md:w-28 md:h-28 object-cover object-center rounded mb-2 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700" />
                                @else
                                    <div class="w-20 h-20 sm:w-24 sm:h-24 md:w-28 md:h-28 flex items-center justify-center bg-gray-200 dark:bg-gray-600 rounded mb-2 text-gray-400 border border-gray-200 dark:border-gray-700">
                                        <span class="text-4xl">🖼️</span>
                                    </div>
                                @endif
                                <h4 class="text-lg font-semibold mb-2 break-words">{{ $product->name }}</h4>
                                <p class="text-gray-700 dark:text-gray-300 mb-2 break-words">{{ $product->description }}</p>
                                <p class="text-sm text-gray-500 dark:text-gray-400 mb-2">Size: {{ $product->size }}</p>
                                <p class="text-xl font-bold text-white mb-2">₱{{ number_format($product->price, 2) }}</p>
                                <p class="text-sm text-white mb-1">
                                    {{ __('Category') }}: <span class="font-semibold text-white">{{ ucfirst($product->category) }}</span>
                                </p>
                                @if($product->subcategory)
                                    <p class="text-sm text-white mb-2">
                                        {{ __('Subcategory') }}: <span class="font-semibold text-white">{{ ucfirst($product->subcategory) }}</span>
                                    </p>
                                @endif
                                <div class="flex gap-2 mt-2">
                                    <a href="#" class="text-blue-600 hover:underline edit-product-link" data-product-id="{{ $product->id }}">Edit</a>
                                    <form action="{{ route('seller.products.delete', $product) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:underline ml-2">Delete</button>
                                    </form>
                                </div>
                            </div>
                        @endif
                    @empty
                        <div class="col-span-full text-center text-gray-500 dark:text-gray-400">No products found.</div>
                    @endforelse
                </div>
            </div>
            @endforeach

            <!-- Custom Modal for edits -->
            <div id="edit-product-modal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black bg-opacity-70 flex overflow-auto">
              <div class="bg-gray-900 text-white rounded-xl p-4 sm:p-8 w-full max-w-xs sm:max-w-md md:max-w-lg shadow-2xl relative animate-fade-in mx-auto my-auto max-h-screen overflow-y-auto">
                <button class="absolute top-4 right-4 text-2xl text-gray-400 hover:text-white focus:outline-none" id="close-edit-modal">&times;</button>
                <h3 class="text-xl font-bold mb-6">Edit Product</h3>
                <form id="edit-product-form" method="POST" enctype="multipart/form-data" class="space-y-4">
                  @csrf
                  @method('PATCH')
                  <input type="hidden" name="product_id" id="edit-product-id">
                  <div>
                    <label for="edit-product-name" class="block mb-1 text-sm font-medium">Name</label>
                    <input type="text" name="name" id="edit-product-name" class="w-full rounded-md bg-gray-800 border border-gray-700 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" />
                  </div>
                  <div>
                    <label for="edit-product-description" class="block mb-1 text-sm font-medium">Description</label>
                    <textarea name="description" id="edit-product-description" class="w-full rounded-md bg-gray-800 border border-gray-700 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
                  </div>
                  <div class="flex gap-4">
                    <div class="w-1/2">
                      <label for="edit-product-price" class="block mb-1 text-sm font-medium">Price</label>
                      <input type="number" name="price" id="edit-product-price" step="0.01" min="0" class="w-full rounded-md bg-gray-800 border border-gray-700 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" />
                    </div>
                    <div class="w-1/2">
                      <label for="edit-product-size" class="block mb-1 text-sm font-medium">Size</label>
                      <input type="text" name="size" id="edit-product-size" class="w-full rounded-md bg-gray-800 border border-gray-700 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" />
                    </div>
                  </div>
                  <div>
                    <label for="edit-product-category" class="block mb-1 text-sm font-medium text-white">Category</label>
                    <select name="category" id="edit-product-category" class="w-full rounded-md bg-gray-800 border border-gray-700 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                      <option value="shop" class="text-black dark">Shop</option>
                      <option value="prototype" class="text-black">Prototype</option>
                    </select>
                  </div>
                  <div>
                    <label for="edit-product-subcategory" class="block mb-1 text-sm font-medium">Subcategory</label>
                    <select name="subcategory" id="edit-product-subcategory" class="w-full rounded-md bg-gray-800 border border-gray-700 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                      <option value="" class="text-white">Select a subcategory</option>
                    </select>
                  </div>
                  <div>
                    <label for="edit-product-image" class="block mb-1 text-sm font-medium">Image</label>
                    <input type="file" name="image" id="edit-product-image" accept="image/png, image/jpeg" class="w-full text-gray-300" />
                  </div>
                  <div class="flex flex-col items-center">
                    <img id="modal-product-image" class="block mx-auto rounded mb-6 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 object-contain" style="max-height:80vh; max-width:90vw; width:auto; height:auto; display:none;" />
                  </div>
                  <div class="flex justify-end gap-3 pt-2">
                    <button type="button" class="px-4 py-2 rounded-md bg-gray-700 hover:bg-gray-600 text-white" id="cancel-edit-modal">Cancel</button>
                    <button type="submit" class="px-6 py-2 rounded-md bg-blue-600 hover:bg-blue-700 text-white font-semibold">Save Changes</button>
                  </div>
                </form>
              </div>
            </div>

        <style>
        @media (max-width: 400px) {
          .product-card { min-width: 90vw !important; }
        }
        @media (max-width: 640px) {
          #drop-area { max-width: 95vw !important; height: 48vw !important; min-height: 180px; }
        }
        @media (max-width: 350px) {
          .product-card { min-width: 98vw !important; }
        }
        @keyframes fade-in {
          0% { opacity: 0; transform: scale(0.95); }
          100% { opacity: 1; transform: scale(1); }
        }
        .animate-fade-in {
          animation: fade-in 0.2s ease;
        }

        /* Force light mode and black text for dropdowns */
        select#product-category, select#product-subcategory, select#edit-product-category, select#edit-product-subcategory {
          background-color: transparent !important;
          color: #fff !important;
          border-color: #ccc !important;
          box-shadow: none !important;
          border-bottom-width: 2px !important;
          border-left: 0 !important;
          border-top: 0 !important;
          border-right: 0 !important;
          padding-top: 1.25rem !important;
          padding-bottom: 0.5rem !important;
          padding-left: 0.75rem !important;
          padding-right: 0.75rem !important;
        }
        select#product-category option, select#product-subcategory option,
        select#edit-product-category option, select#edit-product-subcategory option {
          background: #222 !important;
          color: #fff !important;
        }
        .dark select#product-category, .dark select#product-subcategory,
        .dark select#edit-product-category, .dark select#edit-product-subcategory {
          background-color: transparent !important;
          color: #fff !important;
        }

        /* Add visible border for text fields in light mode */
        input[type="text"],
        input[type="number"],
        textarea,
        select {
          border-bottom: 1px solid #222 !important; 
          color: inherit !important;
          background: transparent !important;
        }
        .dark input[type="text"],
        .dark input[type="number"],
        .dark textarea,
        .dark select {
          border-bottom: 1px solid #fff !important; 
          color: #fff !important;
          background: transparent !important;
        }
        input[type="text"]:focus,
        input[type="number"]:focus,
        textarea:focus,
        select:focus {
          border-bottom: 1.5px solid #3b82f6 !important; 
        }

        select#product-category,
        select#product-subcategory {
          border-bottom: 1.5px solid #111 !important; /* darker line for light mode */
          color: #222 !important;
          background: transparent !important;
        }
        select#product-category:focus,
        select#product-subcategory:focus {
          border-bottom: 2px solid #3b82f6 !important;
        }
        </style>
        <script src="/js/products.js"></script>
        @if(session('success'))
            <div class="fixed top-6 left-1/2 transform -translate-x-1/2 z-50 bg-green-600 text-white px-6 py-3 rounded-lg shadow-lg animate-fade-in-out">
                {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="fixed top-6 left-1/2 transform -translate-x-1/2 z-50 bg-red-600 text-white px-6 py-3 rounded-lg shadow-lg animate-fade-in-out">
                {{ session('error') }}
            </div>
        @endif
    </div>
</x-app-layout>


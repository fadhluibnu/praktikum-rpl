<x-layouts>
    <x-slot:title>
        Product Details
    </x-slot>

    <div class="max-w-2xl mx-auto bg-white rounded-lg shadow-md p-6">
        <h1 class="text-2xl font-bold text-gray-800 mb-6">Product Details</h1>

        <div class="mb-8">
            <div class="flex items-center justify-center mb-6">
                <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center">
                    <svg class="w-12 h-12 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                    </svg>
                </div>
            </div>

            <div class="space-y-4">
                <div class="bg-gray-50 rounded-lg p-4">
                    <div class="text-sm text-gray-500 mb-1">ID</div>
                    <div class="text-lg font-medium">{{ $product->id }}</div>
                </div>

                <div class="bg-gray-50 rounded-lg p-4">
                    <div class="text-sm text-gray-500 mb-1">Name</div>
                    <div class="text-lg font-medium">{{ $product->name }}</div>
                </div>

                <div class="bg-gray-50 rounded-lg p-4">
                    <div class="text-sm text-gray-500 mb-1">Description</div>
                    <div class="text-gray-700">
                        @if ($product->description)
                            {{ $product->description }}
                        @else
                            <span class="text-gray-400 italic">No description provided</span>
                        @endif
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="bg-gray-50 rounded-lg p-4">
                        <div class="text-sm text-gray-500 mb-1">Price</div>
                        <div class="text-lg font-medium text-blue-600">${{ number_format($product->price, 2) }}</div>
                    </div>

                    <div class="bg-gray-50 rounded-lg p-4">
                        <div class="text-sm text-gray-500 mb-1">Stock</div>
                        <div class="flex items-center">
                            <span class="text-lg font-medium">{{ $product->stock }}</span>
                            @if ($product->stock > 10)
                                <span class="ml-2 px-2 py-1 bg-green-100 text-green-800 text-xs rounded-full">In
                                    Stock</span>
                            @elseif($product->stock > 0)
                                <span class="ml-2 px-2 py-1 bg-yellow-100 text-yellow-800 text-xs rounded-full">Low
                                    Stock</span>
                            @else
                                <span class="ml-2 px-2 py-1 bg-red-100 text-red-800 text-xs rounded-full">Out of
                                    Stock</span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="flex items-center space-x-4">
            <a href="{{ url('/products') }}"
                class="flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd"
                        d="M9.707 14.707a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 1.414L7.414 9H15a1 1 0 110 2H7.414l2.293 2.293a1 1 0 010 1.414z"
                        clip-rule="evenodd" />
                </svg>
                Back to Products
            </a>

            <a href="{{ url('/products/' . $product->id . '/edit') }}"
                class="flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                    <path
                        d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                </svg>
                Edit This Product
            </a>
        </div>
    </div>

</x-layouts>

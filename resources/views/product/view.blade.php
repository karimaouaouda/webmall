<x-guest-layout include-navbar="true">
    <div class="bg-gray-100 dark:bg-gray-800 py-8">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row -mx-4">
                <div class="md:flex-1 px-4">
                    <div class="h-[460px] rounded-lg bg-gray-300 dark:bg-gray-700 mb-4">
                        <img class="w-full h-full object-cover"
                            src="https://images.unsplash.com/photo-1600185365483-26d7a4cc7519?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxzZWFyY2h8OHx8c25lYWtlcnxlbnwwfHwwfHw%3D&auto=format&fit=crop&w=500&q=60"
                            alt="Product Image">
                    </div>
                    <div class="flex -mx-2 mb-4">
                        <div class="w-1/2 px-2">
                            <button
                                class="w-full bg-gray-900 dark:bg-gray-600 text-white py-2 px-4 rounded-full font-bold hover:bg-gray-800 dark:hover:bg-gray-700">Add
                                to Cart</button>
                        </div>
                        <div class="w-1/2 px-2">
                            <a href="{{ route('command.pay', ['product' => $product->id]) }}"
                                class="block text-center w-full bg-red-400 text-white dark:bg-gray-700 font-extrabold uppercase dark:text-white py-2 px-4 rounded-full hover:bg-red-600 duration-300 ease-in-out dark:hover:bg-gray-600">
                                buy now
                            </a>
                        </div>
                    </div>
                </div>
                <div class="md:flex-1 px-4">
                    <h2 class="text-2xl font-bold text-gray-800 dark:text-white mb-2">
                        {{ $product->slug }}
                    </h2>
                    <p class="text-gray-600 dark:text-gray-300 text-sm mb-4">
                        {{ $product->description }}
                    </p>
                    <div class="flex mb-4">
                        <div class="mr-4">
                            <span class="font-bold text-gray-700 dark:text-gray-300">Price:</span>
                            <span class="text-gray-600 dark:text-gray-300">$29.99</span>
                        </div>
                        <div>
                            <span class="font-bold text-gray-700 dark:text-gray-300">Availability:</span>
                            <span class="text-gray-600 dark:text-gray-300">In Stock</span>
                        </div>
                    </div>
                    <div class="mb-4">
                        <span class="font-bold text-gray-700 dark:text-gray-300">Select Color:</span>
                        <div class="flex items-center mt-2">
                            <button class="w-6 h-6 rounded-full bg-gray-800 dark:bg-gray-200 mr-2"></button>
                            <button class="w-6 h-6 rounded-full bg-red-500 dark:bg-red-700 mr-2"></button>
                            <button class="w-6 h-6 rounded-full bg-blue-500 dark:bg-blue-700 mr-2"></button>
                            <button class="w-6 h-6 rounded-full bg-yellow-500 dark:bg-yellow-700 mr-2"></button>
                        </div>
                    </div>
                    <div class="mb-4">
                        <span class="font-bold text-gray-700 dark:text-gray-300">Select Size:</span>
                        <div class="flex items-center mt-2">
                            <button
                                class="bg-gray-300 dark:bg-gray-700 text-gray-700 dark:text-white py-2 px-4 rounded-full font-bold mr-2 hover:bg-gray-400 dark:hover:bg-gray-600">S</button>
                            <button
                                class="bg-gray-300 dark:bg-gray-700 text-gray-700 dark:text-white py-2 px-4 rounded-full font-bold mr-2 hover:bg-gray-400 dark:hover:bg-gray-600">M</button>
                            <button
                                class="bg-gray-300 dark:bg-gray-700 text-gray-700 dark:text-white py-2 px-4 rounded-full font-bold mr-2 hover:bg-gray-400 dark:hover:bg-gray-600">L</button>
                            <button
                                class="bg-gray-300 dark:bg-gray-700 text-gray-700 dark:text-white py-2 px-4 rounded-full font-bold mr-2 hover:bg-gray-400 dark:hover:bg-gray-600">XL</button>
                            <button
                                class="bg-gray-300 dark:bg-gray-700 text-gray-700 dark:text-white py-2 px-4 rounded-full font-bold mr-2 hover:bg-gray-400 dark:hover:bg-gray-600">XXL</button>
                        </div>
                    </div>
                    <div>
                        <span class="font-bold text-gray-700 dark:text-gray-300">Product Description:</span>
                      
                        {!! $product->description !!}
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-guest-layout>
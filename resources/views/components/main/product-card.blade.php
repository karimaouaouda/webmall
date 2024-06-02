<div
    class="relative mx-1 my-2 shrink-0 hover:scale-[1.01] duration-150 ease-in-out flex w-full max-w-xs flex-col overflow-hidden rounded-lg  border-gray-100 bg-white shadow-md">
    <a class="relative mx-3 mt-3 flex h-60 overflow-hidden rounded-xl" href="#">
        <img class="object-cover mx-auto"
            src="{{ asset('storage/' . ($product->images ? $product->images[0] : '')) }}"
            alt="product image" />
        <span class="absolute top-0 left-0 m-2 rounded-full bg-black px-2 text-center text-sm font-medium text-white">{{ $product->solde }}%
            OFF</span>

        <span
            class="absolute top-0 right-0 m-2 rounded-full bg-red-400 px-2 text-center text-sm font-medium text-white">welcome
            deal</span>

        <span
            class="absolute bottom-0 right-0 m-2 rounded-full bg-slate-800 bg-opacity-35 px-2 text-center text-sm font-medium text-white">+{{ count($product->images) - 1 }}</span>
    </a>
    <div class="mt-4 px-5 pb-5">
        <a href="#">
            <h5 class="text-sm line-clamp-1 text-ellipsis font-semibold tracking-tight text-slate-900">
                {{ $product->slug }}
            </h5>
        </a>
        <div class="mt-2 flex items-center justify-between">
            <p class="whitespace-nowrap">
                <span class="text-xl font-bold text-red-400">{{$product->price_after_solde == 0 ? "FREE" : "DA ".  $product->price_after_solde }}</span>
                <span class="text-sm text-slate-900 line-through">DA{{ $product->price ?? 100 }}</span>
            </p>
            <div class="flex items-center">
                <i class="bi bi-star-fill"></i>
                <i class="bi bi-star-fill"></i>
                <i class="bi bi-star-fill"></i>
                <i class="bi bi-star-fill"></i>
                <i class="bi bi-star"></i>
                <span class="mr-2 ml-3 rounded bg-yellow-200 px-2.5 py-0.5 text-xs font-semibold">4</span>
            </div>
        </div>
        <div class="mb-4 flex items-center justify-around">
            <span class="text-gray-500 text-xs">
                +7000 sold
            </span>
            <span class="rounded-full bg-black text-white p-1 text-center capitalize text-xs">
                free shipping
            </span>
        </div>
        <div class="w-fill flex gap-3 items-center">
            <a target="_blank" href="{{ route( 'product.view', ['product' => $product->id ?? 1] ) }}"
                class="flex items-center justify-center rounded-md bg-slate-300 px-4 py-2.5 text-center text-sm font-medium text-black hover:bg-gray-400 duration-150 ease-in-out focus:outline-none focus:ring-4 focus:ring-blue-300">
                <i class="bi bi-eye mx-2"></i>
                preview
            </a>
            @auth('client')
            <button data-target="{{ $product->id }}"
                class="addToCart flex items-center justify-center rounded-md bg-slate-900 px-5 py-2.5 text-center text-sm font-medium text-white hover:bg-gray-700 focus:outline-none focus:ring-4 focus:ring-blue-300">
                <i class="bi bi-cart3 text-xl mx-2 -mt-1"></i>
                Add to cart
            </button>
            @else
            <a href="{{ route('client.login') }}"
                class="addToCart flex items-center justify-center rounded-md bg-slate-900 px-5 py-2.5 text-center text-sm font-medium text-white hover:bg-gray-700 focus:outline-none focus:ring-4 focus:ring-blue-300">
                <i class="bi bi-cart3 text-xl mx-2 -mt-1"></i>
                Add to cart
            </a>
            @endauth()
        </div>
    </div>
</div>

@vite(['resources/js/shopping/cart.js'])

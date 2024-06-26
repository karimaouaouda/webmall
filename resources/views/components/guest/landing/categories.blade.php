<section class="w-full min-h-screen gap-8 flex flex-col justify-start py-2 items-center">
    <div class="wrapper w-full px-4 mt-2 flex flex-col gap-3">
        <div class="header">
            <a href="#" class="flex gap-10 items-center">
                <span class="title text-xl font-semibold text-black">
                    Top Sellers
                </span>
                <i class="bi bi-arrow-right text-2xl"></i>
            </a>
        </div>
        <div class="whitespace-nowrap gap-3 h-fit overflow-y-hidden overflow-x-auto flex">
            @foreach($shops as $shop)
                <x-main.shop-card :shop="$shop"/>
            @endforeach
        </div>
    </div>

    <div class="wrapper w-full px-4 mt-2 flex flex-col gap-3">
        <div class="header">
            <a href="#" class="flex gap-10 items-center">
                <span class="title text-xl font-semibold text-black">
                    Top Products
                </span>
                <i class="bi bi-arrow-right text-2xl"></i>
            </a>
        </div>
        <div class="whitespace-nowrap pb-2 gap-3 h-fit overflow-y-hidden overflow-x-auto flex">
            @foreach($products as $product)
                <x-main.product-card :product="$product"/>
            @endforeach
        </div>
    </div>
</section>

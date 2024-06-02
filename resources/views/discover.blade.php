<x-guest-layout include-navbar="true">


    <x-main.filter-box></x-main.filter-box>


    <div class="w-full p-2 flex justify-around flex-wrap">

        @foreach ($products as $product)
            <x-main.product-card :product="$product"/>
        @endforeach
    </div>

</x-guest-layout>
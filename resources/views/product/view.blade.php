<x-guest-layout include-navbar="true">
    <link rel="stylesheet" href="{{ asset('css/filament/forms/forms.css') }}">
    <div x-data="{qte : 1, max : {{$product->available_qte}} }" class="font-sans bg-white">
        <div class="p-6 lg:max-w-7xl max-w-4xl mx-auto">
            <div
                class="grid items-start grid-cols-1 lg:grid-cols-5 gap-12 shadow-[0_2px_10px_-3px_rgba(6,81,237,0.3)] p-6">
                <div x-data="{ current: '{{ asset('storage/' . $product->images[0]) }}' }" class="lg:col-span-3 w-full lg:sticky top-0 text-center">

                    <div class="px-4 py-10 mx-auto rounded-xl shadow-[0_2px_10px_-3px_rgba(6,81,237,0.3)] relative">
                        <img :src="current" alt="Product" class="w-4/5 mx-auto rounded object-cover" />
                        <button type="button" class="absolute top-4 right-4">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20px" fill="#ccc"
                                class="mr-1 hover:fill-[#333]" viewBox="0 0 64 64">
                                <path
                                    d="M45.5 4A18.53 18.53 0 0 0 32 9.86 18.5 18.5 0 0 0 0 22.5C0 40.92 29.71 59 31 59.71a2 2 0 0 0 2.06 0C34.29 59 64 40.92 64 22.5A18.52 18.52 0 0 0 45.5 4ZM32 55.64C26.83 52.34 4 36.92 4 22.5a14.5 14.5 0 0 1 26.36-8.33 2 2 0 0 0 3.27 0A14.5 14.5 0 0 1 60 22.5c0 14.41-22.83 29.83-28 33.14Z"
                                    data-original="#000000"></path>
                            </svg>
                        </button>
                    </div>

                    <div class="mt-6 flex flex-wrap justify-center gap-6 mx-auto">

                        @foreach ($product->images as $image)
                            <div class="rounded-xl p-4 shadow-[0_2px_10px_-3px_rgba(6,81,237,0.3)]">
                                <img @click="current = $el.src" src="{{ asset('storage/' . $image) }}" alt="Product2"
                                    class="w-24 cursor-pointer" />
                            </div>
                        @endforeach

                    </div>
                </div>

                <div class="lg:col-span-2">
                    <h2 class="text-2xl font-extrabold text-[#333]">{{ $product->slug }} |
                        {{ $product->sub_category_name }}</h2>

                    <div class="description">
                        <p class="text-sm my-2 first-line:ml-4">
                            {!! $product->description !!}
                        </p>
                    </div>

                    <div class="flex flex-wrap gap-4 mt-4">
                        <p class="text-[#333] text-3xl font-bold">{{ $product->price_after_solde }}</p>
                        <p class="text-gray-400 text-lg"><strike>{{ $product->price }}</strike></p>
                    </div>

                    <div class="flex items-center space-x-2 mt-4">
                        @php
                            $stars = count($rates) ? (int) ($ratesSum / count($rates)) : 0;
                            $j = 5;
                        @endphp

                        @for($i = 0; $i < $stars; $i++)
                            @php $j-- @endphp
                            <i class="bi bi-star-fill"></i>
                        @endfor

                        @for($i = 0; $i < $j; $i++)
                            
                            <i class="bi bi-star"></i>
                        @endfor




                        <h4 class="text-[#333] text-base">{{ count($rates) }} Reviews</h4>
                    </div>

                    <div class="mt-10">
                        <h3 class="text-lg font-bold text-gray-800">Choose a Color</h3>
                        <div class="flex flex-wrap gap-3 mt-4">
                            <button type="button"
                                class="w-10 h-10 bg-black border-2 border-white hover:border-gray-800 rounded-full shrink-0"></button>
                            <button type="button"
                                class="w-10 h-10 bg-gray-300 border-2 border-white hover:border-gray-800 rounded-full shrink-0"></button>
                            <button type="button"
                                class="w-10 h-10 bg-gray-100 border-2 border-white hover:border-gray-800 rounded-full shrink-0"></button>
                            <button type="button"
                                class="w-10 h-10 bg-blue-400 border-2 border-white hover:border-gray-800 rounded-full shrink-0"></button>
                        </div>
                    </div>

                    <div class="quantity-changer w-fit my-4 flex items-center gap-2">
                        <span class="font-semibold">
                            quantity :
                        </span>
                        <div class="flex gap-2 items-center">
                            <button @click="qte = qte > 1 ? qte - 1 : qte;"
                                class="minus-button rounded-full bg-slate-200 shadow
                                            min-w-[1.5rem] min-h-[1.5rem] ">
                                <i class="bi bi-dash text-sm w-full h-full flex items-center justify-center"></i>
                            </button>

                            <span x-text="qte" id="quantity" class="text-sm font-semibold  w-full h-full flex items-center justify-center">
                                
                            </span>

                            <button @click="qte = qte > max - 1 ? qte : qte + 1"
                                class="minus-button rounded-full bg-slate-200 shadow
                                            min-w-[1.5rem] min-h-[1.5rem] flex items-center justify-center">
                                <i class="bi bi-plus text-sm"></i>
                            </button>
                        </div>

                        <span class="font-normal text-gray-500 text-sm sub">
                            <sub>
                                (available in stock : {{ $product->available_qte }})
                            </sub>
                        </span>
                    </div>

                    <x-filament::section class="my-4  !shadow-md">
                        <x-slot name="heading">
                            Shipping information
                        </x-slot>
                        <x-slot name="description">
                            chose a shipping company you want to ship your product with
                        </x-slot>

                        <div class="flex items-center gap-3">
                            <div class="icon">
                                <i class="bi bi-truck text-4xl drop-shadow"></i>
                            </div>

                            <div class="informations flex flex-col justify-around ">
                                <h1 class="text-lg font-bold uppercase tracking-wide">Yalidine Express</h1>
                                <span class="text-sm font-gray-500 font-normal">yalidine express is a famous delivry
                                    company</span>
                                <span class="font-bold text-sm text-slate-700">125 DA</span>
                            </div>
                        </div>

                    </x-filament::section>

                    <div class="flex flex-wrap gap-4 mt-10">
                        <a :href="'{{route('command.pay', ['source' => 'view', 'pid' => $product->id])}}' + '&qte=' + qte"
                            class="flex justify-center min-w-[200px] px-4 py-3 bg-[#333] hover:bg-[#111] text-white text-sm font-semibold rounded">Buy
                            now</a>
                        <button type="button"
                            class="min-w-[200px] px-4 py-2.5 border border-[#333] bg-transparent hover:bg-gray-50 text-[#333] text-sm font-semibold rounded">Add
                            to cart</button>
                    </div>
                </div>
            </div>

            <div class="mt-16 shadow-[0_2px_10px_-3px_rgba(6,81,237,0.3)] p-6">
                <h3 class="text-lg font-bold text-[#333]">Product information</h3>
                <ul class="mt-6 space-y-6 text-[#333]">
                    @foreach($product->options as $option)
                    <li class="text-sm uppercase">{{ $option['option_name'] }} <span class="ml-4 float-right uppercase">{{ $option['option_value'] }}</span></li>
                    @endforeach
                </ul>
            </div>

            <div class="mt-16 shadow-[0_2px_10px_-3px_rgba(6,81,237,0.3)] p-6">
                <h3 class="text-lg font-bold text-[#333]">Reviews(10)</h3>
                <div class="grid md:grid-cols-2 gap-12 mt-6">
                    <div>
                        <div class="space-y-3">
                            <div class="flex items-center">
                                <p class="text-sm text-[#333] font-bold">5.0</p>
                                <svg class="w-5 fill-[#333] ml-1" viewBox="0 0 14 13" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M7 0L9.4687 3.60213L13.6574 4.83688L10.9944 8.29787L11.1145 12.6631L7 11.2L2.8855 12.6631L3.00556 8.29787L0.342604 4.83688L4.5313 3.60213L7 0Z" />
                                </svg>
                                <div class="bg-gray-400 rounded w-full h-2 ml-3">
                                    <div class="w-2/3 h-full rounded bg-[#333]"></div>
                                </div>
                                <p class="text-sm text-[#333] font-bold ml-3">66%</p>
                            </div>

                            <div class="flex items-center">
                                <p class="text-sm text-[#333] font-bold">4.0</p>
                                <svg class="w-5 fill-[#333] ml-1" viewBox="0 0 14 13" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M7 0L9.4687 3.60213L13.6574 4.83688L10.9944 8.29787L11.1145 12.6631L7 11.2L2.8855 12.6631L3.00556 8.29787L0.342604 4.83688L4.5313 3.60213L7 0Z" />
                                </svg>
                                <div class="bg-gray-400 rounded w-full h-2 ml-3">
                                    <div class="w-1/3 h-full rounded bg-[#333]"></div>
                                </div>
                                <p class="text-sm text-[#333] font-bold ml-3">33%</p>
                            </div>

                            <div class="flex items-center">
                                <p class="text-sm text-[#333] font-bold">3.0</p>
                                <svg class="w-5 fill-[#333] ml-1" viewBox="0 0 14 13" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M7 0L9.4687 3.60213L13.6574 4.83688L10.9944 8.29787L11.1145 12.6631L7 11.2L2.8855 12.6631L3.00556 8.29787L0.342604 4.83688L4.5313 3.60213L7 0Z" />
                                </svg>
                                <div class="bg-gray-400 rounded w-full h-2 ml-3">
                                    <div class="w-1/6 h-full rounded bg-[#333]"></div>
                                </div>
                                <p class="text-sm text-[#333] font-bold ml-3">16%</p>
                            </div>

                            <div class="flex items-center">
                                <p class="text-sm text-[#333] font-bold">2.0</p>
                                <svg class="w-5 fill-[#333] ml-1" viewBox="0 0 14 13" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M7 0L9.4687 3.60213L13.6574 4.83688L10.9944 8.29787L11.1145 12.6631L7 11.2L2.8855 12.6631L3.00556 8.29787L0.342604 4.83688L4.5313 3.60213L7 0Z" />
                                </svg>
                                <div class="bg-gray-400 rounded w-full h-2 ml-3">
                                    <div class="w-1/12 h-full rounded bg-[#333]"></div>
                                </div>
                                <p class="text-sm text-[#333] font-bold ml-3">8%</p>
                            </div>

                            <div class="flex items-center">
                                <p class="text-sm text-[#333] font-bold">1.0</p>
                                <svg class="w-5 fill-[#333] ml-1" viewBox="0 0 14 13" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M7 0L9.4687 3.60213L13.6574 4.83688L10.9944 8.29787L11.1145 12.6631L7 11.2L2.8855 12.6631L3.00556 8.29787L0.342604 4.83688L4.5313 3.60213L7 0Z" />
                                </svg>
                                <div class="bg-gray-400 rounded w-full h-2 ml-3">
                                    <div class="w-[6%] h-full rounded bg-[#333]"></div>
                                </div>
                                <p class="text-sm text-[#333] font-bold ml-3">6%</p>
                            </div>
                        </div>
                    </div>

                    <div>
                        <div class="flex items-start">
                            <img src="https://readymadeui.com/team-2.webp"
                                class="w-12 h-12 rounded-full border-2 border-white" />
                            <div class="ml-3">
                                <h4 class="text-sm font-bold text-[#333]">John Doe</h4>
                                <div class="flex space-x-1 mt-1">
                                    <svg class="w-4 fill-[#333]" viewBox="0 0 14 13" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M7 0L9.4687 3.60213L13.6574 4.83688L10.9944 8.29787L11.1145 12.6631L7 11.2L2.8855 12.6631L3.00556 8.29787L0.342604 4.83688L4.5313 3.60213L7 0Z" />
                                    </svg>
                                    <svg class="w-4 fill-[#333]" viewBox="0 0 14 13" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M7 0L9.4687 3.60213L13.6574 4.83688L10.9944 8.29787L11.1145 12.6631L7 11.2L2.8855 12.6631L3.00556 8.29787L0.342604 4.83688L4.5313 3.60213L7 0Z" />
                                    </svg>
                                    <svg class="w-4 fill-[#333]" viewBox="0 0 14 13" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M7 0L9.4687 3.60213L13.6574 4.83688L10.9944 8.29787L11.1145 12.6631L7 11.2L2.8855 12.6631L3.00556 8.29787L0.342604 4.83688L4.5313 3.60213L7 0Z" />
                                    </svg>
                                    <svg class="w-4 fill-[#CED5D8]" viewBox="0 0 14 13" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M7 0L9.4687 3.60213L13.6574 4.83688L10.9944 8.29787L11.1145 12.6631L7 11.2L2.8855 12.6631L3.00556 8.29787L0.342604 4.83688L4.5313 3.60213L7 0Z" />
                                    </svg>
                                    <svg class="w-4 fill-[#CED5D8]" viewBox="0 0 14 13" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M7 0L9.4687 3.60213L13.6574 4.83688L10.9944 8.29787L11.1145 12.6631L7 11.2L2.8855 12.6631L3.00556 8.29787L0.342604 4.83688L4.5313 3.60213L7 0Z" />
                                    </svg>
                                    <p class="text-xs !ml-2 font-semibold text-[#333]">2 mins ago</p>
                                </div>
                                <p class="text-sm mt-4 text-[#333]">Lorem ipsum dolor sit amet, consectetur adipisci
                                    elit, sed eiusmod tempor incidunt ut labore et dolore magna aliqua.</p>
                            </div>
                        </div>

                        <button type="button"
                            class="w-full mt-10 px-4 py-2.5 bg-transparent hover:bg-gray-50 border border-[#333] text-[#333] font-bold rounded">Read
                            all reviews</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @vite('resources/js/alpine.js')
</x-guest-layout>

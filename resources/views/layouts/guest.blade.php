<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Styles -->
</head>

<body>
    <div class="app w-screen h-screen overflow-y-auto overflow-x-hidden bg-white">
        <div class="w-full">
            @if ($includeNavbar == 'false')
                {{ $header }}
            @else
                <nav class="navbar w-full h-32 bg-slate-100 text-slate-700 shadow-md flex justify-between items-center lg:px-8">
                    <div class="brand h-full">
                        <div class="toggler w-14 h-full" hidden>
                        </div>
                        <div class="logo-container h-full mx-2 overflow-hidden">
                            <a href="#" class="h-full inline-flex">
                                <img class="h-full scale-125" src="{{ asset('assets/images/logo.svg') }}"
                                    alt="logo">
                            </a>
                        </div>
                    </div>

                    <div class="nav-info flex flex-col w-full h-full">
                        <div class="top-nav w-full h-1/2  flex justify-between items-center">
                            {{-- befre the search bar --}}
                            <div class="before px-4 gap-6 flex items-center h-full">
                                <x-parts.dropdown width="w-[350px]" datac="cartData" icon="cart3">
                                    <x-slot:label>
                                        shopping cart
                                    </x-slot:label>
                                    <x-slot:header>
                                        your items
                                    </x-slot:header>

                                    <template x-if="!items.length">
                                        <div class="p-4 text-center font-extralight uppercase text-lg">
                                            no items
                                        </div>
                                    </template>
                                    <template x-if="items.length">
                                        <div class="products p-2 flex flex-col gap-3">
                                            <template x-for="item in items">
                                                <div class="product flex justify-start h-20 w-full overflow-hidden">

                                                    <div class="left h-full flex items-center justify-center">
                                                        <img class="h-full w-20 rounded-md" :src="'{{ asset('assets/products') }}' + '/' + item.slug + '.jpg' " alt="">
                                                    </div>

                                                    <div class="right flex-1 px-2 relative">
                                                        <span class="font-semibold text-sm truncate block w-44" x-text="item.slug">

                                                        </span>
                                                        <p class="font-extralight max-h-[100px] text-xs truncate w-44 text-gray-400" x-text="item.description">

                                                        </p>
                                                        <span class="font-bold text-red-400 drop-shadow shadow-white" x-text="item.price">

                                                        </span>

                                                        <div class="absolute bottom-1 right-2 bg-slate-200 flex
                                                             justify-around items-center h-8 ronded-full w-16 rounded-full">
                                                            <i class="bi bi-dash cursor-pointer hover:bg-gray-300 ease-in-out duration-300 rounded-full w-6 h-6 flex items-center justify-center"></i>
                                                            <span>1</span>
                                                            <i class="bi bi-plus cursor-pointer hover:bg-gray-300 ease-in-out duration-300 rounded-full w-6 h-6 flex items-center justify-center"></i>
                                                        </div>
                                                    </div>

                                                </div>
                                            </template>
                                        </div>

                                    </template>

                                    <x-slot:footer>
                                        <a href="{{ route('command.pay', ['source' => 'cart'])  }}" class="btn bg-sky-400 text-white hover:bg-sky-500 duration-300 ease-in-out">
                                            proceed to checkout <i class="bi bi-arrow-right"></i>
                                        </a>
                                    </x-slot:footer>
                                </x-parts.dropdown>
                                <x-parts.dropdown width="w-[250px]" datac="cartData" icon="person">
                                    <x-slot:label>
                                        My Account
                                    </x-slot:label>
                                    <x-slot:header>

                                    </x-slot:header>
                                    <x-slot:empty-message>
                                        no message
                                    </x-slot:empty-message>

                                    @if(auth('client')->check())
                                    <x-parts.items :list="config('lists.account.default.auth')"/>
                                    @else
                                    <x-parts.items :list="config('lists.account.default.guest')"/>
                                    @endif

                                    <x-slot:footer>

                                    </x-slot:footer>
                                </x-parts.dropdown>
                            </div>

                            {{-- srearch bar : aliexpress like --}}
                            <div class="form-search relative py-[0.75rem] h-full w-7/12">
                                <div class="wrapper w-full mt-2 h-full rounded-lg relative bg-white">
                                    <form action="{{route('search')}}" method="GET" class="h-full w-full">
                                        <input
                                            class="w-full h-full bg-transparent border-none outline-none focus:ring-0
                                    "
                                            type="text" name="query" id="query" placeholder="search..."
                                            aria-autocomplete="both">
                                        <div class="absolute right-0 top-0 w-20 py-1 pr-1 pl-2 h-full">
                                            <button
                                                class="btn w-full h-full text-white rounded-lg flex items-center justify-center
                                     bg-black"
                                                type="button">
                                                <i class="bi bi-search"></i>
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            {{-- after the search bar --}}
                            <div class="after px-4 gap-6 flex items-center h-full">
                                <div class="language">
                                    <div class="toggler text-center">
                                        <i class="bi bi-globe text-lg text-slate-700"></i>
                                        <span class="text-sm text-slate-700 block">
                                            {{ app()->getLocale() }}
                                        </span>
                                    </div>
                                    <div class="language-dropdown" hidden>

                                    </div>
                                </div>

                                <div class="assistance-box">
                                    <div class="toggler text-center">
                                        <i class="bi bi-headset text-lg text-slate-700"></i>
                                        <span class="block text-sm text-slate-700">
                                            Assistance
                                        </span>
                                    </div>
                                    <div class="contenu-assistance">

                                    </div>
                                </div>

                                <div class="download-app" hidden>
                                    <a href="#">
                                        download app
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="bottom-nav w-full h-1/2 px-10 flex justify-between items-center">
                            <ul class="w-full text-sm h-full flex gap-6 items-center text-slate-900 uppercase navlist-black">
                                <li class="tab">
                                    <a href="#" class="text-red-400 font-bold flex gap-1">
                                        supper deals
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-fire" viewBox="0 0 16 16">
                                            <path d="M8 16c3.314 0 6-2 6-5.5 0-1.5-.5-4-2.5-6 .25 1.5-1.25 2-1.25 2C11 4 9 .5 6 0c.357 2 .5 4-2 6-1.25 1-2 2.729-2 4.5C2 14 4.686 16 8 16m0-1c-1.657 0-3-1-3-2.75 0-.75.25-2 1.25-3C6.125 10 7 10.5 7 10.5c-.375-1.25.5-3.25 2-3.5-.179 1-.25 2 1 3 .625.5 1 1.364 1 2.25C11 14 9.657 15 8 15"/>
                                          </svg>
                                    </a>
                                </li>

                                <li class="tab">
                                    <a href="#">
                                        best sellers
                                    </a>
                                </li>
                                <li class="tab">
                                    <a href="{{route('business.index')}}">
                                        business
                                    </a>
                                </li>
                                <li class="tab">
                                    <a href="#">
                                        new arrivals
                                    </a>
                                </li>
                                <li class="tab">
                                    <a href="#" class="flex gap-1 items-center">
                                        community
                                        <i class="bi bi-arrow-up-right"></i>
                                    </a>
                                </li>
                                <li class="more">
                                    <div class="toggler flex items-center gap-2">
                                        <i class="bi bi-list"></i>
                                        more
                                    </div>
                                </li>

                                <li class="more tab cursor-pointer">
                                    <div class="toggler flex items-center gap-2">
                                        <i class="bi bi-list"></i>
                                        categories
                                    </div>
                                </li>
                            </ul>

                        </div>
                    </div>
                </nav>
            @endif
        </div>
        {{ $slot }}
    </div>
</body>

</html>

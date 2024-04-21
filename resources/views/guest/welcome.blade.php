<x-guest-layout>

    <x-slot:header>
        <nav class="navbar w-full h-32 bg-black flex justify-between items-center lg:px-8">
            <div class="brand h-full">
                <div class="toggler w-14 h-full" hidden>
                </div>
                <div class="logo-container h-full mx-2 overflow-hidden">
                    <a href="#" class="h-full inline-flex">
                        <img class="h-full scale-125" src="{{ asset('assets/images/logo.svg') }}" alt="logo">
                    </a>
                </div>
            </div>

            <div class="nav-info flex flex-col w-full h-full">
                <div class="top-nav w-full h-1/2  flex justify-between items-center">
                    {{-- befre the search bar --}}
                    <div class="before px-4 gap-6 flex items-center h-full">
                        <div class="shopping-cart relative">
                            <div class="toggler text-center cursor-pointer">
                                <i class="bi bi-cart3 text-2xl text-primary cursor-pointer"></i>
                                <span class="block text-md font-semibold tracking-wide py-1 text-primary">
                                    shopping cart
                                </span>
                            </div>
                            <div class="card-content-box" hidden>
                                
                            </div>
                        </div>
                        <div class="connection-box">
                            <div class="toggler text-center cursor-pointer">
                                <i class="bi bi-person text-2xl text-primary cursor-pointer"></i>
                                <span class="block text-md font-semibold tracking-wide py-1 text-primary">
                                    my Account
                                </span>
                            </div>
                            <div class="connection-box" hidden>
    
                            </div>
                        </div>
                    </div>

                    {{-- srearch bar : aliexpress like --}}
                    <div class="form-search relative py-2 h-full w-7/12">
                        <div class="wrapper w-full mt-2 h-full rounded-lg relative bg-white">
                            <form action="" class="h-full w-full">
                                <input class="w-full h-full bg-transparent border-none outline-none focus:ring-0
                                    " type="text" name="query" id="query" placeholder="search..." aria-autocomplete="both">
                                <div class="absolute right-0 top-0 w-20 py-1 pr-1 pl-2 h-full">
                                    <button class="btn w-full h-full text-white rounded-lg flex items-center justify-center
                                     bg-black" type="button">
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
                                <i class="bi bi-globe text-2xl text-primary"></i>
                                <span class="text-lg text-primary block">
                                    {{ app()->getLocale() }}
                                </span>
                            </div>
                            <div class="language-dropdown" hidden>
    
                            </div>
                        </div>
    
                        <div class="assistance-box">
                            <div class="toggler text-center">
                                <i class="bi bi-headset text-xl text-primary"></i>
                                <span class="block text-primary">
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
                    <ul class="w-full h-full flex gap-6 items-center text-white uppercase navlist-black">
                        <li class="tab">
                            <a href="#" class="text-red-400 font-bold">
                                supper deals
                            </a>
                        </li>

                        <li class="tab">
                            <a href="#">
                                best sellers
                            </a>
                        </li>
                        <li class="tab">
                            <a href="#">
                                famous markets
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
    </x-slot:header>
    {{-- header that contains pictures about ur site --}}
    <x-guest.landing.header/>

    <x-guest.landing.categories/>

    <x-main.footer/>


</x-guest-layout>
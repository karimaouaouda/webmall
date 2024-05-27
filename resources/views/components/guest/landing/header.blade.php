<header class="w-full px-6 h-[calc(100vh-8rem)] flex">
    <div class="w-72 px-2 py-4 flex items-center h-full ">
        <div class="connection h-full flex flex-col justify-around items-center p-2 rounded-lg bg-slate-100 shadow w-full flex-1">
            <h1 class="font-bold uppercase px-4 text-center py-2 text-sky-700">
                Create your <span class="p-1 bg-sky-500 rounded-md text-white">Account</span> and Start !
            </h1>
            <div class="auths w-full flex justify-around items-center my-2">
                <a href="#">
                    <i class="bi bi-google w-10 h-10 rounded-full border border-slate-500 shadow-sm
                        hover:bg-slate-400 text-sky-500 flex items-center justify-center hover:bg-opacity-30 animation-300 "></i>
                </a>
                <a href="#">
                    <i class="bi bi-facebook text-lg w-10 h-10 rounded-full border border-slate-500 shadow-sm
                        hover:bg-slate-400 text-sky-700 flex items-center justify-center hover:bg-opacity-30 animation-300 "></i>
                </a>

                <a href="#">
                    <i class="bi bi-twitter text-lg w-10 h-10 rounded-full border border-slate-500 shadow-sm
                        hover:bg-slate-400 text-sky-700 flex items-center justify-center hover:bg-opacity-30 animation-300 "></i>
                </a>
            </div>

            <div class="my-6 h-px w-full bg-slate-300 flex justify-center items-center relative">
                <span class="block bg-slate-100 px-2 py-1">
                    or
                </span>
            </div>
            <h6 class="w-fill text-sm text-center text-slate-700 font-bold uppercase">
                use email
            </h6>
            <div class="email w-full flex flex-col gap-5 mt-4">
                <div class="inpt rounded-lg overflow-hidden shadow-xs w-full h-12 flex border">
                    <i class="bi bi-envelope text-sky-700 p-2 text-lg"></i>
                    <input type="text" placeholder="example@mail.com" class="flex-1 h-full focus:ring-0 border-none bg-transparent outline-none">
                </div>

                <button class="px-4 py-2 text-white bg-slate-800 hover:bg-black animation-300 rounded-md ">
                    continue with email <i class="bi bi-arrow-right"></i>
                </button>
            </div>

            <div class="text-center w-full my-2">
                <a href="#" class="hover:underline text-sky-500">
                    or login to your account
                </a>
            </div>
        </div>
    </div>

    <div class="p-4 flex-1 flex flex-wrap gap-3 h-full ">
        <div class="bg-slate-200 flex-1 h-full shadow-md rounded-lg">
            <h1 class="w-full px-2 text-red-500 font-extrabold tracking-wider text-4xl
                pt-4 uppercase text-center"> 
                Welcome Deals 
                {{--<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-fire scale-150" viewBox="0 0 16 16">
                    <path d="M8 16c3.314 0 6-2 6-5.5 0-1.5-.5-4-2.5-6 .25 1.5-1.25 2-1.25 2C11 4 9 .5 6 0c.357 2 .5 4-2 6-1.25 1-2 2.729-2 4.5C2 14 4.686 16 8 16m0-1c-1.657 0-3-1-3-2.75 0-.75.25-2 1.25-3C6.125 10 7 10.5 7 10.5c-.375-1.25.5-3.25 2-3.5-.179 1-.25 2 1 3 .625.5 1 1.364 1 2.25C11 14 9.657 15 8 15"/>
                  </svg>--}}
            </h1>
            <h5 class="uppercase text-red-500 text-xl font-bold text-center  ">
                just for you
            </h5>

            <div class="deals w-full mt-4 px-10 ">
                <div x-data="{}" class="carousel w-full border  relative">
                    <div class="renderer relative mx-auto overflow-hidden w-3/5 h-72 bg-slate-300 shadow-md rounded-xl">
                        <a href="#" class="w-full h-full block">
                            <img class="w-full h-full" src="{{ asset('assets/images/landing/pic.webp') }}" alt="">
                            <div class="price-brand absolute w-full items-center flex justify-center gap-1 bg-white h-10 bottom-7">
                                <span class="text-red-500 font-extrabold">
                                    255.20 DA
                                </span>
                                <span class="align-bottom line-through font-bold">
                                    <sub>350.20 DA</sub>
                                </span>
                            </div>
                        </a>
                        <a href="#" class="w-full h-full block">
                            <img class="w-full h-full" src="{{ asset('assets/images/landing/pic.webp') }}" alt="">
                            <div class="price-brand absolute w-full items-center flex justify-center gap-1 bg-white h-10 bottom-7">
                                <span class="text-red-500 font-extrabold">
                                    255.20 DA
                                </span>
                                <span class="align-bottom line-through font-bold">
                                    <sub>350.20 DA</sub>
                                </span>
                            </div>
                        </a>
                        <a href="#" class="w-full h-full block">
                            <img class="w-full h-full" src="{{ asset('assets/images/landing/pic.webp') }}" alt="">
                            <div class="price-brand absolute w-full items-center flex justify-center gap-1 bg-white h-10 bottom-7">
                                <span class="text-red-500 font-extrabold">
                                    255.20 DA
                                </span>
                                <span class="align-bottom line-through font-bold">
                                    <sub>350.20 DA</sub>
                                </span>
                            </div>
                        </a>
                    </div>
                    <button class="w-8 h-8 rounded-full bg-transparent hover:bg-slate-300 hover:bg-opacity-40
                        animation-300 absolute top-1/2 -translate-y-4 translate-x-4 flex items-center justify-center left-0">
                        <i class="bi bi-chevron-left"></i>
                    </button>
                    <button class="w-8 h-8 rounded-full bg-transparent hover:bg-slate-300 hover:bg-opacity-40
                        animation-300 absolute top-1/2 -translate-y-4 -translate-x-4 flex items-center justify-center right-0">
                        <i class="bi bi-chevron-right"></i>
                    </button>
                </div>
            </div>
        </div>
        <div class="bg-slate-200 flex-1 h-full shadow-md rounded-lg">
            <h1 class="w-full px-2 text-red-500 font-extrabold tracking-wider text-4xl
                pt-4 uppercase text-center flex itels-center justify-center"> 
                Supper Deals
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-fire scale-150" viewBox="0 0 16 16">
                    <path d="M8 16c3.314 0 6-2 6-5.5 0-1.5-.5-4-2.5-6 .25 1.5-1.25 2-1.25 2C11 4 9 .5 6 0c.357 2 .5 4-2 6-1.25 1-2 2.729-2 4.5C2 14 4.686 16 8 16m0-1c-1.657 0-3-1-3-2.75 0-.75.25-2 1.25-3C6.125 10 7 10.5 7 10.5c-.375-1.25.5-3.25 2-3.5-.179 1-.25 2 1 3 .625.5 1 1.364 1 2.25C11 14 9.657 15 8 15"/>
                  </svg>
            </h1>
            <h5 class="uppercase text-red-500 text-xl font-bold text-center  ">
                just for you
            </h5>

            <div class="deals w-full mt-4 px-10 ">
                <div x-data="{}" class="carousel w-full border  relative">
                    <div class="renderer relative mx-auto overflow-hidden w-3/5 h-72 bg-slate-300 shadow-md rounded-xl">
                        <a href="#" class="w-full h-full block">
                            <img class="w-full h-full" src="{{ asset('assets/images/landing/pic.webp') }}" alt="">
                            <div class="price-brand absolute w-full items-center flex justify-center gap-1 bg-white h-10 bottom-7">
                                <span class="text-red-500 font-extrabold">
                                    255.20 DA
                                </span>
                                <span class="align-bottom line-through font-bold">
                                    <sub>350.20 DA</sub>
                                </span>
                            </div>
                        </a>
                        <a href="#" class="w-full h-full block">
                            <img class="w-full h-full" src="{{ asset('assets/images/landing/pic.webp') }}" alt="">
                            <div class="price-brand absolute w-full items-center flex justify-center gap-1 bg-white h-10 bottom-7">
                                <span class="text-red-500 font-extrabold">
                                    255.20 DA
                                </span>
                                <span class="align-bottom line-through font-bold">
                                    <sub>350.20 DA</sub>
                                </span>
                            </div>
                        </a>
                        <a href="#" class="w-full h-full block">
                            <img class="w-full h-full" src="{{ asset('assets/images/landing/pic.webp') }}" alt="">
                            <div class="price-brand absolute w-full items-center flex justify-center gap-1 bg-white h-10 bottom-7">
                                <span class="text-red-500 font-extrabold">
                                    255.20 DA
                                </span>
                                <span class="align-bottom line-through font-bold">
                                    <sub>350.20 DA</sub>
                                </span>
                            </div>
                        </a>
                    </div>
                    <button class="w-8 h-8 rounded-full bg-transparent hover:bg-slate-300 hover:bg-opacity-40
                        animation-300 absolute top-1/2 -translate-y-4 translate-x-4 flex items-center justify-center left-0">
                        <i class="bi bi-chevron-left"></i>
                    </button>
                    <button class="w-8 h-8 rounded-full bg-transparent hover:bg-slate-300 hover:bg-opacity-40
                        animation-300 absolute top-1/2 -translate-y-4 -translate-x-4 flex items-center justify-center right-0">
                        <i class="bi bi-chevron-right"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
    
</header>

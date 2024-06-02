<x-guest-layout include-navbar="true">
    <div x-data="payData" x-init="subTotal()" data-items="{{ json_encode($products) }}"
        class="grid sm:px-10 lg:grid-cols-2 lg:px-20 xl:px-32">
        <div class="px-4 pt-8">
            <p class="text-xl font-medium">Order Summary</p>
            <p class="text-gray-400">Check your items. And select a suitable shipping method.</p>
            <div class="mt-8 space-y-3 rounded-lg border bg-white px-2 py-4 sm:px-6">
                <template x-if="items.length">
                    <template x-for="item in items">
                        <div x-data="productData"
                            :data-qte="item.pivot ? item.pivot.quantity : {{ request()->input('qte') ?? 4 }}"
                            x-init="product = item;
                            qte = item.pivot ? item.pivot.quantity : $el.dataset.qte" class="flex flex-col rounded-lg bg-white sm:flex-row">
                            <img class="m-2 h-24 w-28 rounded-md border object-contain object-center"
                                :src="'{{ asset('/storage') }}' + '/' + item.images[0]" alt="" />
                            <div class="flex w-full flex-col px-4 py-4">
                                <span class="font-semibold" x-text="item.slug"> </span>
                                <div class="float-right flex gap-2 items-center text-gray-400">
                                    <i @click="decreament()"
                                        class="bi bi-dash w-6 h-6 cursor-pointer animation-300 rounded-full border hover:bg-slate-200 border-gray-200 shadow text-xs flex items-center justify-center"></i>

                                    <span class="text-sm font-semibold " x-text="product.pivot.quantity"></span>

                                    <i @click="increament()"
                                        class="bi bi-plus w-6 h-6 cursor-pointer animation-300 rounded-full border hover:bg-slate-200 border-gray-200 shadow text-xs flex items-center justify-center"></i>
                                </div>
                                <div class="flex gap-3 items-center">
                                    <p class="text-lg font-bold text-red-500"
                                    x-text="((product.price * (1 - (product.solde / 100))) * product.pivot.quantity).toFixed(2) + ' DA'">
                                </p>
                                <sub>
                                    <span class="text-black line-through text-lg font-semibold" x-text="product.price * product.pivot.quantity + ' DA'">
                                            
                                    </span>
                                </sub>
                                </div>
                            </div>

                            <div @click="remove();subTotal()" class="w-6 h-6 rounded-full bg-red-300 my-auto shrink-0 cursor-pointer hover:bg-red-500 anmation-300 ">
                                <i class="bi bi-x text-white w-full h-full flex items-center justify-center"></i>
                            </div>
                        </div>
                    </template>
                </template>

                <template x-if="!items.length">
                    <h1 class="text-red-500 font-semibol text-center w-full py-2">
                        no product chosen
                    </h1>
                </template>
            </div>

            <p class="mt-8 text-lg font-medium">Shipping Methods</p>
            <form class="mt-5 grid gap-6">
                <div class="relative">
                    <input class="peer hidden" id="radio_1" type="radio" name="radio" checked />
                    <span
                        class="peer-checked:border-gray-700 absolute right-4 top-1/2 box-content block h-3 w-3 -translate-y-1/2 rounded-full border-8 border-gray-300 bg-white"></span>
                    <label
                        class="peer-checked:border-2 peer-checked:border-gray-700 peer-checked:bg-gray-50 flex cursor-pointer select-none rounded-lg border border-gray-300 p-4"
                        for="radio_1">
                        <img class="w-14 object-contain" src="/images/naorrAeygcJzX0SyNI4Y0.png" alt="" />
                        <div class="ml-5">
                            <span class="mt-2 font-semibold">Fedex Delivery</span>
                            <p class="text-slate-500 text-sm leading-6">Delivery: 2-4 Days</p>
                        </div>
                    </label>
                </div>
                <div class="relative">
                    <input class="peer hidden" id="radio_2" type="radio" name="radio" checked />
                    <span
                        class="peer-checked:border-gray-700 absolute right-4 top-1/2 box-content block h-3 w-3 -translate-y-1/2 rounded-full border-8 border-gray-300 bg-white"></span>
                    <label
                        class="peer-checked:border-2 peer-checked:border-gray-700 peer-checked:bg-gray-50 flex cursor-pointer select-none rounded-lg border border-gray-300 p-4"
                        for="radio_2">
                        <img class="w-14 object-contain" src="/images/oG8xsl3xsOkwkMsrLGKM4.png" alt="" />
                        <div class="ml-5">
                            <span class="mt-2 font-semibold">Fedex Delivery</span>
                            <p class="text-slate-500 text-sm leading-6">Delivery: 2-4 Days</p>
                        </div>
                    </label>
                </div>
            </form>
        </div>
        <div>

            <div class="flex mt-10 ml-2 items-center gap-2">
                <input type="checkbox" value="false" @change="useMyAdress=$el.checked">
                <span class="font-semibold text-black text-sm">
                    chose my profile payment Method
                </span>
            </div>

            <template x-if="!useMyAdress">
                <x-filament::section collapsible class="my-4 shadow">
                    <x-slot name="heading">
                        <p class="text-xl font-medium">Shipping Address</p>
                    </x-slot>

                    <x-slot name="description">
                        <p class="text-gray-400">
                            add you address that the order will be send to
                        </p>
                    </x-slot>

                    <div class="flex flex-col gap-3">
                        <div class="w-full py-1">
                            <div class="relative">
                                <input type="text" id="full_name" name="full_name"
                                    class="w-full rounded-md border border-gray-200 px-4 py-3 pl-11 text-sm uppercase shadow-sm outline-none focus:z-10 focus:border-blue-500 focus:ring-blue-500"
                                    placeholder="Your full name here" />
                                <div class="pointer-events-none h-full absolute top-0 left-0 flex items-center px-3">
                                    <i class="bi bi-person text-lg relative -top-1"></i>
                                </div>
                            </div>
                        </div>

                        <div class="w-full py-1">
                            <div class="relative">
                                <input type="number" id="phone_number" name="phone_number"
                                    class="w-full min-w-[200px] rounded-md border border-gray-200 px-4 py-3 pl-11 text-sm uppercase shadow-sm outline-none focus:z-10 focus:border-blue-500 focus:ring-blue-500"
                                    placeholder="Your phone number" />
                                <div class="pointer-events-none h-full absolute top-0 left-0 flex items-center px-3">
                                    <i class="bi bi-phone text-lg relative -top-1"></i>
                                </div>
                            </div>
                        </div>

                        <div class="w-full flex flex-wrap justify-between gap-2">


                            <div class="relative">
                                <input type="text" id="street_line" name="street_line"
                                    class="w-full min-w-[200px] rounded-md border border-gray-200 px-4 py-3 pl-11 text-sm uppercase shadow-sm outline-none focus:z-10 focus:border-blue-500 focus:ring-blue-500"
                                    placeholder="city" />
                                <div class="pointer-events-none h-full absolute top-0 left-0 flex items-center px-3">
                                    <i class="bi bi-signpost-split text-lg relative -top-1"></i>
                                </div>
                            </div>

                            <div class="relative">
                                <input type="text" id="city" name="city"
                                    class="w-full min-w-[200px] rounded-md border border-gray-200 px-4 py-3 pl-11 text-sm uppercase shadow-sm outline-none focus:z-10 focus:border-blue-500 focus:ring-blue-500"
                                    placeholder="Your full name here" />
                                <div class="pointer-events-none h-full absolute top-0 left-0 flex items-center px-3">
                                    <i class="bi bi-signpost-split text-lg relative -top-1"></i>
                                </div>
                            </div>


                            <div class="relative">
                                <input type="text" id="province" name="province"
                                    class="w-full min-w-[200px] rounded-md border border-gray-200 px-4 py-3 pl-11 text-sm uppercase shadow-sm outline-none focus:z-10 focus:border-blue-500 focus:ring-blue-500"
                                    placeholder="Your full name here" />
                                <div class="pointer-events-none h-full absolute top-0 left-0 flex items-center px-3">
                                    <i class="bi bi-mailbox text-lg relative -top-1"></i>
                                </div>
                            </div>
                        </div>
                    </div>


                </x-filament::section>
            </template>


            <div class="flex mt-10 ml-2 items-center gap-2">
                <input type="checkbox" value="false" @change="useMyPay=$el.checked">
                <span class="font-semibold text-black text-sm">
                    chose my profile address
                </span>
            </div>


            <template x-if="!useMyPay">
                <x-filament::section collapsible class="my-4 shadow">
                    <x-slot name="heading">
                        <p class="text-xl font-medium">Payment Details</p>
                    </x-slot>

                    <x-slot name="description">
                        <p class="text-gray-400">Complete your order by providing your payment details.</p>
                    </x-slot>
                    <div class="bg-gray-50 px-4 pt-2 lg:mt-0">


                        <div class="">
                            <label for="card-holder" class="mt-4 mb-2 block text-sm font-medium">Card Holder</label>
                            <div class="relative">
                                <input type="text" id="card_owner" name="card_owner"
                                    class="w-full rounded-md border border-gray-200 px-4 py-3 pl-11 text-sm uppercase shadow-sm outline-none focus:z-10 focus:border-blue-500 focus:ring-blue-500"
                                    placeholder="Your full name here" />
                                    <i class="bi bi-person absolute h-full flex items-center px-3 top-0 text-lg"></i>
                            </div>
                            <label for="card-no" class="mt-4 mb-2 block text-sm font-medium">Card Details</label>
                            <div class="flex">
                                <div class="relative w-7/12 flex-shrink-0">
                                    <input type="text" id="card_number" name="card_number"
                                        class="w-full rounded-md border border-gray-200 px-2 py-3 pl-11 text-sm shadow-sm outline-none focus:z-10 focus:border-blue-500 focus:ring-blue-500"
                                        placeholder="xxxx-xxxx-xxxx-xxxx" />
                                    <i class="bi bi-credit-card absolute h-full flex items-center px-3 top-0 text-lg"></i>
                                </div>
                                <input type="text" name="card_expire_at"
                                    class="w-full rounded-md border border-gray-200 px-2 py-3 text-sm shadow-sm outline-none focus:z-10 focus:border-blue-500 focus:ring-blue-500"
                                    placeholder="MM/YY" />
                                <input type="text" name="card_cvc"
                                    class="w-1/6 flex-shrink-0 rounded-md border border-gray-200 px-2 py-3 text-sm shadow-sm outline-none focus:z-10 focus:border-blue-500 focus:ring-blue-500"
                                    placeholder="CVC" />
                            </div>
                        </div>
                </x-filament::section>
            </template>
            <!-- Total -->
            <div class="mt-6 border-t border-b py-2">
                <div class="flex items-center justify-between">
                    <p class="text-sm font-medium text-gray-900">Subtotal</p>
                    <div class="flex items-center gap-1">
                        <sup>
                            <p class="font-semibold text-black text-md line-through" x-text="sub_total_without_sold">

                            </p>
                        </sup>
                        <p class="font-bold text-red-500" x-text="sub_total + 'DA'"></p>
                        
                        
                    </div>
                </div>
                <div class="flex items-center justify-between">
                    <p class="text-sm font-medium text-gray-900">Shipping</p>
                    <p class="font-semibold text-gray-900" x-text="shipping + ' DA'"></p>
                </div>
            </div>
            <div class="mt-6 flex items-center justify-between">
                <p class="text-sm font-medium text-gray-900">Total</p>
                <p class="text-2xl font-semibold text-gray-900" x-text="(sub_total + shipping).toFixed(2) + ' DA'"></p>
            </div>
            <button id="paymentButton" data-src="{{ request()->input('source') }}" @click="pay()" 
                class="mt-4 mb-8 w-full rounded-md bg-black px-6 py-3 font-medium text-white">Place
                Order</button>
        </div>
    </div>

    @vite('resources/js/shopping/cart.js')
    @vite('resources/js/shopping/pay.js')
    @vite('resources/js/alpine.js')
</x-guest-layout>

<x-guest-layout include-navbar="true">
    {{-- header that contains pictures about ur site --}}
    <x-guest.landing.header :welcome-deals="$welcomeDeals" :super-deals="$superDeals"/>

    <x-guest.landing.categories  :shops="$shops" :products="$products"/>

    <x-main.footer/>


    @vite('resources/js/shopping/cart.js')
    @vite('resources/js/alpine.js')


</x-guest-layout>

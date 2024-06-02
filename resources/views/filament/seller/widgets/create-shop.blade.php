<x-filament-widgets::widget>
    <x-filament::section>

        <div class="w-full flex flex-col gap-2 text-center">
            <i class="bi bi-shop text-5xl text-sky-600"></i>
            <h1 class="w-full tracking-wide  text-2xl font-extrabold text-slate-800 uppercase">
                create your shop now!
            </h1>

            <h4 class="capitalize font-semibold text-md lg:w-92">
                bring your shop to the internet world ,and take advantage of many feautures
                including products management, stock managment, opinions, followers, and many more ...
            </h4>

            <div class="steps-container">
                <div class="title py-4">
                    <h4 class="capitalize text-sky-600 font-bold text-left my-4 text-md px-10">
                        follow these steps to create your shop : 
                    </h4>
                </div>

                <div class="w-full steps mx-auto steps w-full flex flex-col gap-3">
                    <x-parts.step :completed="$seller->hasAddress()" icon="house" action="https://seller.webmall.test/dashboard/settings#address">
                        <x-slot:title> 
                            add your address to your account
                        </x-slot:title>

                        <x-slot:description>
                            in cases like we sent you gifts or send some envelops we need your home address, 
                            we don't share this information to any one except wen and you
                        </x-slot:description>
                    </x-parts.step>

                    <x-parts.step :completed="$seller->hasVerifiedID()" icon="person-bounding-box" action="https://seller.webmall.test/dashboard/settings#id">
                        <x-slot:title> 
                            {{ $seller->shop->document->status == 'processing' ? 'we are procesing your identity' : 'verify your identity'  }}
                        </x-slot:title>

                        <x-slot:description>
                            @if( $seller->shop->document->status == 'processing' )
                                after we give you the result you will find this as completed
                            @else
                            in order to create your shop you must verify your identity to ensure you are eligible for have business,
                            don't worry, any document you share with us will be deletted after 30 days of processing, and will be secretly stored
                            @endif
                        </x-slot:description>
                    </x-parts.step>

                    <x-parts.step :completed="$seller->has_shop" icon="shop" action="https://seller.webmall.test/dashboard/shops/create">
                        <x-slot:title> 
                            setup your business information
                        </x-slot:title>

                        <x-slot:description>
                            setup your business information from name, brand, unique name, this information will be displayed to clients when enter to your shop profile
                        </x-slot:description>
                    </x-parts.step>

                    <x-parts.step :completed="false" icon="file-earmark-arrow-up" action="https://seller.webmall.test/dashboard/shops/{{$seller->has_shop ? $seller->shop->id : ''}}/verify">
                        <x-slot:title> 
                            upload business documents
                        </x-slot:title>

                        <x-slot:description>
                            last, step is upload business documents to assure that you have a shop and prodducts and ensure that you are not scammer
                        </x-slot:description>
                    </x-parts.step>
                </div>
            </div>
        </div>

    </x-filament::section>
</x-filament-widgets::widget>

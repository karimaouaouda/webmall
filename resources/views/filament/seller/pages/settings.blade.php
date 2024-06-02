<x-filament-panels::page>
    <x-filament::section id="address" icon="heroicon-o-home" collapsible>
        <form action="{{ route('seller.address.update') }}" method="POST">
            @csrf

            @if ($errors->any())
                <div class="flex flex-col text-center w-full gap-3">
                    @foreach ($errors->all() as $error)
                        <div class="text-red-500 font-semibold">
                            - {{ $error }}
                        </div>
                    @endforeach
                </div>
            @endif
            <input required type="text" name="next_url"
                value="{{ request()->get('next_url') ?? base64_encode(request()->url()) }}" hidden>
            <x-slot name="heading">
                Adress
            </x-slot>
            <x-slot name="description">
                we need your adress to send gifts, envelops ...
            </x-slot>

            <x-filament::input.wrapper class="min-w-[300px] flex-1 my-2">
                <x-filament::input name="country" placeholder="country" type="text" wire:model="country"
                    value="algeria" readonly required />
            </x-filament::input.wrapper>

            <div class="w-full flex gap-4 flex-wrap">
                <x-filament::input.wrapper class="min-w-[300px] flex-1 my-2">
                    <x-filament::input value="{{ $seller->address->city }}" name="city" placeholder="city" type="text"
                        wire:model="city" required />
                </x-filament::input.wrapper>

                <x-filament::input.wrapper class="min-w-[300px] flex-1 my-2">
                    <x-filament::input value="{{ $seller->address->province }}" name="province" placeholder="province"
                        type="text" wire:model="province" required />
                </x-filament::input.wrapper>

                <x-filament::input.wrapper class="min-w-40 flex-1 my-2">
                    <x-filament::input value="{{ $seller->address->postal_code }}" name="postal_code" placeholder="postal_code"
                        type="number" wire:model="postal code" required />
                </x-filament::input.wrapper>
            </div>
            <x-filament::input.wrapper class=" flex-1 my-2">
                <x-filament::input value="{{ $seller->address->street_line }}" name="street_line" placeholder="street line"
                    type="text" wire:model="street_line" required />
            </x-filament::input.wrapper>

            <button class="btn bg-slate-700 text-white rounded-lg my-2 float-right">
                save
            </button>
        </form>
    </x-filament::section>

    <x-filament::section id="id" icon="heroicon-o-home" collapsible>
        <x-slot name="heading">
            verify your id
        </x-slot>
        <x-slot name="description">
            verify your identity with upload documents
        </x-slot>

        <!-- component -->
        @if( $seller->hasVerifiedID() )
            <div class="w-full py-4 text-center text-2xl text-sky-500">
                <div class="badge bg-green-500 text-white">
                    <i class="bi bi-patch-check text-xl mx-2"></i>
                    you verify your ID
                </div>
            </div>
        @else
            
            @if( $seller->identity != null && $seller->identity->status  == 'processing' )
            <div class="w-full py-4 text-center text-2xl text-sky-500">
                <i class="bi bi-stop-watch mx-2"></i>
                our team is verifying your id
            </div>
            @else
            <form enctype="multipart/form-data" action="{{ route('seller.identity.upload') }}" method="post" x-data="{uploaded : false, name : 'ID Card Image'}" class="flex flex-col gap-4 py-4 items-center justify-center bg-gray-100 font-sans">
                @csrf
                <div @click="$el.querySelector('#id_card').click()"
                    class="mx-auto cursor-pointer flex w-full max-w-lg flex-col items-center rounded-xl border-2 border-dashed border-blue-400 bg-white p-6 text-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-blue-500" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                    </svg>
    
                    <h2 class="mt-4 text-xl font-medium text-gray-700 tracking-wide" x-text="name"></h2>
    
                    <p class="mt-2 text-gray-500 tracking-wide" x-show="!uploaded">Upload or darg & drop your file PNG or JPG. </p>
    
                    <input @change="uploaded = $el.files.length > 0;name = uploaded ? $el.files[0].name : 'ID Card Image' " name="id_card" id="id_card" type="file" class="hidden" />
                </div>
    
    
                <button class="btn bg-slate-600 text-white hover:bg-slate-700 rounded-lg">
                    save
                </button>
            </form>
            @endif

        @endif

        @vite('resources/js/alpine.js')

    </x-filament::section>
</x-filament-panels::page>

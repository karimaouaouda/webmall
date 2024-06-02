<x-filament-panels::page>

    <x-filament::section>
        <x-slot name="heading">
            shop information
        </x-slot>

        <x-slot name="description">
            this information will be displayed to the any one in application
        </x-slot>

        <div class="w-full flex flex-col gap-3">

            <div class="input-box relative w-full">
                <div class="h-10 has-[input:focus]:border-sky-500 relative w-full border bg-red-500 rounded-lg overflow-hidden">
                    <input type="text" class="absolute w-full h-full px-2 border-none outline-none " placeholder="shop unique name">
                </div>
            </div>

            <x-filament:editor></x-filament:editor>

            <div class="input-box relative w-full">
                <div class="h-10 has-[input:focus]:border-sky-500 relative w-full border bg-red-500 rounded-lg overflow-hidden">
                    <input type="text" class="absolute w-full h-full px-2 border-none outline-none " placeholder="shop unique name">
                </div>
            </div>

        </div>
    </x-filament::section>

</x-filament-panels::page>

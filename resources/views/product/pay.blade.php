<x-guest-layout include-navbar="true">

    <div class="w-full px-20 my-10 flex justify-center items-center">
        <form action="{{ route('command.pay', ['product' => $product->id]) }}" method="POST">
            @csrf
            
            <button type="submit" class="px-4 py-2 bg-slate-500 hover:bg-slate-600 duration-300
                ease-in-out text-xl font-semibold uppercase text-white">
                pay now
            </button>
        </form>
    </div>

</x-guest-layout>
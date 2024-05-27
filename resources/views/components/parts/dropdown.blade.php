<div x-data="{{ $datac }}" class="shopping-cart relative z-50">
    <div @click="show=!show" class="toggler text-center cursor-pointer">
        <i class="bi bi-{{ $icon }} text-lg text-slate-700 cursor-pointer"></i>
        <span class="block text-sm font-normal tracking-wide py-1 text-slate-700">
            {{ $label }}
        </span>
    </div>
    <div x-show="show" x-transition class="card-content-box absolute rounded-lg  {{ $width }} p-2 bg-slate-100 shadow-lg border border-gray-500">
        <h1 class="header w-full py-2">
            {{ $header }}
        </h1>

        {{ $slot }}

        

        <div class="my-4 w-full text-center">
            {{$footer}}
        </div>
    </div>

    
</div>
<div class="my-2 p-4 flex justify-between flex-col md:flex-row gap-3 border rounded-lg bg-slate-200 shadow items-center  ">
    <div class="flex gap-3 flex-wrap justify-center">
        <div class="min-w-[4rem] h-16 basis-16 flex items-center justify-center text-lg font-bold {{ $getClasses($completed) }} rounded-full">
            @if($completed)
                <i class="bi bi-check2 text-2xl"></i>
            @else
            <i class="bi bi-{{ $icon }} text-2xl"></i>
            @endif
        </div>
        <div class="text-center md:text-left min-w-[300px] items-center">
            <div class="flex flex-col justify-around">
                <h1 class="uppercase font-bold text-lg tracking-wide">
                    {{ $title }}
                </h1>
                <h4 class="font-normal text-sm  lg:max-w-[500px] first-line:pl-4">
                    {{ $description }}
                </h4>
            </div>
        </div>
    </div>

    @if($completed)
    <a href="javascript:void(0)" class="btn h-fit block text-sm whitespace-nowrap bg-sky-400 text-white uppercase">
        completed <i class="bi bi-check2 mx-2"></i>
    </a>
    @else
    <a href="{{ $action ?? '/' }}" class="btn h-fit block text-sm whitespace-nowrap bg-sky-500 text-white uppercase">
        complete now <i class="bi bi-box-arrow-up-right mx-2"></i>
    </a> 
    @endif
</div>
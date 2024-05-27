<div class="w-full py-2 flex flex-col gap-2 ">
    @foreach($list['items'] as $item)
        <div class="w-full bg-slate-100 hover:bg-slate-200 duration-300 ease-in-out">
            <a href="{{ $item['url'] }}" class="p-2 block rounded-md w-full h-full">
                <i class="bi bi-{{ $item['icon'] }} text-md"></i>
                <span class="capitalize text-md">
                    {{ $item['label'] }}
                </span>
            </a>
        </div>
    @endforeach
</div>
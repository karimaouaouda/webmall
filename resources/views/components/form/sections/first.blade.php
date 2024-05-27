<div class="section w-full lg:w-4/5 bg-{{ $bg  }} rounded-lg p-2">
    <div class="section-header border-b py-2">
        <h1 class="text-{{ $headerTextColor  }} font-semibold text-xl">
            {{ $header  }}
        </h1>
    </div>
    <div class="inputs my-2 p-4 flex flex-col gap-4">
        {{ $slot  }}
    </div>
</div>

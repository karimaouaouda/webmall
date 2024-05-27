<div
    class="input h-14 w-full lg:w-4/5 relative">

    <div
        x-data="{filename : 'no file uploaded'}"
        class="inner w-full h-full flex justify-start items-ceter gap-4">

        <input
            @change="filename = document.querySelector('#{{ $name  }}').files.length > 0 ? document.querySelector('#{{ $name  }}').files[0].name : 'no file uploaded yet'"
            type="file"
            name="{{$name}}" class="hidden" id="{{$name}}">
        <button @click="document.querySelector('#{{ $name }}').click();" type="button" class="button p-2 border bg-sky-500 w-fit rounded-lg hover:scale-105
                                         ease-in-out duration-300 cursor-pointer">
            <i class="bi bi-{{ $icon  }} text-2xl mr-1 drop-shadow-md shadow text-white"></i>
        </button>
        <div class="h-full flex flex-col items-start justify-between py-1">
                                        <span class="text-sm font-semibold tracking-wide capitalize">
                                            {{$label}}
                                        </span>
            <span class="text-sm font-normal text-gray-500" x-text="filename">

                                        </span>
        </div>
    </div>
</div>

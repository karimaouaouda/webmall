<div class="input bg-slate-100 h-12 w-full lg:w-4/5 relative">
    <div x-data="{focus : false, val : '{{old($name)}}'}"
         class="inner-input w-full h-full relative rounded-md border shadow ">

        <input
            name="{{ $name  }}"
            x-model="val"
            @focus="focus=true"
            :class="{'border-sky-500 border' : focus}"
            @blur="focus = false" type="text"
            class="w-full h-full px-4 hover:border-none outline-none"/>

        <span :class="{
                        '-top-2 h-4 px-1 inline text-sm left-0 text-sky-600' : focus || val.trim() != '',
                        'w-full px-2 h-full block top-0 left-0' : !focus }"
              class="absolute duration-300 ease-in-out bg-white pointer-events-none flex items-center justify-start  text-gray-400
                                        ">

                <i class="bi bi-{{$icon}} mr-1"></i> {{$label}}
        </span>
    </div>
</div>

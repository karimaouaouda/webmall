@switch($n)
    @case(1)
        <div class="flex flex-1 min-w-[250px] relative">
            <input id="{{$id}}" type="{{ $type }}" placeholder="{{ $ph }}" name="{{ $name }}"
                value="{{ $value }}"
                class="flex w-full px-3 py-2 md:px-4 md:py-3 border-2 border-black rounded-lg font-medium placeholder:font-normal" />

            @if($type == "password")
            <i id="eye" data-target="#{{$id}}" class="bi bi-eye absolute right-0 w-14 h-full flex items-center justify-center cursor-pointer"></i>
            <script>
                document.querySelectorAll(".bi-eye").forEach(eye =>{
                    eye.onclick = () => {
                        let type = document.querySelector(`${eye.dataset.target}`).type

                        document.querySelector(eye.dataset.target).type = type == "password" ? "text" : "password"
                    }
                })
            </script>
            @endif

        </div>
    @break

    @default
        <p>
            error was occred
        </p>
@endswitch

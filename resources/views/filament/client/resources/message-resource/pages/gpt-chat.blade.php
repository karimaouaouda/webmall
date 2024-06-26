<x-filament-panels::page>
    <section  class="w-full border-black border max-h-screen flex justify-between flex-col items-center mx-auto ">
        <input id="_token" class="hidden" value="{{ csrf_token() }}" />

        <div id="data" data-json='{
                    "profile_photo_url" : "{{ auth('client')->user()->profile_photo_url  }}",
                    "ai_pic" : "{{asset('/ai1.jfif')}}"}'></div>

        <div id="messages" class="messages-box h-[calc(100vh-8rem)] gap-2  w-full
                overflow-auto py-2">
            <div class="start-discussion px-20 pt-4">
                {{-- <div class="w-full h-40 bg-slate-200">

                </div> --}}
            </div>

            @foreach ($messages as $message)

                <div class="message-wrapper">
                    <div class="message flex relative gap-2" x-data="{'content' : '{{$message->content}}'}">
                        <div class="chat-pic h-10 w-10 rounded-full overflow-hidden border-sky-500 border-2">
                            <img src="{{ cache('profile_picture') ?? auth('client')->user()->profile_photo_url }}" class="w-full h-full" alt="">
                        </div>
                        <div class="message-content h-fit bg-blue-700 text-white p-2 rounded-md relative top-2 max-w-[400px]">
                            <p>
                                {{ $message->content }}
                            </p>
                            <button class="float-right" x-data="listenButtonData" @click="listen">
                                <i class="bi bi-headphones hover:bg-slate-200 hover:bg-opacity-30 rounded-full flex items-center justify-center w-6 h-6"></i>
                            </button>
                        </div>
                        <div x-data="{open : false}" class="dropdown relative top-2 text-white text-xl cursor-pointer">
                            <i @click="open = !open" class="toggler bi bi-three-dots-vertical"></i>
                            <div x-transition x-show="open" class="menu absolute top-6 left-2 h-auto bg-slate-100 overflow-hidden py-2 rounded-md z-50">
                                <ul class="text-black text-sm font-semibold flex flex-col gap-1">
                                    <li class="hover:bg-slate-200 whitespace-nowrap p-1">
                                        <a href="#" class="w-full h-full">copy</a>
                                    </li>
                                    <li class="hover:bg-slate-200 whitespace-nowrap p-1">
                                        <a href="#" class="w-full h-full">edit & resend</a>
                                    </li>
                                    <li class="hover:bg-slate-200 whitespace-nowrap p-1">
                                        <a href="#" class="w-full h-full">copy</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="message-wrapper">
                    <div class="message flex flex-row-reverse relative gap-2" x-data="{'content' : '{{ $message->gpt_response }}'}">
                        <div class="chat-pic h-10 w-10 rounded-full overflow-hidden border-sky-500  border-2">
                            <img src="{{cache('ai_profile_picture')  ?? asset('ai1.jfif')}}" class="w-full h-full" alt="">
                        </div>
                        <div class="message-content h-fit bg-gray-300 p-2 rounded-md relative top-2 max-w-[400px]">
                            <p>
                                {{ $message->gpt_response }}
                            </p>
                            <button class="float-right" x-data="listenButtonData" @click="listen">
                                <i class="bi bi-headphones hover:bg-slate-200 hover:bg-opacity-30 rounded-full flex items-center justify-center w-6 h-6"></i>
                            </button>

                        </div>
                        <div x-data="{open : false}" class="dropdown relative top-2 text-white text-xl cursor-pointer">
                            <i @click="open = !open" class="toggler bi bi-three-dots-vertical"></i>
                            <div x-transition x-show="open" class="menu absolute top-6 left-2 h-auto bg-slate-100 overflow-hidden py-2 rounded-md z-50">
                                <ul class="text-black text-sm font-semibold flex flex-col gap-1">
                                    <li class="hover:bg-slate-200 whitespace-nowrap p-1">
                                        <a href="#" class="w-full h-full">copy</a>
                                    </li>
                                    <li class="hover:bg-slate-200 whitespace-nowrap p-1">
                                        <a href="#" class="w-full h-full">edit & resend</a>
                                    </li>
                                    <li class="hover:bg-slate-200 whitespace-nowrap p-1">
                                        <a href="#" class="w-full h-full">copy</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

            @endforeach


        </div>

        <div x-data="formData" class="form h-16 flex items-center justify-around border border-slate-700 bg-slate-200 py-2 w-full">
            <i @click="isRecording ? stopRecord() : record()" id="mic" class="bi bi-mic w-14 flex items-center justify-center text-xl hover:text-sky-700 cursor-pointer"></i>
            <select name="" id="mic-select" hidden></select>
            <span id="progress"></span>
            <div class="inner-form w-full h-full bg-slate-700 overflow-hidden rounded-md pl-4 relative">
                <input type="text" id="formInput" placeholder="tap message ...." class="bg-transparent border-none outline-none w-full h-full focus:ring-0">
            </div>
            <i @click="send()" id="send" class="bi bi-mic w-14 flex items-center justify-center text-xl hover:text-sky-700 cursor-pointer"></i>
        </div>
    </section>

    @vite('resources/js/chat.js')
</x-filament-panels::page>

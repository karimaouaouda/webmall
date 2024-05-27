<x-guest-layout include-navbar="true">
    <div class="container w-full h-auto px-2 flex justify-center py-4 my-4">
        <div x-data="mainData" class="w-full my-4 flex  md:w-4/5 lg:w-3/5 flex-col h-auto">
            <div class="header h-10 flex px-4 md:px-8 lg:px-10 justify-between items-center">
                <h1 class="font-bold text-2xl">
                    shose your interests
                </h1>
                <i class="bi bi-arrow-right text-2xl"></i>
            </div>
            <div x-init="loadInterests()" class="body flex-1 interests lg:px-10 py-10">
                <div class="cotainer max-h-[500px] flex gap-2 overflow-auto justify-around flex-wrap">
                    <template x-if="interests.length && !load">
                        <template x-for="interest of interests">
                            <div x-init="initMySelf($el)" x-data="bubbleData" :data-sub_category="interest.name"
                                 :class="{
                                'border-dashed bg-slate-200' : !selected,
                                'border-solid bg-sky-500 shadow-md text-white' : selected
                             }"
                                 x-text="interest.name"
                                 @click="choseOrDelete($el)"
                                 class="interest hover:border-solid duration-300 ease-in-out cursor-pointer hover:bg-sky-500 hover:text-white hover:shadow-md rounded-full border border-1 border-slate-700 w-fit py-1 px-2 text-sm uppercase">
                            </div>
                        </template>
                    </template>
                    <template x-if="(! (interests.length)) || load">
                        <div class="spinner"></div>
                    </template>

                </div>
            </div>
            <div class="actions h-10 mb-2 flex justify-between px-10 py-4 items-center">
                <a href="#"
                   class="relative group rounded-full border-1 border px-4 py-2 border-gray-300 text-lg duration-300 ease-in-out bg-slate-200 hover:bg-slate-100 font-semibold ">
                    skip for now <i class="bi bi-arrow-right-short"></i>

                    <span class="absolute hidden group-hover:block bottom-full bg-gray-300 text-black p-1 text-xs left-0 rounded-md font-extralight mb-2 text-center min-w-[200px]">
                        if you skip right now, you will be required to enter themm later
                    </span>
                </a>
                <button
                    data-post-url="{{ route('interests.upload') }}"
                    @click="submitInterests($el)"
                    :disabled="!selectedBubbles.length"
                    class="rounded-full disabled:!bg-gray-400 disabled:cursor-not-allowed border-1 bg-blue-400 text-white hover:bg-blue-500 duration-300 ease-in-out border px-4 py-2 border-gray-300 text-lg font-semibold">
                    proceed with those <i class="bi bi-check-lg"></i>
                </button>
            </div>
        </div>
    </div>




    @vite('resources/js/client/interests.js')
</x-guest-layout>

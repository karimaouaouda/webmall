<div class='hidden lg:flex flex-col h-screen justify-between sticky top-0 bg-primary lg:p-8 xl:p-12 lg:max-w-sm xl:max-w-lg'>
    <div class="flex items-center justify-start space-x-3">
        <span class="bg-black rounded-full w-8 h-8"></span>
        <a href="#" class="font-medium text-xl">Brand</a>
    </div>
    
    <div class='space-y-5'>
        <div class="etaps relative">
            <div class="etap flex gap-3 items-center">
                <span
                class="w-14 h-14 bg-black rounded-full flex text-3xl text-primary
                    items-center justify-center font-extrabold">
                {{$etapNumber}}
            </span>
            <span class="text-black font-extrabold text-2xl">
                {{$etapLabel}}
            </span>
            </div>
        </div>
        <h1 class="lg:text-2xl xl:text-4xl xl:leading-snug font-extrabold">
            {{ __('we need your personal information to manage your account') }}
        </h1>
        <p class="text-lg">You do not have an account?</p>
        <a href="{{ route('register', ['domain' => 'seller']) }}"
            class="inline-block flex-none px-4 py-3 border-2 
            rounded-lg font-medium border-black bg-black text-white
            disabled:bg-gray-400 disabled:text-black">
            business information <i class="bi bi-arrow-right"></i>
        </a>
    </div>
    <p class="font-medium">© 2022 Company</p>
</div>

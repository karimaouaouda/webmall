<div class="flex flex-row w-full">

    <x-auth.seller.parts.sidebar>
        <x-slot:etap-number>
            1
        </x-slot:etap-number>
        <x-slot:etap-label>
            persona information
        </x-slot:etap-label>
    </x-auth.seller.parts.sidebar>

    <div class="flex flex-1 flex-col items-center justify-center px-10 relative">
        <div class="flex lg:hidden justify-between items-center w-full py-4">
            <div class="flex items-center justify-start space-x-3">
                <span class="bg-black rounded-full w-6 h-6"></span>
                <a href="#" class="font-medium text-lg">Brand</a>
            </div>
            <div class="flex items-center space-x-2">
                <span>have an account? </span>
                <a href="{{ route('login', ['domain' => 'seller']) }}" class="underline font-medium text-[#070eff]">
                    login now
                </a>
            </div>
        </div>
        <!-- Login box -->
        <div class="flex flex-1 flex-col justify-center space-y-5 w-full">
            <div class="flex flex-col space-y-2 text-center">
                <h2 class="text-3xl md:text-4xl font-bold">register</h2>
                <p class="text-md md:text-xl">
                    fill your persona information <i class="text-red-400">be aware</i>
                </p>
            </div>
            <form action="{{route('seller.register')}}" method="post" class="flex flex-col w-full space-y-5 mx-auto">
                
                @csrf

                <div class="flex justify-around items-center flex-wrap gap-3">
                    <x-parts.input type="text" ph="name:joe doe" n="1" name="first name" :inline="true" :value="old('name')"/>
                    <x-parts.input type="text" ph="name:joe doe" n="1" name="last name" :inline="true" :value="old('name')"/>
                </div>

                <x-parts.input type="email" ph="email:joedoe@example.com" n="1" name="email" :value="old('email')"/>

                <x-parts.input id="password" type="password" ph="password:********" n="1" name="password"/>

                <x-parts.input id="password_confirmation" type="password" ph="password confirmation:********" n="1" name="password_confirmation"/>

                <div class="flex justify-around items-center flex-wrap gap-3">
                    <x-parts.input type="text" ph="city:Annabe" n="1" name="city" :inline="true" :value="old('name')"/>
                    <x-parts.input type="text" ph="province:el-bouni" n="1" name="province" :inline="true" :value="old('name')"/>
                    <x-parts.input type="text" ph="code:23000" n="1" name="code" :inline="true" :value="old('name')"/>
                    <x-parts.input type="text" ph="street:hiahem abdelhamid n=23" n="1" name="code" :inline="true" :value="old('name')"/>
                </div>

                {{--<div class="w-full bg-red-500 bg-opacity-55 text-white text-sm px-2 pb-2 pt-1 font-semibold tracking-wide">
                    <i class="bi bi-patch-question text-xl block text-center"></i> we demand your identity (ID CARD or PASSPORT) in refer to
                    assure that the information you provided above is correct, the cards will be reoved after 30 days
                    , this is a way to protecte our client from scammers.
                </div>

                <x-parts.input type="file" accept="image/*" capture="user" ph="password:********" n="1" name="password"/>--}}

                <button type="submit"
                    class="flex items-center justify-center flex-none px-3 py-2 md:px-4 md:py-3 border-2 rounded-lg font-medium border-black bg-black text-white">
                    <i class="bi bi-floppy mx-2"></i> save and continue
                </button>
            </form>
        </div>

        <!-- Footer -->
        <x-auth.seller.parts.footer />

    </div>
</div>

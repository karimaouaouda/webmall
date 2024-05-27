<div class="w-screen min-h-screen overflow-y-auto overflow-x-hidden relative">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap');
        *{
            font-family: 'Roboto';
        }
    </style>
    <div class="absolute w-full min-h-screen py-2 px-4 lg:px-20">
        <div class="container  flex mx-auto flex-col items-center w-full">
            <div class="headings mt-4 mx-auto">
                <div class="title flex text-2xl text-center lg:text-4xl bg-sky-500 text-white p-4 shadow rounded-lg font-normal tracking-wide uppercase">
                    <h1 class="flex items-center text-4xl">
                        <sup><i class="bi bi-stars"></i></sup>
                    </h1>
                    <h1>
                        Register your Business to start
                    </h1>
                    <h1 class="flex items-center text-4xl">
                        <sup><i class="bi bi-stars"></i></sup>
                    </h1>
                </div>

            </div>

            <div class="content mt-4 w-full min-h-screen flex flex-wrap justify-between">
                <div class=" flex-1 my-4 h-screen lg:sticky lg:top-4">
                    <div class="flex mt-10 my-4 bg-sky-500 rounded-full w-full md:min-w-[350px] flex-1 items-start p-10 ">
                        <img class="w-full" src="{{ asset('assets/images/shopping.svg')  }}" alt="">
                    </div>
                </div>

                <form method="POST" action="{{ route('seller.business.register')  }}" @submit.prevent="console.log('trying to submit')" class="w-full md:w-auto form-container mx-auto flex flex-col gap-6 items-center justify-start md:min-w-[500px] lg:min-w-[550px]">
                    <!--
                        <div class="errors w-full lg:w-4/5 rounded-lg shadow py-4 bg-red-500 my-2 flex justify-center">
                        <ul class="errors-list">
                            <li class="text-white">
                                - error number 1
                            </li>
                        </ul>
                    </div>
                    -->

                    <div class="inputs w-full flex gap-7 flex-col w-full items-center">

                        <x-form.inputs.first name="business_name" icon="shop" label="business name"/>

                        <x-form.inputs.first name="unique_name" icon="at" label="business_unique_name.webmall.test"/>

                        <x-form.inputs.first name="dz_number" icon="file-earmark-post" label="business DZ number"/>

                        <x-form.inputs.file-first name="business_agreement" label="business document from DZ government" icon="file-earmark-arrow-up"/>

                        <x-form.text-area.first name="description" icon="file-earmark-post" label="business description" />
                    </div>

                    <x-form.sections.first header="business adress" header-text-color="white" bg="sky-400">
                        <x-form.inputs.first name="city" label="city" icon="signpost-split" />

                        <x-form.inputs.first name="street" label="street" icon="house-door" />

                        <x-form.inputs.first name="postal_code" label="postal code" icon="mailbox" />
                    </x-form.sections.first>

                    <div class="check mt-2">
                        <input type="checkbox" class="cursor-pointer">
                        <span class="sm">
                                I read <a href="#" class="text-sky-400 hover:underline">privacy policy</a> and accept all of them
                            </span>
                    </div>

                    <div class="button-box w-full my-2 lg:w-4/5 text-center">
                        <button type="submit"
                                class="px-4 py-2 uppercase text-white bg-sky-500 hover:bg-sky-600 duration-300 ease-in-out rounded-lg shadow">
                            save & continue
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>
    <a class="fixed w-10 m-4 rounded-full h-10 rounded shadow-md bg-slate-100 flex items-center justify-center
        cursor-pointer opacity-50 hover:opacity-100 duration-150 ease-in-out hover:scale-105">
        <i class="bi bi-house"></i>
    </a>
</div>

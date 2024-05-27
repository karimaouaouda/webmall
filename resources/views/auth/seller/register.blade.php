<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title> {{ env('APP_NAME', 'Webmall') }} - register to your accout </title>

    @vite(['resources/css/app.css'])
</head>
<style>
    @import url('https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap');

    html,
    body {
        font-family: 'Roboto', sans-serif;
    }

    .break-inside {
        -moz-column-break-inside: avoid;
        break-inside: avoid;
    }

    body {
        display: flex;
        justify-content: space-between;
        flex-direction: column;
        min-height: 100vh;
        line-height: 1.5;
    }
</style>

<body class="bg-white">


    <script src="{{asset('custom-js/loader.js')}}" defer></script>
    <!-- Example -->
    <div class="flex min-h-screen">

            @switch($etap)
                @case(1)
                    <x-auth.seller.parts.personal-information/>
                    @break
                @case(2)
                    <x-auth.seller.parts.business-information/>
                    @break
                @default
                error
            @endswitch
        </div>
    </div>

    @vite('resources/js/alpine.js')

    <div id="loader" class="w-full h-full left-0 top-0 flex justify-center items-center
     bg-slate-700 bg-opacity-50 absolute">
     <div class="spinner"></div>
    </div>
    <!-- Example -->
</body>

</html>

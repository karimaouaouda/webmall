<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{csrf_token()}}">
    @vite(['resources/css/app.css'])
    <title>Document</title>
</head>
<body class="w-screen h-screen bg-sky-100 flex justify-center items-center">
    <button id="fire" class="p-2 bg-sky-500 hover:bg-sky-600 text-white">
        click me
    </button>

    <script>
        fire.onclick = function(){
            let data = new FormData
            data.append('_token', "{{ csrf_token() }}")
            fetch("{{env('APP_URL')}}/fire", {
                method : 'POST',
                body: data
            }).then(res => res.json())
            .then(json => console.log(json))
        }
    </script>

    @vite(['resources/js/app.js'])
</body>
</html>
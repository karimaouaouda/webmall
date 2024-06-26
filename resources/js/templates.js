export var audioMessageTemplate = (blob) => {
    let _id = 'audio_' + Math.floor(Math.random() * 1000) * Math.floor(Math.random() * 1000) * 1000

    return {
        template: `
    <div class="message-wrapper">
        <div class="message audio flex relative gap-2">
            <div class="chat-pic h-10 w-10 rounded-full overflow-hidden border-sky-500 border-2">
                <img src="${ JSON.parse(document.querySelector('#data').dataset.json).profile_photo_url}" class="w-full h-full" alt="">
            </div>
            <div id="e${_id}" class="w-40 h-full">
                        <audio src="${blob}" controls></audio>
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
    </div>`,

        id: _id,

        setCallback: (wave = null) => {
            document.querySelector('#button_' + _id).onclick = () => {
                wave.playPause()
            }
        }
    }
}

export var textMessageTemplate = (content, recived = false) => {
    return `<div x-data={'text' : ${content}} class="message-wrapper">
    <div class="message flex ${recived ? "flex-row-reverse" : ""} relative gap-2">
        <div x-data="{}" class="chat-pic h-10 w-10 rounded-full overflow-hidden border-sky-500 border-2">
            <img src="${ recived ? JSON.parse(document.querySelector('#data').dataset.json).ai_pic : JSON.parse(document.querySelector('#data').dataset.json).profile_photo_url }" class="w-full h-full" alt="">
        </div>
        <div class="message-content h-fit  ${recived ? "bg-gray-300" : "bg-blue-700 text-white"} p-2 rounded-md relative top-2 max-w-[400px]">
            ${content}
            <button x-data="listenButtonData" @click="listen">
                <i class="bi bi-headphones hover:bg-slate-200 hover:bg-opacity-30 rounded-full flex items-center justify-center w-6 h-6"></i>
            </button>
        </div>
        <div x-data="{open : false}" class="dropdown relative top-2 text-black text-xl cursor-pointer">
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
                        <button onclick="copy(${content})" class="w-full h-full">copy</button>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>`
}

export var errorTemplate = () => {
    return `<div class="message-wrapper">
    <div class="message flex flex-row-reverse relative gap-2">
        <div class="chat-pic h-10 w-10 rounded-full overflow-hidden border-sky-500 border">
            <img src="${ JSON.parse(document.querySelector('#data').dataset.json).ai_pic}" class="w-full h-full" alt="">
        </div>
        <div class="message-content h-fit bg-red-400 text-white p-2 rounded-md relative top-2 max-w-[400px]">
            sorry something went wrong please retry
        </div>

    </div>
</div>`
}

export var reflechingTemplate = () => {
    let div = document.createElement('DIV')
    div.classList.add('message-wrapper')

    div.innerHTML = `
    <div class="message flex flex-row-reverse relative gap-2">
    <div class="chat-pic h-10 w-10 rounded-full overflow-hidden border-sky-500 border">
        <img src="${ JSON.parse(document.querySelector('#data').dataset.json).ai_pic}" class="w-full h-full" alt="">
    </div>
    <div class="message-content h-fit bg-green-400 text-black p-2 rounded-md relative top-2 max-w-[400px]">
        thinking...
    </div>

    </div>`


    return div
}

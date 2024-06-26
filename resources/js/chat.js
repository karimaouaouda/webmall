import Alpine from 'alpinejs'
import axios from 'axios'

import { textMessageTemplate, errorTemplate, reflechingTemplate } from './templates'


(function () {

    const synth = window.speechSynthesis;
    var voice;
    synth.onvoiceschanged = () => {
        //alert(synth.getVoices())
        console.info(synth.getVoices())

        synth.getVoices().forEach(v => {
            if (v.lang == "en-US") {
                voice = v;
                console.info(voice)
            }
        })
    }

    var globalBlob = null

    const mainContainer = document.querySelector('#messages')

    window.onload = function () {
        mainContainer.scrollTo({
            top: mainContainer.scrollHeight
        })
    }

    const togglerButton = document.getElementById('mic');

    var recognition = new (window.SpeechRecognition || window.webkitSpeechRecognition || window.mozSpeechRecognition || window.msSpeechRecognition)();

    recognition.lang = 'en-US';
    recognition.interimResults = false;
    recognition.maxAlternatives = 5;

    recognition.onresult = function (event) {
        document.getElementById('formInput').value = event.results[0][0].transcript
    };

    Alpine.data('listenButtonData', function () {
        return {
            listen(e) {

                const utterThis = new SpeechSynthesisUtterance(this.$data.content);

                utterThis.voice = voice

                synth.speak(utterThis);
            }
        }
    })

    Alpine.data('formData', () => {
        return {
            isRecording: false,

            content: "",

            send() {
                let content = document.getElementById('formInput').value

                if (content.trim() == "") {
                    console.error("message null")
                } else {

                    document.getElementById('formInput').value = ""

                    mainContainer.innerHTML += textMessageTemplate(content)

                    let url =  "https://www.webmall.test/message/send"

                    let data = new FormData

                    data.append('_token', document.getElementById("_token").value)
                    data.append('message', content)

                    let container = reflechingTemplate()

                    mainContainer.appendChild(container)

                    axios.post(url, data, {
                        headers: {
                            'Content-Type': 'multipart/formdata'
                        }
                    })
                        .then(function (response) {
                            console.log(response);

                            let gptresponse = response.data.content


                            container.remove()

                            mainContainer.innerHTML += textMessageTemplate(gptresponse, true)

                            mainContainer.scrollTo({
                                top: mainContainer.scrollHeight
                            })
                        }).catch(err => {
                        container.remove()

                        mainContainer.innerHTML += errorTemplate();
                    })


                }


            },

            stopRecord() {
                this.isRecording = false

                recognition.stop()
            },


            record: function () {
                this.isRecording = true

                try {
                    recognition.start();
                } catch (err) {
                    console.log(err)
                }
            }
        }
    })

    // declarations
    let wavesurfer, record
    let scrollingWaveform = false

    //initialization of the record process



    //handle pause action

    togglerButton.onclick = () => {
        if (record.isPaused()) {
            record.resumeRecording()
            return
        }

        record.pauseRecording()
        pauseButton.textContent = 'Resume'
    }

    togglerButton.onclick = () => {
        if (record.isRecording() || record.isPaused()) {
            record.stopRecording()
            return
        }

        // reset the wavesurfer instance

        // get selected device
        const deviceId = micSelect.value
        record.startRecording({ deviceId })
    }

    //set the timein the screen
    const progress = document.querySelector('#progress')
    const updateProgress = (time) => {
        // time will be in milliseconds, convert it to mm:ss format
        const formattedTime = [
            Math.floor((time % 3600000) / 60000), // minutes
            Math.floor((time % 60000) / 1000), // seconds
        ]
            .map((v) => (v < 10 ? '0' + v : v))
            .join(':')
        progress.textContent = formattedTime
    }


    Alpine.start()
})()

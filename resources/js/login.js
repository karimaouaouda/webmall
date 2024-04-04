import Alpine from "alpinejs";
import axios from "axios";
import { formToJson } from "./utils";
import Swal from "sweetalert2";

window.Alpine = Alpine

document.addEventListener('alpine:init', function () {
    Alpine.bind('errorBiner', function () {
        return {
            ':class'() {
                let self = this
                function inErrors() {
                    console.log(self.$el.nextElementSibling)
                    let name = self.$el.getAttribute('name')
                    if (name in self.$data.errors) {
                        self.$el.nextElementSibling.classList.remove('hidden')
                        self.$el.nextElementSibling.innerText = self.$data.errors[name]
                        return true
                    }



                    self.$el.nextElementSibling.classList.add('hidden')
                    return false
                }
                return {
                    'border-red-800': inErrors(),
                    'border-black': !inErrors()
                }
            }
        }
    })

    Alpine.data('loginData', function () {
        return {
            disabled: false,

            errors: [],

            tryRegister: function () {
                var data = this
                this.disabled = true

                let url = this.$el.dataset.postUrl

                let formElem = document.querySelector("#register_form")

                let form = new FormData(formElem)

                let json = formToJson(form)

                axios.post(url, json, {
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'aplication/json'
                    }
                })
                    .then(js => {
                        console.log(js)
                        Swal.fire({
                            title: "successful registration",
                            text: "you have been redirecting to login page",
                            icon: "success",
                            timer: 2000
                        })

                        setTimeout(() => {
                            window.location.href = "/dashboard"
                        }, 1800);
                    }).catch(response => {
                        console.log(response)
                        data.disabled = false
                        let errors = response.response.data.errors

                        data.errors = errors
                    })
            }
        }
    })
})

Alpine.start();
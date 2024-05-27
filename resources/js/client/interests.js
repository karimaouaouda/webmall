import Alpine from "alpinejs";
import axios from "axios";

const base_url = import.meta.env.VITE_APP_URL
const csrf_token = document.querySelector("meta[name=csrf-token]").content

window.onload = function(){

    Alpine.data('mainData', function(){
        return {
            interests : [],
            selectedBubbles : [],
            load : false,

            loadInterests(el){

                let url = base_url + '/api/interests'
                let self = this;

                axios.get(url).then(response => {
                    console.log(response.data.interests)
                    self.interests = response.data.interests
                })
            },

            submitInterests(el){
                el.disabled = true
                let url = el.dataset.postUrl;

                let self = this

                this.load = true

                let data = new FormData

                data.append('_token', csrf_token)
                this.$data.selectedBubbles.forEach(bubble => {
                    data.append('interests[]', bubble)
                })

                axios.post(url, data).then(response => {
                    self.load = false;

                    window.location.href = base_url + '/dashboard'

                    console.log(response.data)
                }).catch(err => {
                    self.load = false
                    el.disabled = false
                })
            }
        }
    })

    Alpine.data('bubbleData', function(element){
        return {
            selected : false,


            initMySelf(el){
                this.selected = this.$data.selectedBubbles.includes(el.dataset.sub_category)
            },
            choseOrDelete(el){
                if( this.selected ){
                    let index = this.$data.selectedBubbles.indexOf(el.dataset.sub_category)
                    this.$data.selectedBubbles.splice(index,   1)

                    console.log(this.$data.selectedBubbles)

                    this.selected = false;
                }else{
                    this.selected = true
                    this.$data.selectedBubbles.push(el.dataset.sub_category)
                    console.log(this.$data.selectedBubbles)
                }
            },
        }
    })


    Alpine.start()

}

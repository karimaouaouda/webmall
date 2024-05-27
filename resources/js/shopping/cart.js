import Alpine from "alpinejs";
import axios from "axios";

const base_url = import.meta.env.VITE_APP_URL


window.onload = function () {

    Alpine.data('cartData', function () {
       return {
            show : false,
            
            items : [],

            loadProducts(){
                let self = this;

                axios.get(base_url + '/cart/items')
                    .then(response => {
                        self.items = response.data.items
                    }).catch(err => {
                        alert(err)
                    })
            },
       }
    })

    Alpine.start()
}
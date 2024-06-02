import Alpine from "alpinejs";
import axios from "axios";

const base_url = import.meta.env.VITE_APP_URL


Alpine.data('cartData', function () {
    return {
         show : false,
         
         items : [],

         loadItems(){
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
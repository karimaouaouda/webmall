import Alpine from "alpinejs";
import axios from "axios";
import Swal from "sweetalert2";

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

Alpine.data('productData', function(){

    return {
        item : null,

        addToCart(){

            if( !this.$data.items ){
                let f = new FormData

                f.append('_token', document.querySelector('meta[name=csrf-token]').content )
                f.append('product_id', this.item.id)
                let self = this;

                axios.post(base_url + '/cart/push',f )
                    .then(function(response){
                        self.$data.items = []
                        self.$data.items.push(this.item);
                    })
            }


            this.$data.items.forEach(i => {
                if( i.id === this.item.id ){
                    Swal.fire({
                        title : 'Already in cart',
                        text : 'you have aded this product to cart',
                        icon : 'warning'
                    })
                }else{
                    let f = new FormData

                    f.append('_token', document.querySelector('meta[name=csrf-token]').content )
                    f.append('product_id', this.item.id)
                    let self = this;

                    axios.post(base_url + '/cart/push',f )
                        .then(function(response){
                            self.$data.items.push(item);
                        })


                }
            })


        }
    }

})

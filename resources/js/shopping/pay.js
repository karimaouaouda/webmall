import Alpine from "alpinejs";
import axios from "axios";
import Swal from "sweetalert2";

const base_url = import.meta.env.VITE_APP_URL


Alpine.data('payData', function () {

    let items = JSON.parse(this.$el.dataset.items)
    return {
        items: items,

        sub_total: 0,

        total: 0,

        useMyAdress: false,

        useMyPay: false,

        sub_total_without_sold : 0,

        shipping: 250,

        afterSolde(item) {
            return (item.price * (1 - (item.solde / 100))).toFixed(2);
        },

        subTotal(){
            let s = 0;
            let s2 = 0;
            this.items.forEach(item => {
                s2 += item.pivot.quantity * item.price;
                s += item.pivot.quantity * (item.price * (1 - item.solde / 100) )
            })

            this.sub_total = s.toFixed(2);
            this.sub_total_without_sold = s2.toFixed(2)
            console.info(s)

            return s
        },

        pay(){
            let formToSend = new FormData();

            if( this.useMyAdress ){
                formToSend.append('address_to_use', 'profile')
            }else{
                formToSend.append('address_to_use', 'request')

                let fields = ['full_name', 'phone_number', 'street_line', 'city', 'province']

                fields.forEach(field => {
                    formToSend.append(field, document.querySelector(`input[name=${field}]`).value )
                })
                
            }

            if( this.useMyPay ){
                formToSend.append('payment_method_to_use', 'profile')
            }else{
                formToSend.append('payment_method_to_use', 'request')

                let fields = ['card_owner', 'card_number', 'card_cvc', 'card_expire_at']

                fields.forEach(field => {
                    formToSend.append(field, document.querySelector(`input[name=${field}]`).value )
                })
                
            }

            let src = document.querySelector('#paymentButton').dataset.src;

            formToSend.append('source', src)

            this.items.forEach(item => {
                formToSend.append('items[]', JSON.stringify({
                    'product_id' : item.id,
                    'quantity' : item.pivot.quantity
                }))
            })


            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                  confirmButton: "btn btn-success",
                  cancelButton: "btn btn-danger"
                },
                buttonsStyling: false
              });
              swalWithBootstrapButtons.fire({
                title: "confirm command?",
                text: "are you sure you want to proceed in command",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Yes, proceed!",
                cancelButtonText: "No, cancel!",
                reverseButtons: true
              }).then((result) => {
                if (result.isConfirmed) {
                    axios.post('/checkout', formToSend)
                        .then(response => {
                            swalWithBootstrapButtons.fire({
                                title: "command placed!",
                                text: "your command placed.",
                                icon: "success"
                              });
                        }).catch(err => {
                            Swal.fire({
                                title : 'error was occured',
                                text : err,
                                icon : 'error'
                            })
                        })
                    
                } else if (
                  /* Read more about handling dismissals below */
                  result.dismiss === Swal.DismissReason.cancel
                ) {
                  swalWithBootstrapButtons.fire({
                    title: "Cancelled",
                    text: "Your imaginary file is safe :)",
                    icon: "error"
                  });
                }
              });


            
        }
    }
});

Alpine.data('productData', function () {
    return {


        product: null,

        qte: 1,

        priceAfterSolde() {
            this.product.price = (this.product.price * this.product.solde) * this.qte
        },

        increament() {
            this.product.pivot.quantity++

            this.$data.subTotal()
        },
        decreament() {
            this.product.pivot.quantity--
        },

        remove(){
            let index = this.$data.items.indexOf(this.product)

            this.$data.subTotal()

            this.$data.items.splice(index, 1)

            if( this.$data.items.length == 0 ){
                window.location.href = base_url + '/discover';
            }
        }
    }
})
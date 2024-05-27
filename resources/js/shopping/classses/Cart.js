import Product from "./Product";

export default class Cart{

    products = []

    constructor({selector}){
        this.selector = selector
    }


    update(){
        this.products.forEach(product => {
            let productElement = document.createElement.querySelector(`${selector} #product_${product.get

        })
    }




    addToCart(id, name, short_description, price, quantity){
        let product = Product(id, name, short_description, price, quantity)

        this.addObjectToCart(product)
    }

    addObjectToCart(productObject){
        this.products.forEach(product => {
            if(product.id == productObject.id){
                productObject.increament()
                return
            }
        });

        this.products.push(productObject)
    }
}
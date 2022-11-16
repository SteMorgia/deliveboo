<template>
    <div class="container mt-3 mb-3">

        <h1>{{restaurant.name}}</h1>
        <p>Indirizzo: <br> {{restaurant.address}}</p>
        <p>Telefono: <br> {{restaurant.phone_number}}</p>
        <p>Descrizione: <br> {{restaurant.description}}</p>

        <hr>

        <h1>Menu:</h1>

        <div class="row">

            <div :class=" (cart.length>0)?'col-6':'col-12' ">

                <div v-if="dishes" class="d-flex flex-wrap">
                    <div v-for="(dish, index) in dishes" :key="index"
                        class="card m-2" style="width: 14rem;">
                        <img class="card-img-top" :src="'/storage/' + dish.image" :alt="dish.name">
                        <div class="card-body">
                            <h5 class="card-title">{{dish.name}}</h5>
                            <p class="card-text">{{dish.description}}</p>
                            <p class="card-text">{{dish.price}} €</p>
                            <button class="btn btn-primary" @click="addToCart(dish)">Aggiungi al carrello</button>
                        </div>
                    </div>

                </div>

                <div v-if="dishes.length == 0 && doDishesExists == false">
                    <h2 style="color: #f25f4c;">Non esiste nessun piatto in questo ristorante</h2>
                </div>

            </div>

            <!-- inizio contenitore carrello + riepilogo -->
            <div v-if="cart.length > 0" :class=" ( cart.length > 0 )?'col-6':'' ">

                <!-- inizio carrello -->
                <table class="table">
                    <thead>
                        <tr>
                        <th scope="col">#</th>
                        <th scope="col">Prodotto</th>
                        <th scope="col">Prezzo unitario</th>
                        <th scope="col">Quantità</th>
                        <th scope="col">Modifica ordine</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(cartDish, index) in cart" :key="index">
                        <th scope="row">{{index + 1}}</th>
                        <td>{{cartDish.name}}</td>
                        <td>{{cartDish.price}} €</td>
                        <td>{{cartDish.quantity}}</td>
                        <td>
                            <button @click="increaseCartItem(cartDish)" class="btn btn-primary m-1">+</button>
                            <button @click="decreaseCartItem(cartDish, index)" class="btn btn-secondary m-1">-</button>
                            <button @click="removeCartItem(index)" class="btn btn-danger m-1" >x</button>
                        </td>
                        </tr>
                    </tbody>
                </table>
                <!-- fine carrello -->
                
                <!-- inizio riepilogo -->
                <table class="table">
                    <tbody>
                        <tr>
                            <th class="text-right">Totale articoli nel carrello: {{itemTotalAmount}}</th>
                        </tr>
                        <tr>
                            <th class="text-right">Totale ordine: € {{cartTotalAmount}}</th>
                        </tr>
                    </tbody>
                </table>
                <!-- fine riepilogo -->

            </div>
            <!-- fine contenitore carrello + riepilogo -->

        </div>

        <router-link :to="{name: 'homepage'}" class="btn mt-3" style="background-color:#ff8906;" >Torna alla homepage</router-link>

    </div>
</template>

<script>
export default {
    name: 'SingleRestaurantPage',
    data() {
        return {
            restaurant: {},
            dishes: [],
            doDishesExists: true,
            cart: []
        }
    },
    methods: {
        getSingleRestaurantF() {
            const slug = this.$route.params.slug;

            axios
            .get('http://localhost:8000/api/filterRestaurants/' + slug) // va in show() in Api\RestaurantController;
            .then( response => {
                this.restaurant = response.data.result;
                this.getSingleRestaurantDishesF(this.restaurant.id);
            });
        },
        getSingleRestaurantDishesF(idRestaurant) { // va in filterDishes() in Api\RestaurantController;
            axios
            .get('http://localhost:8000/api/filterDishes/' + idRestaurant)
            .then( response => {
                this.dishes = response.data.results;
                if (this.dishes == 0) {
                    this.doDishesExists = false;
                }
            });
        },
        addToCart(dishP) {
            for ( let i = 0; i < this.cart.length; i++ ) {
                if ( this.cart[i].id === dishP.id ) {
                    this.cart[i].quantity++;
                    this.saveCartToLocalStorage();
                    return
                }
            }
            this.cart.push(
                {
                    id: dishP.id,
                    name: dishP.name,
                    price: dishP.price,
                    quantity: 1
                }
            );
            this.saveCartToLocalStorage();
        },
        increaseCartItem(dishP) {
            dishP.quantity++;
            this.saveCartToLocalStorage();
        },
        decreaseCartItem(dishP, indexP) {
            if ( dishP.quantity == 1 ) {
                this.removeCartItem(indexP);
            } else {
                dishP.quantity--;
                this.saveCartToLocalStorage();
            }
        },
        removeCartItem(indexP) {
            confirm('Confermi di voler cancellare questi piatti dall\'ordine?') ? this.$delete(this.cart, indexP) : '';
            this.saveCartToLocalStorage();
        },
        saveCartToLocalStorage() {
            localStorage.setItem( 'localCart', JSON.stringify(this.cart) ); // in localStorage devo salvare i dati come stringa;
        }
    },
    computed: {
        itemTotalAmount() {
            let itemTotal = 0;
            for ( let dish in this.cart ) {
                itemTotal += ( this.cart[dish].quantity );
            }
            return itemTotal;
        },
        cartTotalAmount() {
            let total = 0;
            for ( let item in this.cart ) {
                total += ( this.cart[item].quantity * this.cart[item].price );
            }
            return total;
        },
    },
    mounted() {
        this.getSingleRestaurantF();
        let localCart = localStorage.getItem( 'localCart' ); // recupero carrello salvato in localStorage;
        this.cart = ( localCart != null ) ? JSON.parse( localCart ) : []; // se in localStorage ho un carrello con oggetti, converto il file json;
    }
}
</script>

<style>
</style>
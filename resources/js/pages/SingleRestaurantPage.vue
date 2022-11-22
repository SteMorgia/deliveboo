<template>
    <div class="container p-3">
        <div class="p-5 rounded " style="background-color:white; border:2px solid #a7a9be;">
        <h1>{{restaurant.name}}</h1>
            <p>Indirizzo: <br> {{restaurant.address}}</p>
            <p>Telefono: <br> {{restaurant.phone_number}}</p>
            <p>Descrizione: <br> {{restaurant.description}}</p>

        </div>        

        <hr>

        <h1>Menu:</h1>

        <div class="row">

            <div :class=" (cart.length>0)?'col-6':'col-12' ">

                <div v-if="dishes" class="d-flex flex-wrap">
                    <div v-for="(dish, index) in dishes" :key="index"
                        class="card m-2 p-1 border:2px solid black;" style="width: 14rem; border:2px solid #a7a9be;">
                        <img class="card-img-top" style="min-height: 12rem" :src="'/storage/' + dish.image" :alt="dish.name">
                        <div class="card-body"  style="width: 15rem" >
                            <h5 class="card-title">{{dish.name}}</h5>
                            <p class="card-text">{{dish.description}}</p>
                            <p class="card-text">{{dish.price}} €</p>
                            <button class="btn text-white " style="background-color: #f25f4c" :class="btnDisabled?'disabled':''" @click="addToCart(dish, restaurant)">Aggiungi al carrello</button>
                        </div>
                    </div>

                </div>

                <div v-if="dishes.length == 0 && doDishesExists == false">
                    <h2 style="color: #f25f4c;">Al momento questo ristorante non ha alcun piatto. <br> Per favore, scegline un altro.</h2>
                </div>

            </div>

            <!-- inizio contenitore carrello + pagamento -->
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

                <!-- inizio form input -->
                <h1 class="mt-3">Compila il form:</h1>

                <label for="nameId">Nome e cognome</label>
                <input type="text"
                    id="nameId"
                    v-model="nameF"
                    class="d-block mb-3"
                    placeholder="Inserisci il tuo nome e il tuo cognome"
                    required />

                <label for="addressId">Indirizzo</label>
                <input type="text"
                    id="addressId"
                    v-model="addressF"
                    class="d-block mb-3"
                    placeholder="Inserisci il tuo indirizzo"
                    required />

                <label for="phoneId">Numero di telefono</label>
                <input type="tel"
                    id="phoneId"
                    v-model="phone_numberF"
                    class="d-block mb-3"
                    placeholder="Inserisci il tuo numero di telefono"
                    required />
                <!-- fine form input -->

                <!-- inizio form pagamento -->
                <div v-if="tokenApi.length > 0">

                    <h1 class="mt-3">Effettua il pagamento dopo aver compilato il form:</h1>

                    <Payment
                        ref="paymentRef"
                        :authorization="tokenApi"
                        @onSuccess="paymentOnSuccess"
                        @onError="paymentOnError" />
                        
                    <button type="button" 
                        class="btn text-white"
                        :class=" btnDisabled ? 'disabled' : '' "
                        @click.prevent="beforeBuy"
                        style="background-color:#f25f4c;"
                        :disabled="( this.nameF.length === 0 || this.addressF == '' || this.phone_numberF == '' ) ? true : false">
                        Procedi al pagamento
                    </button>

                </div>
                <!-- fine form pagamento -->

            </div>
            <!-- fine contenitore carrello + pagamento -->

        </div>
    
        <router-link :to="{name: 'homepage'}" class="btn mt-3" style="background-color:#ff8906;" >Torna alla homepage</router-link>

    </div>
</template>

<script>
import Payment from '../components/Payment.vue';

export default {
    name: 'SingleRestaurantPage',
    components: {
        Payment
    },
    data() {
        return {
            restaurant: {},
            dishes: [],
            doDishesExists: true,
            cart: [],
            btnDisabled: false,
            tokenApi: '',
            nameF: '',
            addressF: '',
            phone_numberF: '',
            form: {
                token: '',
                amount: '',
                name: this.nameF,
                address: this.addressF,
                phone_number: this.phone_numberF,
                cart: this.cart
            }
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
        addToCart(dishP, restaurantP) {

            // console.log(localStorage);
            let localRestaurantTemporary = localStorage.getItem('localRestaurant'); // recupero il ristorante dalla localStorage;
            // console.log(localRestaurantTemporary);
            if (localRestaurantTemporary == null) {
                this.saveRestaurantToLocalStorage(restaurantP);
                localRestaurantTemporary = localStorage.getItem('localRestaurant');
            }
            let localRestaurantRecovered = JSON.parse(localRestaurantTemporary); // decodifico il ristorante salvato in localStorage;
            // console.log(localRestaurantRecovered);

            if (restaurantP.id == localRestaurantRecovered.id) {
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
            } else {
                alert('Attenzione! Al momento non è possibile aggiungere al carrello piatti di ristoranti diversi.');
            }
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
            if (this.cart.length == 0) {
                localStorage.removeItem('localCart');
                localStorage.removeItem('localRestaurant');
            } else {
                this.saveCartToLocalStorage();
            }
        },
        saveCartToLocalStorage() {
            localStorage.setItem( 'localCart', JSON.stringify(this.cart) ); // in localStorage devo salvare i dati come stringa;
        },
        getTokenApi() {
            axios
            .get('http://localhost:8000/api/orders/generate')
            .then( response => {
                this.tokenApi = response.data.token;
            });
        },
        paymentOnSuccess(nonce) {
            this.form.token = nonce;
            this.buy();
        },
        paymentOnError (error) {
            // Codice..
        },
        beforeBuy() {
            this.$refs.paymentRef.$refs.paymentBtnRef.click();
        },
        buy() { // vado nella makePayment();

            if ( this.nameF == '' || this.addressF == '' || this.phone_numberF == '' ) {
                alert('Compila il form prima di effettuare l\'ordine');
                return;
            }

            this.btnDisabled = true;
            axios
            .post( '/api/orders/make/payment', { ...this.form } )
            .then( response => {
                
                if ( response.data.success == true ) {

                    this.cart = [];
                    localStorage.removeItem( 'localCart' );
                    localStorage.removeItem( 'localRestaurant' );
                    window.location.href = "/redirect";

                }
                // invio dati al backend;
                this.btnDisabled = false;
            })

        },
        saveRestaurantToLocalStorage(restaurantP) {
            localStorage.setItem( 'localRestaurant', JSON.stringify(restaurantP) ); // salvo ristorante in localStorage;
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
            this.form.amount = 0;
            for ( let item in this.cart ) {
                this.form.amount += ( this.cart[item].quantity * this.cart[item].price );
            }
            return this.form.amount;
        }
    },
    mounted() {
        this.getSingleRestaurantF();
        let localCart = localStorage.getItem( 'localCart' ); // recupero carrello salvato in localStorage;
        this.cart = ( localCart != null ) ? JSON.parse( localCart ) : []; // se in localStorage ho un carrello con oggetti, converto il file json;
        this.getTokenApi();
    }
}
</script>

<style lang="scss" scoped>

table {
    border:2px solid #a7a9be;
    background-color:white ;
}

</style>
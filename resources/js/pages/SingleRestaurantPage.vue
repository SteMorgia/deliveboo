<template>
    <div class="container mt-3 mb-3">

        <h1>Ristorante:</h1>
        <p>{{restaurant.name}}</p>
        <p>{{restaurant.address}}</p>
        <p>{{restaurant.phone_number}}</p>
        <p>{{restaurant.description}}</p>

        <hr>

        <h1>Menu:</h1>

        <div class="row">

            <div :class=" (cart.length>0)?'col-10':'col-12' ">

                <div v-if="dishes" class="d-flex flex-wrap">
                    <div v-for="(dish, index) in dishes" :key="index"
                        class="card m-2" style="width: 18rem;">
                        <img class="card-img-top" :src="'/storage/' + dish.image" :alt="dish.name">
                        <div class="card-body">
                            <h5 class="card-title">{{dish.name}}</h5>
                            <p class="card-text">{{dish.description}}</p>
                            <p class="card-text">{{dish.price}} €</p>
                            <p class="card-text">{{dish.quantity}} quantità</p>
                            <button class="btn btn-primary" @click="addToCart(dish)">Aggiungi al carrello</button>
                        </div>
                    </div>

                </div>

                <div v-if="dishes.length == 0 && doDishesExists == false">
                    <h2 style="color: #f25f4c;">Non esiste nessun piatto in questo ristorante</h2>
                </div>

            </div>

            <!-- inizio carrello -->
            <div v-if="cart.length > 0" :class=" ( cart.length > 0 )?'col-2':'' ">
                
                <div v-for="(cartItem, index) in cart" :key="index">
                    <p>{{cartItem.name}}</p>
                    <p>{{cartItem.price}}</p>
                    <p>{{cartItem.quantity}}</p>
                </div>

                <h1>{{itemTotalAmount}}</h1>
                <h1>{{cartTotalAmount}}</h1>

            </div>
            <!-- fine carrello -->

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
            for (let i = 0; i < this.cart.length; i++) {
                if ( this.cart[i].id === dishP.id ) {
                    return this.cart[i].quantity++;
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
        },
    },
    computed: {
        itemTotalAmount() {
            let itemTotal = 0;
            for (let dish in this.cart) {
                    itemTotal += (this.cart[dish].quantity);
                }
            return itemTotal;
        },
        cartTotalAmount() {
            let total = 0;
            for (let item in this.cart) {
                total += (this.cart[item].quantity * this.cart[item].price);
            }
            return total;
            },
        },
    mounted() {
        this.getSingleRestaurantF();
    }
}
</script>

<style>
</style>
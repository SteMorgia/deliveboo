<template>
    <div class="container mt-3 mb-3">

        <h1>Ristorante:</h1>
        <p>{{restaurant.name}}</p>
        <p>{{restaurant.address}}</p>
        <p>{{restaurant.phone_number}}</p>
        <p>{{restaurant.description}}</p>

        <hr>

        <h1>Menu:</h1>

        <div v-if="dishes" class="d-flex flex-wrap">
            <div v-for="(dish, index) in dishes" :key="index"
                class="card m-2" style="width: 18rem;">
                <img class="card-img-top" :src="'/storage/' + dish.image" :alt="dish.name">
                <div class="card-body">
                    <h5 class="card-title">{{dish.name}}</h5>
                    <p class="card-text">{{dish.description}}</p>
                    <a href="#" class="btn btn-danger">Aggiungi al carrello</a> <!-- PAURA -->
                </div>
            </div>
        </div>

        <div v-if="dishes.length == 0 && doDishesExists == false">
            <h2 style="color: #f25f4c;">Non esiste nessun piatto in questo ristorante</h2>
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
            doDishesExists: true
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
        }
    },
    mounted() {
        this.getSingleRestaurantF();
    }
}
</script>

<style>

</style>
<template>
    <div class="container mt-3 mb-3">

        <h1>Ristorante:</h1>
        <p>{{restaurant.name}}</p>
        <p>{{restaurant.address}}</p>
        <p>{{restaurant.phone_number}}</p>
        <p>{{restaurant.description}}</p>

        <hr>

        <h1>Menu:</h1>
        
        <div class="card" style="width: 18rem;">
            <img class="card-img-top" src="#" alt="Card image cap">
            <div class="card-body">
                <h5 class="card-title">Card title</h5>
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                <a href="/" class="btn btn-primary">Go somewhere</a>
            </div>
        </div>

        <router-link :to="{name: 'homepage'}" class="btn mt-3" style="background-color:#ff8906;" >Torna alla homepage</router-link>

    </div>
</template>

<script>
export default {
    name: 'SingleRestaurantPage',
    data() {
        return {
            restaurant: {}
        }
    },
    methods: {
        getSingleRestaurantF() {
            const slug = this.$route.params.slug;

            axios
            .get('http://localhost:8000/api/filterRestaurants/' + slug)
            .then( response => {
                this.restaurant = response.data.result;
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
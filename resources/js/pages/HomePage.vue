<template>
    <div class="container">
        <h1>la mia homepage</h1>

        <hr>

        <div v-for="(category, index) in categories" :key="index">
            <label :for="category.id">
                {{category.name}}
            </label>
            <input
                type="checkbox"
                :value="category.name"
                :id="category.id"
                v-model="chosenCategories"
                 />
        </div>

    <hr>

        <div v-for="(restaurant, index) in restaurants" :key="index">
            <p>{{restaurant.name}}</p>
        </div>
    </div>
</template>

<script>
    export default {
        name: "HomePage",
        data(){
            return {
                categories: [],
                restaurants: [],
                chosenCategories: []
            }
        },
        methods: {
            getCategories() {
                axios
                .get('http://localhost:8000/api/categories')
                .then( response => {
                    this.categories = response.data.results;
                    console.log(this.categories);
                })
            },
            getRestaurants() {
                axios
                .get('http://localhost:8000/api/restaurants')
                .then( response => {
                    this.restaurants = response.data.results;
                    console.log(this.restaurants);
                })
            }
        },
        mounted() {
            this.getCategories();
            this.getRestaurants();
        }
    }
</script>

<style>
</style>
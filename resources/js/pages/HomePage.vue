<template>
    <div class="container">
        <h1>la mia homepage</h1>

        <hr>

        <h1>categorie selezionate</h1>

        <span v-for="(category, index) in selectedCategories" :key="'b' + index">
            {{category}}
        </span>

        <hr>

        <div v-for="(category, index) in categories" :key="index">
            <label :for="category.id">
                {{category.name}}
            </label>
            <input
                type="checkbox"
                :value="category.id"
                :id="category.id"
                v-model="selectedCategories"
                @change="filterRestaurants()" />
        </div>

    <hr>

        <div v-for="(restaurant, index) in restaurants" :key="'a' + index">
            <p>{{restaurant.name}} - 
                <span v-for="(category, index) in restaurant.categories" :key="'d' + index">
                    {{category.name}},
                </span>
            </p>
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
                selectedCategories: [],
            }
        },
        methods: {
            getCategories() {
                axios
                .get('http://localhost:8000/api/categories')
                .then( response => {
                    this.categories = response.data.results;
                })
            },
            getRandomRestaurantsF() {
                axios
                .get('http://localhost:8000/api/filterRestaurants')
                .then( response => {
                    this.restaurants = response.data.results;
                })
            },
            filterRestaurants() {
                if (this.selectedCategories.length === 0) {
                    this.getRandomRestaurantsF();
                } else {
                axios
                // .get(`http://localhost:8000/api/restaurants?${this.selectedCategories.map((n)=>`category=${n}`).join('&')}`)
                .get('http://localhost:8000/api/restaurants?categories=' + this.selectedCategories)
                .then( response => {
                    this.restaurants = response.data.results;
                })}
            },
        },
        mounted() {
            this.getCategories();
            this.getRandomRestaurantsF();
        }
    }
</script>

<style>
</style>
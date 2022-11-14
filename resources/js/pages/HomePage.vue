<template>
    <div class="container-fluid MyHomePage">

        <div class="row">

            <div class="col-2">
                <div v-for="(category, index) in categories" :key="index">
                    <input
                        type="checkbox"
                        :value="category.id"
                        :id="category.id"
                        v-model="selectedCategories"
                        @change="filterRestaurants()" />
                    <label :for="category.id">
                        {{category.name}}
                    </label>
                </div>
            </div>

            <div class="col-10">
                <div v-if="restaurants.length > 0">
                    <div class="d-flex flex-wrap">
                        <div v-for="(restaurant, index) in restaurants" :key="'a' + index">      
                            <div class="card m-2" style="width: 18rem;">
                                <div class="card-body">
                                    <img class="card-img-top" :src="restaurant.image" alt="Card image cap">
                                    <div class="card-body">
                                        <h5 class="card-title">{{restaurant.name}}</h5>
                                        <p class="card-text">{{truncateText(restaurant.description, 30)}}</p>
                                        <a href="#" class="btn btn-sm text-white" style="background-color:#e53170;">Go somewhere</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div v-if="doRestaurantsExist == false && restaurants.length == 0">
                    <p style="color: #f25f4c;">Non esiste nessun ristorante in questa categoria</p>
                </div>

            </div>
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
                doRestaurantsExist: true
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
                    this.doRestaurantsExist = false;
                });
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
                    this.doRestaurantsExist = false;
                })};
            },
            truncateText(text, maxLength) {
                if (text.length < maxLength) {
                    return text;
                } else {
                    return text.substring(0, maxLength) + '...';
                }
            }
        },
        mounted() {
            this.getCategories();
            this.getRandomRestaurantsF();
        }
    }
</script>

<style scoped lang="scss">

    .MyHomePage {
        margin-top: 350px;

        img {
            height: 200px;
        }
    }
</style>
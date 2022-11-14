<template>
    <div>

        <!-- inizio jumbotron -->
        <div class="MyWrapper">
            <div class="MyOverlay"></div>
            <div class="jumbotron jumbotron-fluid Myjumbotron"></div>
        </div>
        <div class="container text_container">
            <h1 class="display-4 text-white">Scegli il tuo piatto</h1>
            <p class="lead text-white">A casa tua con un click.</p>
        </div>
        <!-- fine jumbotron -->

        <!-- main -->
        <div class="container-fluid">
            <div class="row">
                <div class="col-2">
                    <h3>Categorie</h3>
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
                                            <p class="card-text">{{truncateText(restaurant.description, 20)}}</p>
                                            <a href="/restaurant" class="btn btn-sm text-white" style="background-color:#ff8906;">Go somewhere</a>
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

    /* inizio jumbotron */

    .MyHomePage img {
        height: 200px;
    }
    
    .MyWrapper {
        position: relative;
        
        .Myjumbotron {
            background-image: url('https://images.unsplash.com/photo-1600891964599-f61ba0e24092?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1170&q=80');
            background-size: cover;
            height: 300px;
        }
        
        .MyOverlay {
            background-color: rgba(0, 0, 0, 0.5);
            width: 100%;
            height: 100%;
            position: absolute;
            top: 0;
            left: 0;
        }
    }

    .text_container {
        position: absolute;
        top: 100px;
        left: 0;
    }

    /* fine jumbotron */

</style>
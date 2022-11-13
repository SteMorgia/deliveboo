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
                @change="testFiltraggio()" />
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
            getRestaurants() {
                axios
                .get('http://localhost:8000/api/test')
                //.get(`http://localhost:8000/api/restaurants?${[this.selectedCategories].map( (n) => `category=${n}`) .join('&')}`)
                .then( response => {
                    this.restaurants = response.data.results;
                    // console.log(response.data);
                })
                // risultato: http://localhost/api/myController/myAction?storeIds[0]=1&storeIds[1]=2&storeIds[2]=3
                // codice: axios.get(`/myController/myAction?${[1,2,3].map( (n, index) => `storeIds[ ${index} ] = ${n}`) .join('&')}` );
                // http://localhost:8000/api/restaurants?category=1&category=2; ecc. ecc. ???
                // .get(`http://localhost:8000/api/restaurants?${[this.selectedCategories].map( (n) => `category=${n}`) .join('&')}`)
            },
            /* selectedCategoriesF(chosenCategories){
                //this.selectedCategories.push(chosenCategories);
                //chosenCategories = this.selectedCategories;

                if (this.selectedCategories.length === 0) {
                    console.log('onoinionio');
                    this.restaurants = [];
                    this.getRestaurants();
                } else {
                    console.log('nononono');
                    //this.testFiltraggio();
                }
            }, */
            testFiltraggio() {
                console.log('oooooooooooooooooooooooooooo - ' + typeof this.selectedCategories);
                if (this.selectedCategories.length === 0) {
                    console.log('onoinionio');
                    this.getRestaurants();
                } else {
                /*
                axios
                // .get(`http://localhost:8000/api/restaurants?${this.selectedCategories.map((n)=>`category=${n}`).join('&')}`)
                .get('http://localhost:8000/api/restaurants?' + this.selectedCategories.map( (n) => + 'category=' + n).join('&'))
                .then( response => {
                    this.restaurants = response.data.results;
                    console.log(response.data.results);
                }) */
                axios
                // .get(`http://localhost:8000/api/restaurants?${this.selectedCategories.map((n)=>`category=${n}`).join('&')}`)
                .get('http://localhost:8000/api/restaurants?categories=' + this.selectedCategories)
                .then( response => {
                    //console.log(this.selectedCategories);
                    //console.log(response.data.results);
                    this.restaurants = response.data.results;
                    //console.log(this.restaurants);
                })}
            },
        },
        mounted() {
            this.getCategories();
            this.getRestaurants();
        }
    }
</script>

<style>
</style>
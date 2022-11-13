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
                @change="selectedCategoriesF(selectedCategories)" />
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
                testFunzione: ''
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
                // .get('http://localhost:8000/api/restaurants')
                .get(`http://localhost:8000/api/restaurants?${[this.selectedCategories].map( (n) => `category=${n}`) .join('&')}`)
                .then( response => {
                    this.restaurants = response.data.results;
                    // console.log(response.data);
                })
                // risultato: http://localhost/api/myController/myAction?storeIds[0]=1&storeIds[1]=2&storeIds[2]=3
                // codice: axios.get(`/myController/myAction?${[1,2,3].map( (n, index) => `storeIds[ ${index} ] = ${n}`) .join('&')}` );
                // http://localhost:8000/api/restaurants?category=1&category=2; ecc. ecc. ???
                // .get(`http://localhost:8000/api/restaurants?${[this.selectedCategories].map( (n) => `category=${n}`) .join('&')}`)
            },
            selectedCategoriesF(chosenCategories){
                chosenCategories = this.selectedCategories;
                this.testFunzione = this.selectedCategories.map( (n) => `category=${n}`) .join('&');
                this.testFiltraggio();
                console.log(this.testFunzione);
            },
            testFiltraggio() {
                axios
                // .get(`http://localhost:8000/api/restaurants?${this.selectedCategories.map((n)=>`category=${n}`).join('&')}`)
                .get('http://localhost:8000/api/restaurants?' + this.selectedCategories.map( (n) => + 'category=' + n).join('&'))
                .then( response => {
                    this.restaurants = response.data.results;
                })
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
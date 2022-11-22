<template>
    <div>

        <!-- l'authorization deve contenere il token generato nella API /generate alla generateToken() -->
        <v-braintree 
            v-if="authorizationP.length > 0"
            :authorization="authorizationP"
            @success="onSuccess"
            @error="onError"
            locale=it_IT>
        </v-braintree>

    </div>
</template>

<script>
export default {
    name: 'MyPayment',
    props: {
        authorizationP: String
    },
    mounted() {
        console.log(this.authorizationP)
    }
/*     methods: {
        onSuccess (payload) {
        let nonce = payload.nonce;
        // Do something great with the nonce...
        },
        onError (error) {
        let message = error.message;
        // Whoops, an error has occured while trying to get the nonce
        }
    } */
}
</script>

<style>

</style>
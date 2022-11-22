<template>
    <div>

        <!--
            l'authorization deve contenere il token generato nella API /generate alla generateToken();
            locale = setta la lingua italiana nel form;
            load = durante il caricamento accade quanto riportato nella funzione onLoad();
            onSuccess = se la cc è valida, allora viene avviata la onSuccess che riceve come parametro d'ingresso un payload,
                        il quale contiene un token: il NONCE; questo NONCE viene inviato alla makePayment() per poter fare il pagamento;
            onError = in caso di errore, stampo l'errore in pagina;
        -->
        <v-braintree 
            v-if="authorizationP.length > 0"
            :authorization="authorizationP"
            @success="onSuccess"
            @error="onError"
            locale=it_IT
            @load="onLoad">

                <!-- creo un bottone invisibile dentro il form -->
                <template #button="slotProps">
                    <v-btn ref="paymentBtnRef" @click="slotProps.submit" /> <!-- creo un ref: mi permette, tramite la beforeBuy() di cliccare questo bottone -->
                </template>

        </v-braintree>

        <div>
            <p v-if="error" class="danger">
                {{ error }}
            </p>
        </div>

    </div>
</template>

<script>
export default {
    name: 'MyPayment',
    props: {
        authorizationP: String
    },
    data() {
        return {
            error: ''
        }
    },
    methods: {
        onLoad() {
            this.$emit('loading');
        },
        onSuccess (payload) {
            let nonceToken = payload.nonce;
            this.$emit('secondToken', nonceToken);
        },
        onError (error) {
            const message = error.message;
            if ( message === 'No payment method is available.' ) {
                this.error = 'Seleziona un metodo di pagamento';
            } else {
                this.error = message;
            }
            this.$emit('onError', message);
        }
    }
}
</script>

<style>

</style>
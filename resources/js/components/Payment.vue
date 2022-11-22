<template>
    <div>
        <v-braintree
        :authorization="authorization"
        locale="it_IT"
        @success="onSuccess"
        @error="onError"
        @load="onLoad"
        >
            <template #button="slotProps">
                <button ref="paymentBtnRef" @click="slotProps.submit" style="display:none"></button> <!-- al click manda la props -->
            </template>
        </v-braintree>
    </div>
</template>

<script>
export default {
    name: 'Payment',
    components: {
        
    },
    props: {
        authorization: {
            required: true,
            type: String
        }
        // formData: Object,
        // cart: Array
    },
    data () {
        return {
        error: ''
        }
    },
    methods: {
        onLoad () {
            this.$emit('loading')
        },
        onSuccess (payload) {
            const token = payload.nonce
            this.$emit('onSuccess', token)
        },
        onError (error) {
            const message = error.message
            if (message === 'No payment method is available.') {
                this.error = 'Seleziona un metodo di Pagamento'
            } else {
                this.error = message
            }
            this.$emit('onError', message)
        }
    }

}
</script>

<style>

</style>
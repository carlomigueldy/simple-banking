<template>
    <v-content>
        <v-card>
            <v-card-text>
                <div class="text-center mb-5">
                    <v-icon size="150">mdi-bank-transfer-in</v-icon>
                    <div class="display-2">Deposit</div>
                </div>
                <v-form>
                    <v-autocomplete
                    label="Account Number"
                    v-model="account_number"
                    placeholder="e.g., 1574910360"
                    :items="getAccountNumbers"
                    filled
                    rounded
                    ></v-autocomplete>
                    <v-text-field
                    label="Enter Amount"
                    prepend-icon="mdi-currency-usd"
                    v-model="amount"
                    type="number"
                    min="0"
                    step="0.01"
                    filled
                    rounded
                    placeholder="Enter an amount"
                    ></v-text-field>
                    <div class="text-center">
                        <v-btn 
                            @click="deposit()"
                            color="primary" 
                            depressed 
                            rounded>
                            Deposit Cash
                        </v-btn>
                    </div>
                </v-form>
            </v-card-text>
        </v-card>
    </v-content>
</template>

<script>
import { mapGetters, mapActions } from 'vuex'

export default {
    data: () => ({
        amount: '',
        account_number: '',
    }),

    created() {
        this.fetchAccounts()
    },

    computed: mapGetters(['getAccountNumbers']),

    methods: {
        deposit() {
            this.depositCash({
                amount: this.amount,
                account_number: this.account_number,
            })
        },
        
        ...mapActions(['fetchAccounts', 'depositCash']),
    }
}
</script>
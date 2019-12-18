<template>
    <div>
        <form @submit.prevent="onSubmit">
            <div class="row justify-content-center">
                <div class="col-lg-10 col-xl-10">
                    <div><h1>Добавление платежа</h1></div>
                    <div>
                        <p>
                            <label>Отправитель</label>
                            <select class="form-control" v-model="sender_id">
                                <option v-for="(account) in accounts" v-bind:value="account.id">
                                    {{ account.number_account }}
                                </option>
                            </select>
                        </p>
                        <p>
                            <label>Получатель</label>
                            <input class="form-control" v-model="number_account" type="text">
                        </p>
                        <p>
                            <label>Сумма</label>
                            <input class="form-control" v-model="transactions" type="number">
                        </p>
                        <button type="submit" class="btn btn-success">Отправить</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</template>

<script>
    export default {
        name: "PaymentAdd",
        props: {
            token: {
                type: String,
            }
        },
        data() {
            return {
                accounts: [],
                number_account: "",
                sender_id: "",
                transactions: "",
            }
        },
        async mounted() {
            let app = this;
            const response = await axios.get('http://payment/api/payment/account', {
                headers: {
                    'Authorization': 'Bearer ' + this.token
                }
            });
            app.accounts = response.data;
        },
        methods: {
            async onSubmit() {
                const response = await axios.post('http://payment/api/payment/add', {
                    api_token: this.token,
                    number_account: this.number_account,
                    sender_id: this.sender_id,
                    transactions: this.transactions,
                }, {
                    headers: {
                        'Authorization': 'Bearer ' + this.token
                    }
                });
                console.log(response);
                window.location.href = '/payments';
            },
        },
    }
</script>

<style scoped>

</style>

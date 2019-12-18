<template>
    <div>
        <form @submit.prevent="onSubmit">
            <div class="row justify-content-center">
                <div class="col-lg-10 col-xl-10">
                    <div><h1>Отправка заявки на добавление счета</h1></div>
                    <div>
                        <p>
                            <label>Доход</label>
                            <input class="form-control" v-model="income" type="number">
                        </p>
                        <p>
                            <label>Место работы</label>
                            <input class="form-control" v-model="placeJob" type="text">
                        </p>
                        <p>
                            <label>Адрес проживания</label>
                            <input class="form-control" v-model="residentAddress" type="text">
                        </p>
                        <p>
                            <label>Тип счета</label>
                            <select class="form-control" v-model="account">
                                <option v-for="(account) in accounts" v-bind:value="account.id">
                                    {{ account.name }}
                                </option>
                            </select>
                        </p>
                        <p>
                            <label>Тип кредита</label>
                            <select class="form-control" v-model="credit">
                                <option v-for="credit in credits" v-bind:value="credit.id">
                                    {{ credit.name }}
                                </option>
                            </select>
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
        name: "AddAplication",
        props: {
            token: {
                type: String,
            }
        },
        data() {
            return {
                accounts: [],
                credits: [],
                income: "",
                placeJob: "",
                residentAddress: "",
                account: "",
                credit: "",
            }
        },
        async mounted() {
            let app = this;
            const response1 = await axios.get('http://payment/api/applications/typeAccount', {
                headers: {
                    'Authorization': 'Bearer ' + this.token
                }
            });
            app.accounts = response1.data;
            // console.log(this.accounts);
            const response = await axios.get('http://payment/api/applications/typeCredit', {
                headers: {
                    'Authorization': 'Bearer ' + this.token
                }
            });
            app.credits = response.data;
            // console.log(this.credits);
        },
        methods: {
            async onSubmit() {
                const response = await axios.post('http://payment/api/applications/add', {
                    api_token: this.token,
                    income: this.income,
                    place_job: this.placeJob,
                    resident_address: this.residentAddress,
                    type_account_id: this.account,
                    type_credit_id: this.credit,
                }, {
                    headers: {
                        'Authorization': 'Bearer ' + this.token
                    }
                });
                console.log(response);
                window.location.href = '/home';
            },
        },
    }
</script>

<style scoped>

</style>

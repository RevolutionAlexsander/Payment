<template>
    <div>
        <div class="row justify-content-center">
            <div class="col-lg-10 col-xl-10">
                <a href="/applications/add" class="btn btn-success">Создание счета</a>
                <a href="/payments" class="btn btn-success">Платежи</a>
                <a href="/autopayments" class="btn btn-success">Автоплатежи</a>
                <!--                <router-link :to="{name: 'AddAplication'}" class="btn btn-success">Создание счета</router-link>-->
                <div><h1>Счета</h1></div>
                <div>
                    <table class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>Номер счета</th>
                            <th>Баланс</th>
                            <th>Долг</th>
                            <th>Дата закрытия счета</th>
                            <th>Тип кредита</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="(account) in accounts">
                            <th>{{account.number_account}}</th>
                            <th>{{account.balance}}</th>
                            <th>{{account.debt}}</th>
                            <th>{{account.date_closing}}</th>
                            <th>{{account.type_credit}}</th>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "Account",
        props: {
            token: {
                type: String,
            }
        },
        data() {
            return {
                accounts: [],
            }
        },
        async mounted() {
            let app = this;
            const response = await axios.get('api/accounts/all', {
                headers: {
                    'Authorization': 'Bearer ' + this.token
                }
            });
            app.accounts = response.data.data;
        },
    }
</script>

<style scoped>

</style>

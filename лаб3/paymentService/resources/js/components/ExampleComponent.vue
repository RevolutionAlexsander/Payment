<template>
    <div>
        <div class="row justify-content-center">
            <div class="col-lg-10 col-xl-10">
                <!--                <a href="/applications/add" class="btn btn-success">Создание счета</a>-->
                <!--                <a href="/payments" class="btn btn-success">Платежи</a>-->
                <div><h1>Счета</h1></div>
                <div>
                    <table class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>Отправитель</th>
                            <th>Получатель</th>
                            <th>Сумма</th>
                            <th>Дата платежа</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="(payment) in payments">
                            <th>{{payment.sender}}</th>
                            <th>{{payment.recipient}}</th>
                            <th>{{payment.sum}}</th>
                            <th>{{payment.date}}</th>
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
        name: "Payment",
        props: {
            token: {
                type: String,
            }
        },
        data() {
            return {
                payments: [],
            }
        },
        async mounted() {
            let app = this;
            const response = await axios.get('http://payment/api/payment/', {
                headers: {
                    'Authorization': 'Bearer ' + this.token
                }
            });
            app.payments = response.data.data;
        },
    }
</script>

<style scoped>

</style>

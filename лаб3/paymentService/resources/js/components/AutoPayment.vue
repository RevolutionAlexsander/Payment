<template>
    <div>
        <div class="row justify-content-center">
            <div class="col-lg-10 col-xl-10">
                <a href="/autopayments/add" class="btn btn-success">Добавить автоплатеж</a>
                <a href="/home" class="btn btn-success">Счета</a>
                <a href="/payments" class="btn btn-success">Платежи</a>
                <div><h1>История платежей</h1></div>
                <div>
                    <table class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>Отправитель</th>
                            <th>Получатель</th>
                            <th>Сумма</th>
                            <th>Дата платежа</th>
                            <th>Переодичность</th>
                            <th>Действие</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="(autopayment) in autopayments">
                            <th>{{autopayment.sender}}</th>
                            <th>{{autopayment.recipient}}</th>
                            <th>{{autopayment.sum}}</th>
                            <th>{{autopayment.date}}</th>
                            <th>{{autopayment.type_autopayment}}</th>
                            <th v-if="autopayment.frozen">
                                <button type="button" @click="noFrozen(autopayment.id)" class="btn btn-info">
                                    Разморозить
                                </button>
                            </th>
                            <th v-else>
                                <button type="button" @click="onClick(autopayment.id)" class="btn btn-danger">
                                    Заморозить
                                </button>
                            </th>
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
        name: "AutoPayment",
        props: {
            token: {
                type: String,
            }
        },
        data() {
            return {
                autopayments: [],
            }
        },
        async mounted() {
            let app = this;
            const response = await axios.get('http://payment/api/autopayment/', {
                headers: {
                    'Authorization': 'Bearer ' + this.token
                }
            });
            app.autopayments = response.data.data;
        },
        methods: {
            async onClick(id) {
                const response = await axios.post('api/autopayment/frozen', {
                    api_token: this.token,
                    id: id,
                }, {
                    headers: {
                        'Authorization': 'Bearer ' + this.token
                    }
                });
                console.log(response);
                window.location.href = '/autopayments';
            },
            async noFrozen(id) {
                const response = await axios.post('api/autopayment/noFrozen', {
                    api_token: this.token,
                    id: id,
                }, {
                    headers: {
                        'Authorization': 'Bearer ' + this.token
                    }
                });
                console.log(response);
                window.location.href = '/autopayments';
            }
        }
    }

</script>

<style scoped>

</style>

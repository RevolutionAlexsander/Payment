<template>
    <div>
        <div class="row justify-content-center">
            <div class="col-lg-10 col-xl-10">
                <div><h1>Заявки</h1></div>
                <div>
                    <table class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>Клиент</th>
                            <th>Заработок</th>
                            <th>Место работы</th>
                            <th>Адрес проживания</th>
                            <th>Тип счета</th>
                            <th>Тип кредита</th>
                            <th>Действие</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="(application) in applications">
                            <th>{{application.user}}</th>
                            <th>{{application.income}}</th>
                            <th>{{application.place_job}}</th>
                            <th>{{application.resident_address}}</th>
                            <th>{{application.type_account}}</th>
                            <th>{{application.type_credit}}</th>
                            <th>
                                <button type="button" @click="onClick(application.id, true)" class="btn btn-success">
                                    Одобрить
                                </button>
                                <button type="button" @click="onClick(application.id, false)" class="btn btn-danger">
                                    Отклонить
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
        name: "Application",
        props: {
            token: {
                type: String,
            }
        },
        data() {
            return {
                applications: [],
            }
        },
        async mounted() {
            let app = this;
            const response = await axios.get('api/applications/', {
                headers: {
                    'Authorization': 'Bearer ' + this.token
                }
            });
            app.applications = response.data.data;
        },
        methods: {
            async onClick(id, approval) {
                const response = await axios.post('api/applications/approval', {
                    id: id,
                    approval: approval
                }, {
                    headers: {
                        'Authorization': 'Bearer ' + this.token
                    }
                });
                console.log(response);
                window.location.href = '/home';
            }
        }
    }
</script>

<style scoped>

</style>

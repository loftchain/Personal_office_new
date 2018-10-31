<template>
    <div>
        <div class="dataTable">
            <table class="dataTable__list">
                <tr>
                    <th>Photo</th>
                    <th>Investor ID</th>
                    <th>E-mail</th>
                    <th>Full name</th>
                    <th>Date or birth</th>
                    <th>KYC</th>
                </tr>
                <tr class="dataTable__success" v-for="investor in investors">
                    <td>
                        <img :src="investor.img ? currentUrl + '/storage/' + investor.img : currentUrl + '/img/avatar.png'"
                             style="max-width: 75px; max-height: 75px;">
                    </td>
                    <td>{{ investor.id }}</td>
                    <td>{{ investor.email }}</td>
                    <td>{{ investor.name }}</td>
                    <td>{{ investor.personal.date_place_birth }}</td>
                    <td>
                        <button class="btn">more</button>
                    </td>
                <!--<tr class="dataTable__summary">-->
                    <!--<td colspan="3"><span class="dataTable__address" style="color: green">-->
                                                        <!--<strong>Status: </strong>{{ investor.confirmed }}-->
                                                    <!--</span>-->
                    <!--</td>-->
                    <!--<td colspan="3"><strong>Action: </strong><a class="dataTable__link" href="#">-->
                        <!--&lt;!&ndash;<a v-if="investor.confirmed" href="#"&ndash;&gt;-->
                           <!--&lt;!&ndash;class="badge badge-success">Подтвердить</a>&ndash;&gt;-->
                        <!--&lt;!&ndash;<a v-else href="#"&ndash;&gt;-->
                           <!--&lt;!&ndash;class="badge badge-danger">Отклонить</a>&ndash;&gt;-->
                        <!--&lt;!&ndash;No action&ndash;&gt;-->
                    <!--</a></td>-->
                <!--</tr>-->
                </tr>

                <!--if no personal-->
                <!--<tr class="dataTable__error">-->
                <!--<td colspan="6"><h3>No personals</h3></td>-->
                <!--</tr>-->
                <!--end no pesonal-->
            </table>
        </div>
    </div>
</template>

<script>
    import axios from 'axios';

    export default {
        name: "AdminVerificationTable",

        data() {
            return {
                investors: null,
                currentUrl: window.location.origin,
            }
        },

        mounted() {
            this.getUsers();
        },

        methods: {
            getUsers() {
                axios.post('test')
                    .then(res => {
                        this.investors = res.data;
                    });
            }
        }
    }
</script>

<style scoped>

</style>
<template>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h5>Tester</h5>
                <table class="table">
                    <thead>
                    <tr>
                        <th>Imię</th>
                        <th>Nazwisko</th>
                        <th>Email</th>
                        <th>Opis</th>
                        <th>Stanowisko</th>
                        <th>systemy testujace</th>
                        <th>systemy raportowe</th>
                        <th>zna selenium</th>
                        <th>akcje</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="user in usersPerPosition.testers">
                        <td>{{ user.firstName }}</td>
                        <td>{{ user.lastName }}</td>
                        <td>{{ user.email }}</td>
                        <td>{{ user.description }}</td>
                        <td>{{ user.position.name }}</td>
                        <td>{{ user.testSystems }}</td>
                        <td>{{ user.reportSystems }}</td>
                        <td>{{ user.isSelenium ? 'TAK' : 'NIE' }}</td>
                        <td>
                            <button type="button" v-on:click="edit(user.id)" class="m-1 btn btn-primary">edit</button>
                            <button type="button" v-on:click="remove(user.id)" class="m-1 btn btn-danger">remove</button>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-12">
                <h5>Developer</h5>
                <table class="table">
                    <thead>
                    <tr>
                        <th>Imię</th>
                        <th>Nazwisko</th>
                        <th>Email</th>
                        <th>Opis</th>
                        <th>Stanowisko</th>
                        <th>środowiska ide</th>
                        <th>języki programowania</th>
                        <th>zna mysql</th>
                        <th>akcje</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="user in usersPerPosition.developers">
                        <td>{{ user.firstName }}</td>
                        <td>{{ user.lastName }}</td>
                        <td>{{ user.email }}</td>
                        <td>{{ user.description }}</td>
                        <td>{{ user.position.name }}</td>
                        <td>{{ user.ideEnvironments }}</td>
                        <td>{{ user.programingLanguages }}</td>
                        <td>{{ user.isSql ? 'TAK' : 'NIE' }}</td>
                        <td>
                            <button type="button" v-on:click="edit(user.id)" class="m-1 btn btn-primary">edit</button>
                            <button type="button" v-on:click="remove(user.id)" class="m-1 btn btn-danger">remove</button>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-12">
                <h5>Project manager</h5>
                <table class="table">
                    <thead>
                    <tr>
                        <th>Imię</th>
                        <th>Nazwisko</th>
                        <th>Email</th>
                        <th>Opis</th>
                        <th>Stanowisko</th>
                        <th>metodologie prowadzenia projektów</th>
                        <th>systemy raportowe</th>
                        <th>zna scrum</th>
                        <th>akcje</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="user in usersPerPosition.projectManagers">
                        <td>{{ user.firstName }}</td>
                        <td>{{ user.lastName }}</td>
                        <td>{{ user.email }}</td>
                        <td>{{ user.description }}</td>
                        <td>{{ user.position.name }}</td>
                        <td>{{ user.projectMethodology }}</td>
                        <td>{{ user.reportSystems }}</td>
                        <td>{{ user.isScrum ? 'TAK' : 'NIE' }}</td>
                        <td>
                            <button type="button" v-on:click="edit(user.id)" class="m-1 btn btn-primary">edit</button>
                            <button type="button" v-on:click="remove(user.id)" class="m-1 btn btn-danger">remove</button>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<script>
    import api from './api.vue';

    export default {
        mixins: [api],
        data: function () {
            return {
                users: {},
            };
        },
        created: async function () {
            this.users = await this.get('/api/user');
        },
        methods: {
            edit: function(user_id) {
                window.location.href = '/admin/edit/user/' + user_id;
            },
            remove: async function(user_id) {
                await this.delete('/api/user/' + user_id);
                // refresh list
                this.users = await this.get('/api/user');
            }
        },
        computed: {
            usersPerPosition: function () {
                let r = {
                    testers: [],
                    developers: [],
                    projectManagers: [],
                };
                for (let i = 0, j = this.users.length; i < j; i++) {
                    console.log(this.users[i].position.name);
                    if (this.users[i].position.name === 'tester') {
                        r.testers.push(this.users[i]);
                    }
                    if (this.users[i].position.name === 'developer') {
                        r.developers.push(this.users[i]);
                    }
                    if (this.users[i].position.name === 'project manager') {
                        r.projectManagers.push(this.users[i]);
                    }
                }
                return r;
            }
        },
    }
</script>

<style scoped>

</style>
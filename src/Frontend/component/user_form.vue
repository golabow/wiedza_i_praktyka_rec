<template>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div v-if="response.code === 200" class="alert alert-success" role="alert">
                    Poprawnie zapisano!
                </div>
                <div v-if="response.code === 500" class="alert alert-danger" role="alert">
                    Ups! Popraw błędy w formularzu przed zapisem
                </div>
                <form ref="form" v-on:submit.prevent="save">
                    <div class="form-row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="first-name">Imię</label>
                                <input name="firstName" v-model="firstName" :class="{'is-invalid': isError('firstName')}" type="text" class="form-control isInvalid"
                                       id="first-name">
                                <div v-if="isError('firstName')" class="invalid-feedback">
                                    {{ errors.firstName }}
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="last-name">Nazwisko</label>
                                <input name="lastName" v-model="lastName" :class="{'is-invalid': isError('lastName')}" type="text" class="form-control"
                                       id="last-name">
                                <div v-if="isError('lastName')" class="invalid-feedback">
                                    {{ errors.lastName }}
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input name="email" v-model="email" :class="{'is-invalid': isError('email')}" type="text" class="form-control"
                                       id="email">
                                <div v-if="isError('email')" class="invalid-feedback">
                                    {{ errors.email }}
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="description">Opis</label>
                                <textarea name="description" v-model="description" :class="{'is-invalid': isError('description')}" class="form-control"
                                          id="description"></textarea>
                                <div v-if="isError('description')" class="invalid-feedback">
                                    {{ errors.description }}
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="position">Stanowisko</label>
                                <select name="position" v-model="position" :class="{'is-invalid': isError('position')}" class="form-control" id="position">
                                    <option v-for="position in positions" :value="position.id">{{ position.name }}
                                    </option>
                                </select>
                                <div v-if="isError('position')" class="invalid-feedback">
                                    {{ errors.position }}
                                </div>
                            </div>
                            <template v-if="position === 1">
                                <div class="form-group">
                                    <label for="test-systems">systemy testujące</label>
                                    <textarea name="testSystems" v-model="testSystems" class="form-control"
                                              id="test-systems"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="report-systems">systemy raportujące</label>
                                    <textarea name="reportSystems" v-model="reportSystems" class="form-control"
                                              id="report-systems"></textarea>
                                </div>
                                <div class="form-group">
                                    <div class="form-check">
                                        <input name="isSelenium" v-model="isSelenium" value="1" class="form-check-input"
                                               type="checkbox"
                                               id="is-selenium">
                                        <label class="form-check-label" for="is-selenium">
                                            zna selenium
                                        </label>
                                    </div>
                                </div>
                            </template>
                            <template v-if="position === 2">
                                <div class="form-group">
                                    <label for="ide-environments">Środowiska programistyczne</label>
                                    <textarea name="ideEnvironments" v-model="ideEnvironments" class="form-control"
                                              id="ide-environments"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="programing-languages">języki programowania</label>
                                    <textarea name="programingLanguages" v-model="programingLanguages"
                                              class="form-control"
                                              id="programing-languages"></textarea>
                                </div>
                                <div class="form-group">
                                    <div class="form-check">
                                        <input name="isSql" v-model="isSql" value="1" class="form-check-input" type="checkbox"
                                               id="is-sql">
                                        <label class="form-check-label" for="is-sql">
                                            zna mysql
                                        </label>
                                    </div>
                                </div>
                            </template>
                            <template v-if="position === 3">
                                <div class="form-group">
                                    <label for="project-methodology">metodologie prowadzenia projektów</label>
                                    <textarea name="projectMethodology" v-model="projectMethodology"
                                              class="form-control"
                                              id="project-methodology"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="report-systems">systemy raportowe</label>
                                    <textarea name="reportSystems" v-model="reportSystems" class="form-control"
                                              id="report-systems"></textarea>
                                </div>
                                <div class="form-group">
                                    <div class="form-check">
                                        <input name="isScrum" v-model="isScrum" value="1" class="form-check-input" type="checkbox"
                                               id="is-scrum">
                                        <label class="form-check-label" for="is-scrum">
                                            zna scrum
                                        </label>
                                    </div>
                                </div>
                            </template>
                        </div>
                        <div class="col-12">
                            <button class="btn btn-primary">Zapisz</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
    import api from './api.vue';

    export default {
        mixins: [api],
        props: {
            user: {
                type: Object,
                default: null
            }
        },
        data: function () {
            return {
                firstName: this.getUserProp('firstName'),
                lastName: this.getUserProp('lastName'),
                email: this.getUserProp('email'),
                description: this.getUserProp('description'),
                position: this.getUserProp('position') ? this.getUserProp('position').id : null,
                testSystems: this.getUserProp('testSystems'),
                reportSystems: this.getUserProp('reportSystems'),
                isSelenium: this.getUserProp('isSelenium'),
                ideEnvironments: this.getUserProp('ideEnvironments'),
                programingLanguages: this.getUserProp('programingLanguages'),
                isSql: this.getUserProp('isSql'),
                projectMethodology: this.getUserProp('projectMethodology'),
                isScrum: this.getUserProp('isScrum'),
                positions: [],
                response: {code: null, errors: null},
                errors: {},
                mode: 'add',
            };
        },
        created: async function () {
            this.positions = await this.get('/api/position');
            if (this.user !== null) {
                this.mode = 'edit';
            } else {
                this.position = this.positions[0].id;
            }
        },
        methods: {
            save: async function () {
                let form_data = $(this.$refs['form']).serializeArray();
                let data = {};
                for (var i = 0; i < form_data.length; i++) {
                    data[form_data[i].name] = form_data[i].value;
                }

                if (this.mode === 'add') {
                    this.response = await this.post('/api/user', data);
                }

                if (this.mode === 'edit') {
                    this.response = await this.put('/api/user/' + this.user.id, data);
                }

                this.errors = this.response.errors;
            },
            isError: function(field) {
                return this.errors.hasOwnProperty(field);
            },
            getUserProp: function(prop) {
                if (this.user === null) {
                    return null;
                }
                if (this.user.hasOwnProperty(prop)) {
                    return this.user[prop];
                }
                return null;
            }
        }
    }
</script>

<style scoped>
    .user-form {
    }
</style>
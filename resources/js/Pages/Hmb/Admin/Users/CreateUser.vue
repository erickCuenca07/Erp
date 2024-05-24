<template>
    <Layout>
        <Top-bar :breadcrumbs="breadcrumbs" />
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="multisteps-form mb-5">
                        <hr>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 col-lg-8 m-auto">
                                    <form class="multisteps-form__form mb-8" @submit.prevent="submit">
                                        <div class="card multisteps-form__panel p-3 border-radius-xl bg-white js-active" data-animation="FadeIn">
                                            <h5 class="font-weight-bolder mb-0">Datos Sobre el usuario</h5>
                                            <p class="mb-0 text-sm">Rellene estos campo</p>
                                            <div class="multisteps-form__content">
                                                <div class="row mt-3">
                                                    <div class="col-12 col-sm-6">
                                                        <label>Nombre</label>
                                                        <input required class="multisteps-form__input form-control rounded" type="text" placeholder="eg. Michael" v-model="form.name"/>
                                                    </div>
                                                </div>
                                                <div class="row mt-3">
                                                    <div class="col-12 col-sm-6 mt-3 mt-sm-0">
                                                        <label>Email </label>
                                                        <input required v-model="form.email" class="multisteps-form__input form-control rounded" type="email" placeholder="eg. hombedspain@gmail.com" />
                                                    </div>
                                                </div>
                                                <div class="row mt-3">
                                                    <div class="col-12 col-sm-6">
                                                        <label>Contraseña</label>
                                                        <input required v-model.trim.lazy="form.password" :minlength="6" class="multisteps-form__input form-control rounded" type="password" placeholder="******" />
                                                        <span v-if="form.password &&form.password.length < 6" class="text-danger">
                                                            La contraseña debe tener al menos 6 caracteres.
                                                        </span>
                                                    </div>
                                                    <div class="col-12 col-sm-6 mt-3 mt-sm-0">
                                                        <label>Repite Contraseña</label>
                                                        <input required v-model.trim.lazy="form.password_confirmation" :minlength="6" class="multisteps-form__input form-control rounded" type="password" placeholder="******" />
                                                        <span v-if="form.password_confirmation && form.password_confirmation.length < 6" class="text-danger">
                                                            La contraseña debe tener al menos 6 caracteres.
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="button-row d-flex mt-4">
                                                    <Link :href="route('admin.users.index')" class="btn bg-gradient-dark  mb-0 js-btn-prev" >volver</Link>
                                                    <button class="btn btn-twitter ms-auto mb-0 js-btn-next" >Guardar</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- table -->
                    </div>
                </div>
            </div>
        </div>
    </Layout>
</template>

<script>
import { Link } from '@inertiajs/inertia-vue3';
import Layout from '../../../../Layouts/Layout.vue';
import TopBar from '../../../../Layouts/Navbar/Topbar.vue';
import {toast} from "vue3-toastify";

const notify = ( message, type="warning") =>
    toast(message, {
        type: type,
        theme: "auto",
    });
    export default {
        name: "CreateUser",
        components: {
            Layout,
            TopBar,
            Link
        },
        props: {
        },
        data() {
            return {
                breadcrumbs: {
                    title: 'Creación de Usuarios',
                    breadcrumb: {
                        title: 'Usuarios',
                        url: route('admin.users.index'),
                    }
                },
                form: {
                    name: '',
                    email: '',
                    password: '',
                    password_confirmation: '',
                },

            }
        },
        methods: {
            submit() {
                if (this.form.password !== this.form.password_confirmation) {
                    notify('Las contraseñas no coinciden', 'error');
                    return;
                }
                axios.post(route('admin.users.insert'), this.form)
                    .then((response) => {
                        console.log(response.data);
                        notify(response.data[0], response.data[1]);
                        this.form = {
                            name: '',
                            email: '',
                            password: '',
                            password_confirmation: '',
                        };
                        document.getElementById('lastName').value = '';
                    }).catch((error) => {
                        notify(error.response.data.message, 'error');
                    })
            }
        }
    }
</script>

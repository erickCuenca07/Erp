<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3';
import AuthenticationCard from '@/Components/AuthenticationCard.vue';
import AuthenticationCardLogo from '@/Components/AuthenticationCardLogo.vue';
import Checkbox from '@/Components/Checkbox.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';

const form = useForm({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
    terms: false,
});

const submit = () => {
    form.post(route('register'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
</script>

<template>
    <div class="page-header min-vh-100" style="background-image: url('https://raw.githubusercontent.com/creativetimofficial/public-assets/master/argon-dashboard-pro/assets/img/signup-basic.jpg');">
        <span class="mask bg-gradient-dark opacity-6"></span>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-4 col-md-7">
                    <div class="card z-index-0">
                        <div class="card-header text-center pt-4">
                            <h5>Registrate</h5>
                        </div>
                        <div class="card-body">
                            <form role="form" class="text-start" @submit.prevent="submit">
                                <div class="mb-3">
                                    <input type="text" v-model="form.name" class="form-control rounded" placeholder="Nombre" aria-label="Name">
                                    <InputError class="mt-2" :message="form.errors.name" />
                                </div>
                                <div class="mb-3">
                                    <input type="email" v-model="form.email" class="form-control rounded" placeholder="Email" aria-label="Email">
                                    <InputError class="mt-2" :message="form.errors.email" />
                                </div>
                                <div class="mb-3">
                                    <input type="password" v-model="form.password" class="form-control rounded" placeholder="Contraseña" aria-label="Password">
                                    <InputError class="mt-2" :message="form.errors.password" />
                                </div>
                                <div class="mb-3">
                                    <input type="password" v-model="form.password_confirmation" class="form-control rounded" placeholder="Confirma la contraseña" aria-label="Password">
                                    <InputError class="mt-2" :message="form.errors.password_confirmation" />
                                </div>
                                <div class="form-check form-check-info text-start">
                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" checked>
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Yo acepto los <a href="javascript:;" class="text-dark font-weight-bolder">Terminos y Condiciones</a>
                                    </label>
                                    <InputError class="mt-2" :message="form.errors.terms" />
                                </div>
                                <div class="text-center">
                                    <button class="btn bg-gradient-dark w-100 my-4 mb-2">Registrarse</button>
                                </div>
                                <p class="text-sm mt-3 mb-0">¿Ya tienes una cuenta? <a :href="route('login')" class="text-dark font-weight-bolder">Inicia sesión</a></p>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

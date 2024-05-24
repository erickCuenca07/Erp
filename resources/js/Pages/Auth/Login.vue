<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3';
import InputError from '@/Components/InputError.vue';

defineProps({
    canResetPassword: Boolean,
    status: String,
});

const form = useForm({
    email: '',
    password: '',
    remember: false,
});

const submit = () => {
    form.transform(data => ({
        ...data,
        remember: form.remember ? 'on' : '',
    })).post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};
</script>

<template>
    <div class="page-header min-vh-100" style="background-image: url('/img/Logo-Home-Bed-Spain-banner.jpg')">
        <span class="mask bg-gradient-dark opacity-6"></span>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-4 col-md-7">
                    <div class="card border-0 mb-0">
                        <div class="card-header bg-transparent">
                            <h5 class="text-dark text-center mt-2 mb-3">Bienvenido!</h5>
                            <div class="btn-wrapper text-center">
                                <p> Introduce tu email y contraseña para iniciar sesión.
                                </p>
                            </div>
                        </div>
                        <div class="card-body px-lg-5 pt-0">
                            <div class="text-center text-muted mb-4">
                            </div>
                            <form role="form" class="text-start" @submit.prevent="submit">
                                <div class="mb-3">
                                    <input type="email" class="form-control rounded" v-model="form.email" placeholder="Email" aria-label="Email" autofocus>
                                    <InputError class="mt-2" :message="form.errors.email" />
                                </div>
                                <div class="mb-3">
                                    <input type="password" class="form-control rounded" v-model="form.password" placeholder="Password" aria-label="Password">
                                    <InputError class="mt-2" :message="form.errors.password" />
                                </div>
                                <div class="text-center">
                                    <button class="btn btn-primary w-100 my-4 mb-2" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">Entrar</button>
                                </div>
                                <div class="mb-2 position-relative text-center">
                                    <p class="text-sm font-weight-bold mb-2 text-secondary text-border d-inline z-index-2 bg-white px-3">
                                        o
                                    </p>
                                </div>
                                <div class="text-center">
                                    <Link :href="route('register')" class="btn bg-gradient-dark w-100 mt-2 mb-4">Registrarse</Link>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

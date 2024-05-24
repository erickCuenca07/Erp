<template>
<layout>
    <TopBar :breadcrumbs="breadcrumbs" />
        <div class="container-fluid">
            <div class="row">
                <div class="col">
                    <div class="card">
                        <div class="card-header pb-0">
                            <h3 class="card-title">Editar Permisos para el rol {{permissionsGroup.name}}</h3>
                        </div>
                        <hr>
                        <div class="card-body">
                            <form @submit.prevent="this.update">
                                <div class="pl-lg-4">
                                    <input type="hidden" v-model="permissionsGroup.id" />
                                    <div class="form-group col-md-6">
                                        <label class="form-control-label" for="input-name">Nombre</label>
                                        <input v-model="permissionsGroup.name" type="text" name="name" id="input-name" class="form-control" placeholder="Nombre" required autofocus>
                                    </div>
                                    <div class="form-group col-md-10">
                                        <label class="form-control-label">Permisos asociados: </label>
                                        <div class="row mt-3">
                                            <div class="col-sm-6 col-lg-4" v-for="permission in permissions" >
                                                <div class="form-check">
                                                    <input class="form-check-input permissions" type="checkbox" :value="permission.id" :id="'permission'+permission.id"
                                                           :checked="permissionsGroup ? check(permission.id, permissionsGroup['permissions']) : false">
                                                    <label class="custom-control-label" :for="'permission'+permission.id">
                                                        {{ permission.name }}
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="text-left">
                                        <Link class="btn btn-secondary my-4 mr-4" :href="route('admin.permissions.index')">Volver</Link>
                                        <button  class="btn btn-primary mt-4 mb-4">{{ permissionsGroup.id ? 'Guardar' : 'Crear' }}</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</layout>
</template>

<script>
import { Link } from '@inertiajs/inertia-vue3'
import Layout from '../../../../Layouts/Layout.vue';
import TopBar from '../../../../Layouts/Navbar/Topbar.vue';
import {toast} from "vue3-toastify";

const notify = ( message, type="warning") =>
    toast(message, {
        type: type,
        theme: "auto",
    });

export default {
    name: "EditGroupRole",
    components: {
        Layout,
        TopBar,
        Link
    },
    props: {
        permissionsGroup: Object,
        permissions: Object,
    },
    data() {
        return {
            breadcrumbs: {
                title: 'Editar Roles',
                breadcrumb: {
                    title: 'Admin',
                    url: null
                }
            },
        }
    },
    methods: {
        check(id, list) {
            return list.some(item => item.id === id);
        },
        update(){
            const checkedPermissions = document.querySelectorAll('input[type="checkbox"].permissions:checked');
            const permissions = [];
            checkedPermissions.forEach((permission) => {
                permissions.push(parseInt(permission.value));
            });
            const data = {
                id: this.permissionsGroup.id,
                name:this.permissionsGroup.name,
                permission: permissions
            }
            axios.post(route('admin.permissions.update'), data)
                .then(response => {
                    notify(response.data[0], response.data[1]);
                    setTimeout(() => {
                        window.location.reload();
                    }, 3000);
                })
                .catch(error => {
                    notify(error.response.data.message, 'error');
                });
        }
    }
}
</script>
<style scoped>

</style>

<template>
<Layout>
    <TopBar :breadcrumbs="breadcrumbs"/>
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header pb-0">
                        <h3 class="card-title">Estas editando el usuario: <span class="text-uppercase text-primary">{{user.name}}</span></h3>
                    </div>
                    <hr>
                    <div class="car-body">
                        <form @submit.prevent="this.update">
                            <div class="pl-lg-4">
                                <div class="form-group col-md-6">
                                    <label class="form-control-label" for="input-name">Nombre</label>
                                    <input v-model="userSelected.name" type="text" name="name" id="input-name" class="form-control rounded" placeholder="Nombre" required autofocus>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="form-control-label" for="input-email">Email</label>
                                    <input v-model="userSelected.email" type="email" name="email" id="input-email" class="form-control rounded" placeholder="Email" required>
                                </div>
                                <div class="form-goup cold-md-10">
                                    <label class="form-control-label">Roles</label>
                                    <div class="row mb-3 mt-2">
                                        <div class="col-sm-6 col-lg-4" v-for="role in this.rolesSelected">
                                            <div class="form-check">
                                                <input class="form-check-input role" type="checkbox" :value="role.id" :id="'role'+role.id" :checked="user ? checkRoles(role.id, userSelected['roles']) : false" @click="selectPermissions(role)">
                                                <label class="custom-control-label" :for="'role'+role.id">
                                                    {{ role.name }}
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <label class="form-control-label">Permisos asociados: </label>
                                    <div class="row mt-3">
                                        <div class="col-sm-6 col-lg-4" v-for="permission in this.permissionsCreate" >
                                            <div class="form-check">
                                                <input class="form-check-input permissions" type="checkbox" :value="permission.id" :id="'permission'+permission.id"
                                                     v-model="permissionsSelected" :checked="checkPermissions(permission.id, userSelected['permissions'])">
                                                <label class="custom-control-label" :for="'permission'+permission.id">
                                                    {{ permission.name }}
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-left">
                                    <Link class="btn btn-secondary my-4 mr-4" :href="route('admin.users.index')">Volver</Link>
                                    <button  class="btn btn-primary mt-4 mb-4">{{ user.id ? 'Guardar' : 'Crear' }}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</Layout>
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
    name: "EditUser",
    components: {
        Layout,
        TopBar,
        Link
    },
    props: {
        user: Object,
        permissions: Object,
        roles: Object
    },
    data() {
        return {
            breadcrumbs: {
                title: 'Editar Usuarios',
                breadcrumb: {
                    title: 'Usuarios',
                    url: route('admin.users.index')
                }
            },
            permissionsSelected: [],
            userSelected: [],
            rolesSelected: [],
            permissionsCreate: [],
        }
    },
    created() {
        this.userSelected = this.user;
        this.permissionsCreate = this.permissions;
        this.rolesSelected = this.roles
        this.selectPermissions(this.userSelected);
    },
    methods: {
        checkRoles(id, list) {
            return list.some(item => item.id === id);
        },
        checkPermissions(id, list) {
            return list.some(item => item.id === id);
        },
        selectPermissions(role) {
            if (role) {
                this.permissionsSelected = role.permissions.map(permission => permission.id);
            } else {
                this.permissionsSelected = [];
            }
        },
        update(){
            let checkedPermissions = document.querySelectorAll('input[type=checkbox].permissions:checked');
            let checkedRoles = document.querySelectorAll('input[type=checkbox].role:checked');
            this.user.permissions = [];
            this.user.roles = [];
            checkedPermissions.forEach(permission => {
                this.user.permissions.push(parseInt(permission.value));
            });
            checkedRoles.forEach(role => {
                this.user.roles.push(parseInt(role.value));
            });
            const data = {
                id: this.user.id,
                name: this.user.name,
                email: this.user.email,
                permissions: this.user.permissions,
                roles: this.user.roles
            }
            axios.post(route('admin.users.update'),data)
                .then((response) => {
                    notify(response.data[0], response.data[1]);
                    setTimeout(() => {
                        window.location.reload();
                    }, 3000);
                }).catch((error) => {
                    if (error.response){
                        notify(error.response.data.message, 'error');
                    }
                })
        }
    },
}
</script>

<style scoped>

</style>

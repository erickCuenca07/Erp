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
                            <form>
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
        }
    }
}
</script>
<style scoped>

</style>

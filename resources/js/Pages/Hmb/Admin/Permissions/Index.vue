<template>
    <Layout>
        <Top-bar :breadcrumbs="breadcrumbs" />
        <div class="container-fluid mt-6">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header pb-0">
                            <h3 class="card-title">Listado de Permisos</h3>
                        </div>
                        <hr>
                        <!-- table -->
                        <div class="card-body">
                            <span>
                                <button class="btn btn-info" data-bs-toggle="modal" data-bs-target="#modal-create-permission" v-if="this.$permissions(this.$page.props.auth.user, 'admin-crear-permiso')">Crear Permiso</button>
                            </span>
                            <div class="table-responsive">
                                <table class="table align-items-center table-flush">
                                    <thead class="thead-light">
                                        <tr>
                                            <th class="text-uppercase text-center">Roles </th>
                                            <th class="text-uppercase text-center">Permisos Asociados</th>
                                            <th class="text-uppercase text-center">Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="group in this.permissionsGroup">
                                            <td class="text-center">{{ group.name }}</td>
                                            <td class="text-center">
                                                <span v-if="group.permissions.length > 0" class="text-center">
                                                    <div v-if="group.permissions.length > 2" class="text-center">
                                                        <span v-for="(permission, index) in group.permissions.slice(0, 2)" :key="index" class="text-center">
                                                            {{ permission }} <span v-if="index !== 1 || group.permissions.length > 2">, </span>
                                                        </span>
                                                        <span v-if="group.permissions.length > 2">...</span>
                                                        <span v-if="group.permissions.length > 2" class="text-info cursor-pointer" @click="transferInfo(group.name, group.permissions)" data-bs-toggle="modal" data-bs-target="#modal-show-permissions">
                                                            y {{ group.permissions.length - 2 }} mas
                                                        </span>
                                                    </div>
                                                    <div v-else>
                                                        <span v-for="(permission, index) in group.permissions" :key="index" class="text-center">
                                                            {{ permission }} <span v-if="index !== group.permissions.length - 1">, </span>
                                                        </span>
                                                    </div>
                                                </span>
                                                <span v-else-if="group.name === 'SuperAdmin'" class="text-info" >Todos</span>
                                                <span v-else > -</span>
                                            </td>
                                            <!-- Actions -->
                                            <td class="text-center" >
                                                <Link v-if="this.$permissions(this.$page.props.auth.user, 'admin-permisos-editar')" class="btn btn-primary" :href="route('admin.permissions.editGroupRole', group.id)">
                                                    <i class="ni ni-ruler-pencil"></i>
                                                </Link>
                                                <Link v-if="group.name !== 'SuperAdmin'" class="btn btn-danger ml-2">
                                                    <i class="fa fa-trash-can"></i>
                                                </Link>
                                            </td>
                                            <ShowGroupPermissions  :roleName="this.roleName" :modalPermissions="this.modalPermissions" ></ShowGroupPermissions>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <CreatePermission></CreatePermission>
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
import ShowGroupPermissions from "@/Pages/Hmb/Admin/Components/Modals/ShowGroupPermissions.vue";
import CreatePermission from "@/Pages/Hmb/Admin/Components/Modals/CreatePermission.vue";

export default {
    name: "Permissions Index",
    components: {
        Layout,
        TopBar,
        Link,
        ShowGroupPermissions,
        CreatePermission
    },
    props: {
        permissionsGroup: Object,
        permissions: Object,
    },
    data() {
        return {
            breadcrumbs: {
                title: 'Lista de Permisos',
                breadcrumb: {
                    title: 'Admin',
                    url: null
                }
            },
            ellipsis: {
                'width': '200px',
                'overflow': 'hidden',
                'text-overflow': 'ellipsis',
            },
            roleName: null,
            modalPermissions: null,
        }
    },
    methods: {
        transferInfo(roleName, permissions) {
            this.roleName = roleName;
            let namePermissions = '';
            permissions.forEach(index =>{
                namePermissions += index + ', ';
            });
            namePermissions = namePermissions.slice(0, -2);
            this.modalPermissions = namePermissions;
        },
    }
}
</script>

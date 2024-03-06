<template>
    <Layout>
        <Top-bar :breadcrumbs="breadcrumbs" />
        <div class="container-fluid mt-6">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header pb-0">
                            <h3 class="card-title">Listado de usuarios</h3>
                        </div>
                        <hr>
                        <!-- table -->
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table align-items-center table-flush">
                                    <thead class="thead-light">
                                        <tr>
                                            <th class="text-uppercase text-center">ID</th>
                                            <th class="text-uppercase text-center">Nombre</th>
                                            <th class="text-uppercase text-center">Email</th>
                                            <th class="text-uppercase text-center">Permisos</th>
                                            <th class="text-uppercase text-center">Roles</th>
                                            <th class="text-uppercase text-center">Fecha de Creación</th>
                                            <th class="text-uppercase text-center">Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <tr v-for="user in users" :key="user.id">
                                        <td class="text-center">{{ user.id }}</td>
                                        <td class="text-center">{{ user.name }}</td>
                                        <td class="text-center">{{ user.email }}</td>
                                        <td class="text-center">
                                            <span class="text-center" v-if="user.permissions.length === 0">
                                              <i class="fa-solid fa-check text-primary"></i>
                                            </span>
                                            <span class="text-center" v-else>
                                              <i class="fa-solid fa-xmark text-danger"></i>
                                            </span>
                                        </td>
                                        <td class="text-center" v-if="user.roles.length === 0">-</td>
                                        <td class="text-center" v-else>
                                            <div :style="user.permissions.length > 0 ? ellipsis : ''">
                                              <span class="text-center" v-for="(permission,index) in user.roles" >
                                                    {{ permission.name }}<span v-if="index !== user.roles.length - 1">, </span>
                                              </span>
                                            </div>
                                            <button class="btn btn-sm btn-primary text-center" v-if="user.permissions.length > 0"

                                                    data-bs-toggle="modal" data-bs-target="#modalUser">
                                                Ver más
                                            </button>
                                        </td>
                                        <td class="text-center">{{ user.created_at }}</td>
                                        <td></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
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

    export default {
      name: "UserIndex",
      components: {
        Layout,
        TopBar,
        Link,
      },
      props: {
        users: Object
      },
      data() {
        return {
          breadcrumbs: {
            title: 'Lista de Usuarios',
            breadcrumb: {
              title: 'Admin',
              url: null
            }
          },
          ellipsis: {
            'width': '200px',
            'overflow': 'hidden',
            'text-overflow': 'ellipsis',
          }
        }
      },

    }
    </script>

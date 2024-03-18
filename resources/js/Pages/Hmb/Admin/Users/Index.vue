<template>
    <Layout>
        <Top-bar :breadcrumbs="breadcrumbs" />
        <div class="container-fluid mt-6">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header pb-0">
                            <h3 class="card-title">Listado de usuarios</h3>
                            <Link :href="route('admin.users.create')" class="btn btn-twitter "><i class="fa-solid fa-user-plus"></i> Crear Usuario</Link>
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
                                            <th class="text-uppercase text-center">Roles</th>
                                            <th class="text-uppercase text-center">Permisos</th>
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
                                            <span class="text-center" v-if="user.roles.length !== 0">
                                              <i class="fa-solid fa-check text-primary"></i>
                                            </span>
                                            <span class="text-center" v-else>
                                              <i class="fa-solid fa-xmark text-danger"></i>
                                            </span>
                                        </td>
                                        <td class="text-center">
                                            <span v-if="user.permissions.length > 0" class="text-center">
                                                <div v-if="user.permissions.length > 2" class="text-center">
                                                    <span v-for="(permission, index) in user.permissions.slice(0, 2)" :key="index" class="text-center">
                                                        {{ permission.name }} <span v-if="index !== 1 || user.permissions.length > 2">, </span>
                                                    </span>
                                                    <span v-if="user.permissions.length > 2">...</span>
                                                    <span v-if="user.permissions.length > 2" class="text-info cursor-pointer" @click="transferInfo(user.name, user.permissions)" data-bs-toggle="modal" data-bs-target="#modal-show-permissions">
                                                        y {{ user.permissions.length - 2 }} mas
                                                    </span>
                                                </div>
                                                <div v-else>
                                                    <span v-for="(permission, index) in user.permissions" :key="index" class="text-center">
                                                        {{ permission }} <span v-if="index !== user.permissions.length - 1">, </span>
                                                    </span>
                                                </div>
                                            </span>
                                            <span v-else-if="user.roles.some(role => role.name === 'SuperAdmin')" class="text-info" >Todos</span>
                                            <span v-else > -</span>
                                        </td>
                                        <td class="text-center">{{ user.created_at }}</td>
                                        <td class="text-center">
                                            <Link :href="route('admin.users.edit', user.id)" class="btn btn-sm btn-primary text-center">Editar</Link>
                                            <button v-if="user.name !== 'SuperAdmin'" @click="showAlertDeleteUser(user.id)" class="btn btn-danger ml-2">
                                                <i class="fa fa-trash-can"></i>
                                            </button>
                                        </td>
                                        <ShowGroupPermissions  :roleName="this.roleName" :modalPermissions="this.modalPermissions" ></ShowGroupPermissions>
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
    import {toast} from "vue3-toastify";
    import ShowGroupPermissions from "@/Pages/Hmb/Admin/Components/Modals/ShowGroupPermissions.vue";

    const notify = ( message, type="warning") =>
        toast(message, {
            type: type,
            theme: "auto",
        });
    export default {
      name: "UserIndex",
      components: {
        ShowGroupPermissions,
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
          },
          roleName: null,
          modalPermissions: null,
        }
      },
      methods: {
          transferInfo(roleName, permissions) {
              console.log(permissions)
              this.roleName = roleName;
              let namePermissions = '';
              permissions.forEach(index =>{
                  namePermissions += index.name + ', ';
              });
              namePermissions = namePermissions.slice(0, -2);
              this.modalPermissions = namePermissions;
          },
          showAlertDeleteUser(userId) {
              const data = {
                  'id': userId
              }
              this.$swal({
                  title: '¿Seguro que deseas borrar este usuario?',
                  icon: 'warning',
                  showCancelButton: true,
                  confirmButtonColor: '#3085d6',
                  cancelButtonColor: '#d33',
                  confirmButtonText: 'Si, borrar usuario',
                  cancelButtonText: 'Cancelar',
              }).then((result) => {
                  if (result.isConfirmed) {
                      axios.post(route('admin.users.delete'), data)
                          .then((response) => {
                              console.log(response.data);
                              notify(response.data[0], response.data[1]);
                              setTimeout(() => {
                                  window.location.reload();
                              }, 3000);
                          }).catch((error) => {
                              notify(error.response.data.message, 'error');
                          })
                  }
              })
          }
      }
    }
    </script>

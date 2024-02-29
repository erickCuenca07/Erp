<template>
    <div class="min-height-300 bg-primary position-absolute w-100"></div>
    <aside class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4 " id="sidenav-main">
    <div class="sidenav-header">
      <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
      <a class="navbar-brand m-0">
        <img src="/assets/img/logo-ct-dark.png" class="navbar-brand-img h-100" alt="main_logo">
        <span class="ms-1 font-weight-bold">Homebed Spain</span>
      </a>
    </div>
        <hr class="horizontal dark mt-0">
        <div class="navbar-collapse w-auto h-auto" id="sidenav-collapse-main">
            <ul class="navbar-nav">
                <li class="nav-item ">
                    <Link :href="route('index')"
                          class="nav-link" :class="{'active' : $page.component === 'Hmb/Dashboard' }">
                        <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fa fa-home text-secondary text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Panel</span>
                    </Link>
                </li>
                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#navbar-admin" class="nav-link " aria-controls="navbar-admin" role="button">
                        <div class="icon icon-shape icon-sm text-center d-flex align-items-center justify-content-center">
                        <i class="ni ni-ui-04 text-info text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Admin</span>
                    </a>
                    <div class="" id="navbar-admin">
                        <ul class="nav ms-4">
                            <li class="nav-item">
                                <Link class="nav-link" :href="route('admin.users.index')">
                                <span class="sidenav-normal">Usuarios</span>
                                </Link>
                            </li>
                            <li class="nav-item ">
                                <Link class="nav-link" >
                                <span class="sidenav-normal">Permisos</span>
                                </Link>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#navbar-clients" class="nav-link " aria-controls="navbar-clients" role="button">
                        <div class="icon icon-shape icon-sm text-center d-flex align-items-center justify-content-center">
                        <i class="fa-solid fa-users text-warning text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Clientes</span>
                    </a>
                    <div class="" id="navbar-clients">
                        <ul class="nav ms-4">
                            <li class="nav-item">
                                <Link class="nav-link" :href="route('clients.index')">
                                <span class="sidenav-normal">Lista de clientes</span>
                                </Link>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#navbar-products" class="nav-link " aria-controls="navbar-products" role="button">
                        <div class="icon icon-shape icon-sm text-center d-flex align-items-center justify-content-center">
                            <i class="ni ni-box-2 text-success text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Productos</span>
                    </a>
                    <div class="" id="navbar-products">
                        <ul class="nav ms-4">
                            <li class="nav-item">
                                <Link class="nav-link" :href="route('products.index')">
                                    <span class="sidenav-normal">Lista de productos</span>
                                </Link>
                            </li>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
        <!-- Divider -->
        <hr class="horizontal dark mt-3">
        <div class="sidenav-footer">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <Link class="nav-link" :href="route('logout')" method="post" as="button">
                        <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fa-solid fa-right-from-bracket text-danger text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Cerrar Sesión</span>
                    </Link>
                </li>
            </ul>
        </div>
    </aside>
</template>
<script>
import {Link} from "@inertiajs/inertia-vue3";
import { loadScript } from "vue-plugin-load-script";
import {router} from "@inertiajs/vue3";
loadScript("/assets/js/argon-dashboard.min.js?v=2.0.5");
export default {
    name: "Sidebar",
    methods: {
        router() {
            return router
        }
    },
    components: {
        Link,
    },
}
</script>

<style scoped>
</style>

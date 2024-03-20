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
                <li class="nav-item" v-if="this.$permissions(this.$page.props.auth.user, ['admin-ver permisos', 'admin-ver usuarios'])">
                    <a @click="toggleAdminMenu()" data-bs-toggle="collapse" href="#navbar-admin" class="nav-link" aria-controls="navbar-admin" role="button"
                        :class="{'active': $page.component.includes('Admin')}">
                        <div class="d-flex align-items-center">
                            <i class="ni ni-ui-04 text-info text-sm opacity-10" :class="{ 'active': adminActive }"></i>
                            <span class="nav-link-text ms-1">Admin</span>
                        </div>
                    </a>
                    <div id="navbar-admin" v-if="adminActive" :class="{active :adminActive}">
                        <ul class="nav ms-4">
                            <li class="nav-item" v-if="this.$permissions(this.$page.props.auth.user, 'admin-ver usuarios')"
                                :class="{'active' : $page.component === 'Admin/Users'}">
                                <Link class="nav-link" :href="route('admin.users.index')">
                                <span class="sidenav-normal">Usuarios</span>
                                </Link>
                            </li>
                            <li class="nav-item " v-if="this.$permissions(this.$page.props.auth.user, 'admin-ver permisos')"
                                :class="{'active' : $page.component === 'Admin/Permissions'}">
                                <Link class="nav-link" :href="route('admin.permissions.index')">
                                <span class="sidenav-normal">Permisos</span>
                                </Link>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item" v-if="this.$permissions(this.$page.props.auth.user, ['clientes-ver clientes'])">
                    <a @click="toggleClientsMenu()" data-bs-toggle="collapse" href="#navbar-clients" class="nav-link " aria-controls="navbar-clients" role="button"
                        :class="{'active': $page.component.includes('Clients') }">
                        <div class="icon icon-shape icon-sm text-center d-flex align-items-center justify-content-center">
                        <i class="fa-solid fa-users text-warning text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Clientes</span>
                    </a>
                    <div id="navbar-clients" v-if="clientsActive" :class="{active :clientsActive}">
                        <ul class="nav ms-4">
                            <li class="nav-item" v-if="this.$permissions(this.$page.props.auth.user, 'clientes-ver clientes')"
                                :class="{'active': $page.component === 'Clients/ListClients'} ">
                                <Link class="nav-link" :href="route('clients.listClients.index')">
                                <span class="sidenav-normal">Lista de clientes</span>
                                </Link>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item" v-if="this.$permissions(this.$page.props.auth.user, ['productos-ver-hitorial-productos', 'productos-ver-lista-productos'])">
                    <a @click="toggleProductsMenu()" data-bs-toggle="collapse" href="#navbar-products" class="nav-link " aria-controls="navbar-products" role="button"
                        :class="{'active': $page.component.includes('Products') }">
                        <div class="icon icon-shape icon-sm text-center d-flex align-items-center justify-content-center">
                            <i class="ni ni-box-2 text-success text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Productos</span>
                    </a>
                    <div id="navbar-products" v-if="productsActive" :class="{active :productsActive}">
                        <ul class="nav ms-4">
                            <li class="nav-item" v-if="this.$permissions(this.$page.props.auth.user, 'productos-ver-hitorial-productos')"
                                :class="{'active': $page.component === 'Products/HistoryListProducts'} ">
                                <Link class="nav-link" :href="route('products.historyListProducts.index')">
                                    <span class="sidenav-normal">Historial de Pedidos</span>
                                </Link>
                            </li>
                        </ul>
                        <ul class="nav ms-4">
                            <li class="nav-item" v-if="this.$permissions(this.$page.props.auth.user, 'productos-ver-lista-productos')"
                            :class="{'active': $page.component === 'Products/ListProducts'} ">
                            <Link class="nav-link" :href="route('products.listProducts.index')">
                                    <span class="sidenav-normal">Lista de Productos</span>
                                </Link>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item" v-if="this.$permissions(this.$page.props.auth.user, ['familias-ver-lista-familias'])">
                    <a @click="toggleFamiliesMenu()" data-bs-toggle="collapse" href="#navbar-families" class="nav-link " aria-controls="navbar-families" role="button"
                       :class="{'active': $page.component.includes('Families') }">
                        <div class="icon icon-shape icon-sm text-center d-flex align-items-center justify-content-center">
                            <i class="fa-solid fa-clipboard text-info text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Familias</span>
                    </a>
                    <div id="navbar-families" v-if="familiesActive" :class="{active :familiesActive}">
                        <ul class="nav ms-4">
                            <li class="nav-item" v-if="this.$permissions(this.$page.props.auth.user, 'familias-ver-lista-familias')"
                                :class="{'active': $page.component === 'Families/ListFamilies'}">
                                <Link class="nav-link" :href="route('families.listFamilies.index')">
                                    <span class="sidenav-normal">Lista de Familias</span>
                                </Link>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item" v-if="this.$permissions(this.$page.props.auth.user, ['apis-ver-pruebas'])">
                    <a @click="toggleApiMenu()" data-bs-toggle="collapse" href="#navbar-api" class="nav-link " aria-controls="navbar-api" role="button"
                        :class="{'active': $page.component.includes('Apis') }">
                        <div class="icon icon-shape icon-sm text-center d-flex align-items-center justify-content-center">
                            <i class="fa fa-tower-cell text-warning text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Api</span>
                    </a>
                    <div id="navbar-api" v-if="apiActive" :class="{active :apiActive}">
                        <ul class="nav ms-4">
                            <li class="nav-item" :class="{'active': $page.component === 'Apis/DelSol'}">
                                <Link class="nav-link" :href="route('apis.delSol.index')">
                                    <span class="sidenav-normal">Pruebas Api</span>
                                </Link>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item" v-if="this.$permissions(this.$page.props.auth.user, ['proveedores-ver-lista-proveedores', 'proveedores-ver-lista-acreedores'])">
                    <a data-bs-toggle="collapse" href="#navbar-suppliers" class="nav-link " aria-controls="navbar-api" role="button"
                        :class="{'active': $page.component.includes('Suppliers'), 'collapsed': !$page.component.includes('Suppliers')}"
                        @click="toggleSuppliersMenu()">
                        <div class="icon icon-shape icon-sm text-center d-flex align-items-center justify-content-center">
                            <i class="fa fa-boxes-packing text-info text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Proveedores</span>
                    </a>
                    <div id="navbar-suppliers" v-if="suppliersActive"  :class="{active :suppliersActive}">
                        <ul class="nav ms-4">
                            <li class="nav-item" v-if="this.$permissions(this.$page.props.auth.user, 'proveedores-ver-lista-proveedor')"
                                :class="{'active': $page.component === 'Suppliers/ListSuppliers'}">
                                <Link class="nav-link" :href="route('suppliers.listSuppliers.index')">
                                    <span class="sidenav-normal">Lista de Proveedores</span>
                                </Link>
                            </li>
                            <li class="nav-item" v-if="this.$permissions(this.$page.props.auth.user, 'proveedores-ver-lista-acreedor')"
                                :class="{'active': $page.component === 'Suppliers/ListCreditors'} ">
                                <Link class="nav-link" :href="route('suppliers.listCreditors.index')">
                                    <span class="sidenav-normal">Lista de Acreedores</span>
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
export default {
    name: "Sidebar",
    components: {
        Link,
    },
    data(){
        return {
            adminActive: false,
            clientsActive: false,
            productsActive: false,
            apiActive: false,
            suppliersActive: false,
            familiesActive: false,
        }
    },
    methods: {
        toggleAdminMenu() {
            this.adminActive = !this.adminActive;
        },
        toggleClientsMenu() {
            this.clientsActive = !this.clientsActive;
        },
        toggleProductsMenu() {
            this.productsActive = !this.productsActive;
        },
        toggleApiMenu() {
            this.apiActive = !this.apiActive;
        },
        toggleSuppliersMenu() {
            this.suppliersActive = !this.suppliersActive;
        },
        toggleFamiliesMenu() {
            this.familiesActive = !this.familiesActive;
        }
    }
}
</script>

<style scoped>
</style>

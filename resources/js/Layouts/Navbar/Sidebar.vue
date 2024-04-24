<template>
    <div class="min-height-300 bg-primary position-absolute w-100"></div>
    <aside class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4 " id="sidenav-main">
        <div class="sidenav-header d-flex align-items-center"> <!-- Agregamos d-flex para que los elementos se comporten como una fila y align-items-center para centrar verticalmente -->
            <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
            <a class="navbar-brand m-0 d-flex align-items-center"> <!-- Agregamos d-flex y align-items-center para alinear horizontalmente los elementos -->
                <img src="/img/Logo-Home-Bed-Spain-negro.jpg" class="navbar-brand-img h-100" alt="main_logo" style="width: 100px; height: 70px;">
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
                <li class="nav-item" v-if="this.$permissions(this.$page.props.auth.user, ['clientes-ver-clientes'])">
                    <a @click="toggleClientsMenu()" data-bs-toggle="collapse" href="#navbar-clients" class="nav-link " aria-controls="navbar-clients" role="button"
                        :class="{'active': $page.component.includes('Clients') }">
                        <div class="icon icon-shape icon-sm text-center d-flex align-items-center justify-content-center">
                        <i class="fa-solid fa-users text-warning text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Clientes</span>
                    </a>
                    <div id="navbar-clients" v-if="clientsActive" :class="{active :clientsActive}">
                        <ul class="nav ms-4">
                            <li class="nav-item" v-if="this.$permissions(this.$page.props.auth.user, 'clientes-ver-clientes')"
                                :class="{'active': $page.component === 'Clients/ListClients'} ">
                                <Link class="nav-link" :href="route('clients.listClients.index')">
                                <span class="sidenav-normal">Lista de clientes</span>
                                </Link>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item" v-if="this.$permissions(this.$page.props.auth.user, ['compras-crear-escandallo','compras-crear-articulo'])">
                    <a @click="toggleBuyMenu()" data-bs-toggle="collapse" href="#navbar-compras" class="nav-link " aria-controls="navbar-compras" role="button"
                       :class="{'active': $page.component.includes('Buy') }">
                        <div class="icon icon-shape icon-sm text-center d-flex align-items-center justify-content-center">
                            <i class="fa-solid fa-money-bill text-success text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Compras</span>
                    </a>
                    <div id="navbar-clients" v-if="buyActive" :class="{active :buyActive}">
                        <ul class="nav ms-4">
                            <li class="nav-item" v-if="this.$permissions(this.$page.props.auth.user, 'compras-crear-articulo')"
                                :class="{'active': $page.component === 'Buy/CreateArticle'} ">
                                <Link class="nav-link" :href="route('createArticle.index')">
                                    <span class="sidenav-normal">Crear Articulo</span>
                                </Link>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item" v-if="this.$permissions(this.$page.props.auth.user, ['productos-ver-hitorial-productos', 'productos-ver-lista-productos','productos-buscar-articulo'])">
                    <a @click="toggleProductsMenu()" data-bs-toggle="collapse" href="#navbar-products" class="nav-link " aria-controls="navbar-products" role="button"
                        :class="{'active': $page.component.includes('Products') }">
                        <div class="icon icon-shape icon-sm text-center d-flex align-items-center justify-content-center">
                            <i class="ni ni-box-2 text-sm opacity-10" style="color: #053df6"></i>
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
                        <ul class="nav ms-4">
                            <li class="nav-item" v-if="this.$permissions(this.$page.props.auth.user, 'productos-buscar-articulo')"
                                :class="{'active': $page.component === 'Products/SearchArticle'} ">
                                <Link class="nav-link" :href="route('products.searchArticle.index')">
                                    <span class="sidenav-normal">Buscar Artículo</span>
                                </Link>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item" v-if="this.$permissions(this.$page.props.auth.user, ['familias-ver-lista-familias'])">
                    <a @click="toggleFamiliesMenu()" data-bs-toggle="collapse" href="#navbar-families" class="nav-link " aria-controls="navbar-families" role="button"
                       :class="{'active': $page.component.includes('Families') }">
                        <div class="icon icon-shape icon-sm text-center d-flex align-items-center justify-content-center">
                            <i class="fa-solid fa-clipboard text-sm opacity-10" style="color: #ff7300"></i>
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
                            <li class="nav-item" v-if="this.$permissions(this.$page.props.auth.user, 'proveedores-ver-lista-proveedores')"
                                :class="{'active': $page.component === 'Suppliers/ListSuppliers'}">
                                <Link class="nav-link" :href="route('suppliers.listSuppliers.index')">
                                    <span class="sidenav-normal">Lista de Proveedores</span>
                                </Link>
                            </li>
                            <li class="nav-item" v-if="this.$permissions(this.$page.props.auth.user, 'proveedores-ver-lista-acreedores')"
                                :class="{'active': $page.component === 'Suppliers/ListCreditors'} ">
                                <Link class="nav-link" :href="route('suppliers.listCreditors.index')">
                                    <span class="sidenav-normal">Lista de Acreedores</span>
                                </Link>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item" v-if="this.$permissions(this.$page.props.auth.user, ['pedidos-ver-pedidos-pendientes'])">
                    <a data-bs-toggle="collapse" href="#navbar-orders" class="nav-link " aria-controls="navbar-orders" role="button"
                       :class="{'active': $page.component.includes('Orders'), 'collapsed': !$page.component.includes('Orders')}"
                       @click="toggleOrdersMenu()">
                        <div class="icon icon-shape icon-sm text-center d-flex align-items-center justify-content-center">
                            <i class="ni ni-cart text-success text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Pedidos</span>
                    </a>
                    <div id="navbar-suppliers" v-if="ordersActive"  :class="{active :ordersActive}">
                        <ul class="nav ms-4">
                            <li class="nav-item" v-if="this.$permissions(this.$page.props.auth.user, 'pedidos-ver-pedidos-pendientes')"
                                :class="{'active': $page.component === 'Orders/OrdersPendingService'}">
                                <Link class="nav-link" :href="route('orders.listOrdersPendingService.index')">
                                    <span class="sidenav-normal">Pedidos pendientes por Servir</span>
                                </Link>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item" v-if="this.$permissions(this.$page.props.auth.user, ['logistica-ver-facturas-transporte'])">
                    <a data-bs-toggle="collapse" href="#navbar-logistic" class="nav-link " aria-controls="navbar-logistic" role="button"
                       :class="{'active': $page.component.includes('Logistic'), 'collapsed': !$page.component.includes('Logistic')}"
                       @click="toggleLogisticMenu()">
                        <div class="icon icon-shape icon-sm text-center d-flex align-items-center justify-content-center">
                            <i class="ni ni-delivery-fast text-secondary text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Logistica</span>
                    </a>
                    <div id="navbar-logistic" v-if="LogisticActive"  :class="{active :LogisticActive}">
                        <ul class="nav ms-4">
                            <li class="nav-item" v-if="this.$permissions(this.$page.props.auth.user, 'logistica-ver-facturas-transporte')"
                                :class="{'active': $page.component === 'Logistic/TransportInvoices'}">
                                <Link class="nav-link" :href="route('logistic.transportInvoices.index')">
                                    <span class="sidenav-normal">Facturas de Transporte</span>
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
            suppliersActive: false,
            familiesActive: false,
            ordersActive: false,
            buyActive: false,
            LogisticActive: false,
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
        toggleBuyMenu() {
            this.buyActive = !this.buyActive;
        },
        toggleSuppliersMenu() {
            this.suppliersActive = !this.suppliersActive;
        },
        toggleFamiliesMenu() {
            this.familiesActive = !this.familiesActive;
        },
        toggleOrdersMenu() {
            this.ordersActive = !this.ordersActive;
        },
        toggleLogisticMenu() {
            this.LogisticActive = !this.LogisticActive;
        }
    }
}
</script>

<style scoped>
</style>

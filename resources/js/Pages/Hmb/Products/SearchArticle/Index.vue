<template>
<Layout>
    <TopBar :breadcrumbs="breadcrumbs" />
    <div class="container-fluid mt--6">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header pb-0">
                        <h3>Busqueda de Articulos</h3><br>
                    </div>
                    <hr>
                    <div class="car-body pt-0">
                        <div class="row">
                            <div class="col-12 col-md-3">
                                <div class="input-group mb-3 searchInput">
                                    <form class="input-group" @submit.prevent="search()">
                                        <div class="input-group mb-3">
                                            <input type="text" id="serial" v-model.trim="this.article" placeholder="Buscar por id de articulo" class="form-control rounded " autofocus required>
                                            <button class="btn btn-secondary my-auto">
                                                Buscar
                                                <span v-if="this.isShowSpinner">
                                                  <div class="spinner-border spinner-border-sm" role="status">
                                                    <span class="visually-hidden">Loading...</span>
                                                  </div>
                                                </span>
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- table -->
                    <div class="card" v-if="this.showTable && this.tableSearch.length > 0">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table align-items-center">
                                    <thead class="thead-light">
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xs text-center">Articulo</th>
                                        <th class="text-uppercase text-secondary text-xs text-center">Nombre</th>
                                        <th class="text-uppercase text-secondary text-xs text-center">Existencia</th>
                                        <th class="text-uppercase text-secondary text-xs text-center">Pte. Recibir</th>
                                        <th class="text-uppercase text-secondary text-xs text-center">Pte. Servir</th>
                                        <th class="text-uppercase text-secondary text-xs text-center">Almacen</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr v-for="item in tableSearch" :key="item.articleId">
                                        <td class="text-center text-xs">{{ item.articleId }}</td>
                                        <td class="text-center text-xs">{{ item.nameArticle }}</td>
                                        <td class="text-center text-xs">{{ item.stock }}</td>
                                        <td class="text-center text-xs">{{ item.receive }}</td>
                                        <td class="text-center text-xs">{{ item.serve }}</td>
                                        <td class="text-center text-xs">{{ item.store }} | {{ item.storeName }}</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="card" v-if="showTable && tableSearch.length === 0">
                        <div class="card-body">
                            <h3>No se encontraron resultados para este articulo: {{ article }}</h3>
                        </div>
                    </div>
                    <!--end table -->
                </div>
            </div>
        </div>
    </div>
</Layout>
</template>
<script>
import {Link} from '@inertiajs/inertia-vue3'
import Layout from '../../../../Layouts/Layout.vue';
import TopBar from '../../../../Layouts/Navbar/Topbar.vue';
import {toast} from "vue3-toastify";

const notify = ( message, type="warning",autoClose = true) =>
    toast(message, {
        type: type,
        theme: "auto",
        autoClose: autoClose,
    });

export default {
    name: "Index SearchArticle",
    components: {
        Layout,
        TopBar,
        Link,
    },
    props: {
    },
    data() {
        return {
            breadcrumbs: {
                title: 'Busqueda de Articulos',
                breadcrumb: {
                    title: 'Productos',
                    url: null
                }
            },
            article: '',
            isShowSpinner: false,
            tableSearch: [],
            showTable: false
        }
    },
    methods: {
        search() {
            this.showTable = false
            this.isShowSpinner = true;
            const data = {
                article: this.article
            }
            axios.post(route('products.searchArticle.search'), data)
                .then((response) => {
                    this.isShowSpinner = false;
                    this.tableSearch = response.data
                    this.showTable = true
                }).catch((error) => {
                    this.isShowSpinner = false;
                    notify(error.response.data.message, 'error', false);
                });
        }
    }
}
</script>
<style scoped>
.searchInput {
    margin-left: 25px;
}
</style>

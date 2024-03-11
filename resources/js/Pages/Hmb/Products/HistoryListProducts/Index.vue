<template>
    <Layout>
        <Top-bar :breadcrumbs="breadcrumbs" />
        <div class="container-fluid mt--6">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header pb-0">
                            <h3>Hemos vendido alrededor de: {{ totalListProducts() }}</h3><br>
                        </div>
                        <hr>
                        <!-- card body -->
                        <div class="card-footer py-4">
                            <nav aria-label="Page navigation example">
                                <ul class="pagination justify-content-end mb-0">
                                    <li class="page-item">
                                        <a class="page-link" @click.prevent="fetchPage(getPageUrl(1))" href="#">Primera</a>
                                    </li>
                                    <li v-if="HistoryListProducts.prev_page_url" class="page-item">
                                        <a class="page-link" @click.prevent="fetchPage(HistoryListProducts.prev_page_url)" href="#">
                                            <span class="ni ni-bold-left"></span>
                                        </a>
                                    </li>
                                    <template v-for="page in displayedPages" :key="page">
                                        <li  class="page-item">
                                            <a class="page-link" @click.prevent="fetchPage(getPageUrl(page))" href="#">{{ page }}</a>
                                        </li>
                                    </template>
                                    <li v-if="HistoryListProducts.next_page_url" class="page-item">
                                        <a class="page-link"  @click.prevent="fetchPage(HistoryListProducts.next_page_url)" href="#">
                                            <span class="ni ni-bold-right"></span></a>
                                    </li>
                                    <li class="page-item">
                                        <a class="page-link" @click.prevent="fetchPage(HistoryListProducts.last_page_url)" href="#">Última</a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                        <div class="car-body pt-0">
                            <div class="table-responsive">
                                <table class="table align-items-center table-flush" id="datatable-search">
                                    <thead class="thead-light">
                                    <tr>
                                        <th class="text-center text-uppercase text-xs">numero de documento</th>
                                        <th class="text-center text-uppercase text-xs">articulo id</th>
                                        <th class="text-center text-uppercase text-xs">nombre del articulo</th>
                                        <th class="text-center text-uppercase text-xs">fecha dado de alta</th>
                                        <th class="text-center text-uppercase text-xs">fecha del pedido </th>
                                        <th class="text-center text-uppercase text-xs">fecha de entrega</th>
                                        <th class="text-center text-uppercase text-xs">cantidad servida</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr v-for="listProduct in HistoryListProducts.data" :key="listProduct.id">
                                        <td class="text-center text-xs">{{ listProduct.idOrder }}</td>
                                        <td class="text-center text-xs">{{ listProduct.idArticle }}</td>
                                        <td class="text-center text-xs">{{ listProduct.nameArticle }}</td>
                                        <td class="text-center text-xs">{{ listProduct.dateUp }}</td>
                                        <td class="text-center text-xs">{{ listProduct.orderDate }}</td>
                                        <td class="text-center text-xs">{{ listProduct.deliveryDate }}</td>
                                        <td class="text-center text-xs">{{ listProduct.quantity }}</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="card-footer py-4">
                            <nav aria-label="Page navigation example">
                                <ul class="pagination justify-content-end mb-0">
                                    <li class="page-item">
                                        <a class="page-link" @click.prevent="fetchPage(getPageUrl(1))" href="#">Primera</a>
                                    </li>
                                    <li v-if="HistoryListProducts.prev_page_url" class="page-item">
                                        <a class="page-link" @click.prevent="fetchPage(HistoryListProducts.prev_page_url)" href="#">
                                            <span class="ni ni-bold-left"></span>
                                        </a>
                                    </li>
                                    <template v-for="page in displayedPages" :key="page">
                                        <li  class="page-item">
                                            <a class="page-link" @click.prevent="fetchPage(getPageUrl(page))" href="#">{{ page }}</a>
                                        </li>
                                    </template>
                                    <li v-if="HistoryListProducts.next_page_url" class="page-item">
                                        <a class="page-link"  @click.prevent="fetchPage(HistoryListProducts.next_page_url)" href="#">
                                            <span class="ni ni-bold-right"></span></a>
                                    </li>
                                    <li class="page-item">
                                        <a class="page-link" @click.prevent="fetchPage(HistoryListProducts.last_page_url)" href="#">Última</a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
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

export default {
    name: "Index ListProducts",
    components: {
        Layout,
        TopBar,
        Link,
    },
    props: {
        HistoryListProducts: Object
    },
    data() {
        return {
            breadcrumbs: {
                title: 'Historial de Productos Vendidos',
                breadcrumb: {
                    title: 'Productos',
                    url: null
                }
            },
        }
    },
    computed: {
        displayedPages() {
            const currentPage = this.HistoryListProducts.current_page;
            const totalPages = Math.ceil(this.HistoryListProducts.total / this.HistoryListProducts.per_page);
            const pagesToShow = 5;
            let startPage = Math.max(1, currentPage - Math.floor(pagesToShow / 2));
            let endPage = Math.min(totalPages, startPage + pagesToShow - 1);
            if (endPage - startPage + 1 < pagesToShow) {
                startPage = Math.max(1, endPage - pagesToShow + 1);
            }
            return Array.from({ length: endPage - startPage + 1 }, (_, i) => startPage + i);
        },

    },
    methods: {
        totalListProducts() {
            return this.HistoryListProducts.total;
        },
        async fetchPage(url) {
            try {
                const response = await this.$inertia.get(url);
                if (response !== undefined) {
                    this.$props.HistoryListProducts = response.data.HistoryListProducts;
                } else {
                    console.error("Error: La respuesta del servidor es undefined");
                }
            } catch (error) {
                console.error("Error al obtener los datos de la página:", error);
            }
        },
        getPageUrl(pageNumber) {
            return this.HistoryListProducts.path + '?page=' + pageNumber;
        }
    },
}
</script>

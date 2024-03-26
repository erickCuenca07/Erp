<template>
    <Layout>
        <Top-bar :breadcrumbs="breadcrumbs" />
        <div class="container-fluid mt--6">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header pb-0">
                            <h3>Tenemos {{ totalListProducts() }} productos.</h3><br>
                        </div>
                        <hr>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="inputGroup-sizing-default">Buscador</span>
                            <input autofocus v-model.trim="searchTerm" type="text" class="form-control rounded" placeholder="Introduce el id o el nombre del producto">
                        </div>
                        <!-- card body -->
                        <div class="car-body pt-0">
                            <div class="table-responsive">
                                <table class="table align-items-center table-flush" id="datatable-search">
                                    <thead class="thead-light">
                                    <tr>
                                        <th class="text-center text-uppercase text-xs">id producto</th>
                                        <th class="text-center text-uppercase text-xs">descripcion</th>
                                        <th class="text-center text-uppercase text-xs">fecha de alta</th>
                                        <th class="text-center text-uppercase text-xs">nombre del proveedor</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr v-for="listProduct in filteredListProducts" :key="listProduct.id">
                                        <td class="text-center text-xs">{{ listProduct.id }}</td>
                                        <td class="text-center text-xs">{{ listProduct.name }}</td>
                                        <td class="text-center text-xs">{{ listProduct.date }}</td>
                                        <td class="text-center text-xs">{{ listProduct.nameSupplier }}</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <button class="back-to-top" :class="{ 'show': showBackToTopButton }" @click="scrollToTop">
                            <i class="fa-solid fa-circle-up"></i>
                        </button>
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
        listProducts: Array
    },
    data() {
        return {
            breadcrumbs: {
                title: 'Lista de Productos',
                breadcrumb: {
                    title: 'Productos',
                    url: null
                }
            },
            searchTerm: '',
            showBackToTopButton: false,
        }
    },
    computed: {
        filteredListProducts() {
            if (!this.searchTerm.trim()) {
                return this.listProducts
            }
            const searchTerm = this.searchTerm.trim().toLowerCase();
            return this.listProducts.filter(Product => {
                return Object.values(Product).some(valueObj => {
                    if (typeof valueObj === 'string') {
                        return valueObj.toLowerCase().includes(searchTerm);
                    }
                    // Verificar si el valor es un número y convertirlo a cadena
                    if (typeof valueObj === 'number') {
                        return valueObj.toString().includes(searchTerm);
                    }
                    // Si el valor no es una cadena ni un número, no se puede buscar
                    return false;
                })
            });
        }
    },
    methods: {
        totalListProducts() {
            return this.listProducts.length;
        },
        scrollToTop() {
            window.scrollTo({
                top: 0,
                behavior: "smooth"
            });
        },
        handleScroll() {
            const scrollThreshold = 100; // Puedes ajustar este valor según tus necesidades
            this.showBackToTopButton = window.scrollY > scrollThreshold;
        },
    },
    mounted() {
        window.addEventListener('scroll', this.handleScroll);
    },
    destroyed() {
        window.removeEventListener('scroll', this.handleScroll);
    },
}
</script>
<style scoped>
.back-to-top {
    position: fixed;
    bottom: 20px;
    right: 20px;
    width: 50px; /* Ancho */
    height: 50px; /* Altura */
    font-size: 24px;
    cursor: pointer;
    background-color: #007bff; /* Color de fondo */
    color: #fff; /* Color del texto */
    border: none;
    border-radius: 50%; /* Forma circular */
    z-index: 9999;
    transition: opacity 0.3s; /* Transición de opacidad */
    opacity: 0; /* Inicialmente oculto */
}
.back-to-top:hover {
    background-color: #0069d9; /* Color de fondo al pasar el cursor */
}
.back-to-top.show {
    opacity: 1; /* Mostrar el botón cuando tiene la clase 'show' */
}
</style>

<template>
<Layout>
    <TopBar :breadcrumbs="breadcrumbs" />
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header pb-0 ">
                        <div class="align-self-start">
                            <h3>Pedidos pendientes: {{ totalOrdersPendingService()}}.</h3>
                        </div>
                        <div class="mt-3">
                            <button class="btn bg-gradient-secondary" @click="closeAllTables">minimizar</button>
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="inputGroup-sizing-default">Buscador</span>
                            <input autofocus v-model.trim="searchTerm" type="text" class="form-control rounded" placeholder="Busca por n° de pedido">
                        </div>
                    </div>
                    <hr>
                    <div class="car-body pt-0">
                        <div class="table-responsive">
                            <table class="table align-items-center table-flush" id="datatable-search">
                                <thead class="thead-light">
                                <tr>
                                    <th class="text-right text-uppercase text-xs" ></th>
                                    <th class="text-center text-uppercase text-xs" >nª de pedido</th>
                                    <th class="text-center text-uppercase text-xs">cliente</th>
                                    <th class="text-center text-uppercase text-xs">tipo documento</th>
                                    <th class="text-center text-uppercase text-xs">divisa</th>
                                    <th class="text-center text-uppercase text-xs">forma de pago</th>
                                    <th class="text-center text-uppercase text-xs">fecha de pedido</th>
                                    <th class="text-center text-uppercase text-xs">fecha de entrega</th>
                                </tr>
                                </thead>
                                <tbody>
                                <template  v-for="(item, index) in filteredOrdersPendingService" :key="item.numDocId">
                                    <tr>
                                        <td class="text-right text-xs">
                                            <button class="accordion-button font-weight-bold collapsed" @click="getDataOrder(item.numDocId,index)">
                                                <i v-if="!showTable[index]" class="fas fa-plus"></i>
                                                <i v-else class="fas fa-minus"></i>
                                            </button>
                                        </td>
                                        <td class="text-center text-xs">{{ item.numDocId }}</td>
                                        <td class="text-center text-xs">{{ item.clientId }} | {{ item.nameClient }}</td>
                                        <td class="text-center text-xs">{{ item.tipDocId }} | {{ item.nameTipDoc }}</td>
                                        <td class="text-center text-xs">{{ item.coin }}</td>
                                        <td class="text-center text-xs">{{ item.WayPay }} | {{item.NameWayPay}}</td>
                                        <td class="text-center text-xs">{{ item.dateOrder }}</td>
                                        <td class="text-center text-xs">{{ item.dateDelivery }}</td>
                                    </tr>
                                        <td colspan="7" class="text-center text-xs" v-if="showTable[index]">
                                            <div class="table-responsive">
                                                <table class="table align-items-center mb-0">
                                                    <thead class="thead-light">
                                                    <tr>
                                                        <th></th>
                                                        <th class="text-uppercase text-xs" >id producto</th>
                                                        <th class="text-uppercase text-xs">nombre </th>
                                                        <th class="text-uppercase text-xs">cantidad</th>
                                                        <th class="text-uppercase text-xs">precio unitario</th>
                                                        <th class="text-uppercase text-xs">total</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <tr v-for="data in getData[index]">
                                                        <td class="text-uppercase text-xs"></td>
                                                        <td class="text-uppercase text-xs">{{ data.idArt }}</td>
                                                        <td class="text-uppercase text-xs">{{ data.name }}</td>
                                                        <td class="text-uppercase text-xs">{{ data.quantity }}</td>
                                                        <td class="text-uppercase text-xs">{{ data.price }}</td>
                                                        <td class="text-uppercase text-xs">{{ data.amount }}</td>
                                                    </tr>
                                                    <tr v-if="getData[index].length === 0">
                                                        <td colspan="7" class="text-center text-xs">No se han encontrado datos para este pedido {{item.numDocId}}</td>
                                                    </tr>
                                                    <tr v-if="getData[index].length > 0">
                                                        <td colspan="5" class="text-center text-xs"></td>
                                                        <td colspan="7" class="text-center text-xs">
                                                            Total: {{ calculateTotal(index) }}
                                                        </td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </td>
                                </template>
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
<script >
import {Link} from '@inertiajs/inertia-vue3'
import Layout from '../../../../Layouts/Layout.vue';
import TopBar from '../../../../Layouts/Navbar/Topbar.vue';
export default {
    name: "Index OrdersPendingService",
    components: {
        Layout,
        TopBar,
        Link,
    },
    props: {
        ordersPendingService: Array
    },
    data() {
        return {
            breadcrumbs: {
                title: 'Lista de Pedidos Pendientes',
                breadcrumb: {
                    title: 'Pedidos Pendientes',
                    url: null
                }
            },
            showTable: [],
            getData: [],
            searchTerm: '',
            showBackToTopButton: false,
        }
    },
    computed: {
        filteredOrdersPendingService() {
            if (this.searchTerm.trim() === '') {
                return this.ordersPendingService
            }
            const searchTerm = this.searchTerm.trim().toLowerCase();
            return this.ordersPendingService.filter(item => {
                return item.numDocId.toString().toLowerCase().includes(searchTerm);
            });
        }
    },
    methods: {
        totalOrdersPendingService() {
            return this.ordersPendingService.length
        },
        calculateTotal(index) {
            let total = 0;
            this.getData[index].forEach(data => {
                total += parseFloat(data.amount);
            });
            return total;
        },
        closeAllTables() {
            this.showTable = this.showTable.map(_ => false);
        },
        getDataOrder(numDocId,item) {
            const data = {
                'order': numDocId
            }
            this.showTable[item] = !this.showTable[item];
            axios.post(route('orders.listOrdersPendingService.getData'),data)
                .then(response => {
                    this.getData = { ...this.getData, [item]: response.data };
                })
                .catch(error => {
                    console.log(error)
                })
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

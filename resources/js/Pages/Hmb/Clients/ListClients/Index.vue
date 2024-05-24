<template>
<Layout>
    <Top-bar :breadcrumbs="breadcrumbs" />
    <div class="container-fluid mt--6">
        <div class="row">
            <div class="col-12">
               <div class="card">
                   <div class="card-header pb-0">
                       <h3>Tenemos {{totalListClients()}} clientes</h3><br>
                       <div class="input-group mb-3">
                           <span class="input-group-text" id="inputGroup-sizing-default">Buscador</span>
                           <input autofocus v-model="search" type="text" class="form-control rounded" placeholder="Busca por nombre o id del cliente o número de pedido">
                       </div>
                   </div>
                   <hr>
                   <!-- card body -->
                   <div class="car-body pt-0">
                       <div class="table-responsive">
                           <table class="table align-items-center table-flush" id="datatable-search">
                               <thead class="thead-light">
                                   <tr>
                                       <th class="text-center text-uppercase">id del cliente</th>
                                       <th class="text-center text-uppercase">nombre del cliente</th>
                                       <th class="text-center text-uppercase">numero de pedidos</th>
                                   </tr>
                               </thead>
                               <tbody>
                                   <tr v-for="listClient in filteredList" :key="listClient.idClient">
                                       <td class="text-center">{{listClient.idClient}}</td>
                                       <td class="text-center">{{listClient.nameClient}}</td>
                                       <td class="text-center">{{listClient.numOrder}}</td>
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
  name: "Index ListClients",
  components: {
    Layout,
    TopBar,
    Link,
  },
  props: {
    listClients: Array
  },
    computed: {
        filteredList() {
            // Search logic: lowercase for case-insensitive search, filter based on ID, name, or order number
            const lowerSearch = this.search.toLowerCase();
            return this.listClients.filter(item => {
                const lowerId = String(item.idClient).toLowerCase();
                const lowerName = item.nameClient.toLowerCase();
                const lowerOrder = String(item.numOrder).toLowerCase();
                return lowerId.includes(lowerSearch) || lowerName.includes(lowerSearch) || lowerOrder.includes(lowerSearch);
            });
        },
    },
  data() {
    return {
      breadcrumbs: {
        title: 'Lista de Clientes',
        breadcrumb: {
          title: 'Clientes',
          url: null
        }
      },
        search: '',
        showBackToTopButton: false,
    }
  },
    methods: {
      totalListClients() {
        return this.listClients.length
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

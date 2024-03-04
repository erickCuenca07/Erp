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
    }
  },
    methods: {
      totalListClients() {
        return this.listClients.length
      },
    },
}
</script>

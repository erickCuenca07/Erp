<template>
    <Layout>
        <Top-bar :breadcrumbs="breadcrumbs" />
        <div class="container-fluid mt--6">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header pb-0">
                            <h3>Tenemos {{ totalListSuppliers() }} acreedores</h3><br>
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="inputGroup-sizing-default">Buscador</span>
                                <input autofocus v-model="search" type="text" class="form-control rounded" placeholder="Busca por nombre o id del acreedor">
                            </div>
                        </div>
                        <hr>
                        <!-- card body -->
                        <div class="car-body pt-0">
                            <div class="table-responsive">
                                <table class="table align-items-center table-flush" id="datatable-search">
                                    <thead class="thead-light">
                                    <tr>
                                        <th class="text-center text-uppercase">id del acreedor</th>
                                        <th class="text-center text-uppercase">nombre del acreedor</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="item in filteredList" :key="item.id">
                                            <td class="text-center">{{ item.id }}</td>
                                            <td class="text-center">{{ item.name }}</td>
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
import { loadScript } from "vue-plugin-load-script";
export default {
    name: "Index ListCreditors",
    components: {
        Layout,
        TopBar,
        Link,
    },
    props: {
        listCreditors: Array
    },
    data() {
        return {
            breadcrumbs: {
                title: 'Lista de Acreedores',
                breadcrumb: {
                    title: 'Proveedores',
                    url: null
                }
            },
            search: '',
        }
    },
    computed: {
        filteredList() {
            const lowerSearch = this.search.toLowerCase();
            return this.listCreditors.filter(item => {
                const lowerId = String(item.id).toLowerCase();
                const lowerName = item.name.toLowerCase();
                return lowerId.includes(lowerSearch) || lowerName.includes(lowerSearch);
            });
        },
    },
    methods: {
        totalListSuppliers() {
            return this.listCreditors.length
        }
    },
}
</script>

<template>
    <Layout>
        <Top-bar :breadcrumbs="breadcrumbs" />
        <div class="container-fluid mt--6">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header pb-0">
                            <h3>Tenemos {{ totalListFamilies() }} familias.</h3><br>
                        </div>
                        <hr>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="inputGroup-sizing-default">Buscador</span>
                            <input autofocus v-model.trim="searchTerm" type="text" class="form-control rounded" placeholder="Introduce el id o el nombre de la familia ">
                        </div>
                        <!-- card body -->
                        <div class="car-body pt-0">
                            <div class="table-responsive">
                                <table class="table align-items-center table-flush" id="datatable-search">
                                    <thead class="thead-light">
                                    <tr>
                                        <th class="text-center text-uppercase text-xs" >id familia
                                        <i @click="changeSort('CODFAM')"  class="fas fa-sort cursor-pointer"></i></th>
                                        <th class="text-center text-uppercase text-xs">descripcion</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr v-for="item in filteredListFamilies" :key="item.CODFAM">
                                        <td class="text-center text-xs">{{ item.CODFAM }}</td>
                                        <td class="text-center text-xs">{{ item.DESFAM }}</td>
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
    name: "Index ListFamilies",
    components: {
        Layout,
        TopBar,
        Link,
    },
    props: {
        listFamilies: Array
    },
    data() {
        return {
            breadcrumbs: {
                title: 'Lista de Familias',
                breadcrumb: {
                    title: 'Familias',
                    url: null
                }
            },
            searchTerm: '',
            sortBy: 'id',
            sortDirection: 'asc'
        }
    },
    computed: {
        filteredListFamilies() {
            if (!this.searchTerm.trim()) {
                let filteredList = this.listFamilies;
                filteredList = filteredList.sort((a, b) => {
                    if (this.sortDirection === 'asc') {
                        return a[this.sortBy] - b[this.sortBy];
                    } else {
                        return b[this.sortBy] - a[this.sortBy];
                    }
                });

                return filteredList;
            }
            const searchTerm = this.searchTerm.trim().toLowerCase();
            return this.listFamilies.filter(Product => {
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
        },
    },
    methods: {
        totalListFamilies() {
            return this.listFamilies.length
        },
        changeSort(column) {
            if (this.sortBy === column) {
                this.sortDirection = this.sortDirection === 'asc' ? 'desc' : 'asc';
            } else {
                this.sortBy = column;
                this.sortDirection = 'asc';
            }
        },
    },
}
</script>

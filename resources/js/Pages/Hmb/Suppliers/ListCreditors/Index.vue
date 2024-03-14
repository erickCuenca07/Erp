<template>
    <Layout>
        <Top-bar :breadcrumbs="breadcrumbs" />
        <div class="container-fluid mt--6">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header pb-0 d-flex justify-content-between">
                            <div class="align-self-start">
                                <h3>Tenemos {{ totalListCreditors() }} acreedor</h3>
                            </div>
                            <button @click="exportToExcel()" class="btn bg-gradient-success  ">
                                <i class="fa-regular fa-file-excel"></i>
                            </button>
                        </div>
                        <hr>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="inputGroup-sizing-default">Buscador</span>
                            <input autofocus v-model.trim="searchTerm" type="text" class="form-control rounded" placeholder="Busca por nombre o id del acreedor">
                        </div>
                        <!-- card body -->
                        <div class="car-body pt-0">
                            <div class="table-responsive">
                                <table class="table align-items-center table-flush" id="datatable-search">
                                    <thead class="thead-light">
                                    <tr>
                                        <th class="text-center text-uppercase">id del acreedor</th>
                                        <th class="text-center text-uppercase">nombre del acreedor</th>
                                        <th class="text-center text-uppercase">nif del acreedor</th>
                                        <th class="text-center text-uppercase">domicilio del acreedor</th>
                                        <th class="text-center text-uppercase">codigo postal del acreedor</th>
                                        <th class="text-center text-uppercase">provincia del acreedor</th>
                                        <th class="text-center text-uppercase">telefono del acreedor</th>
                                        <th class="text-center text-uppercase">fecha de alta del acreedor</th>
                                        <th class="text-center text-uppercase">pais del acreedor</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        <template v-for="list in filteredList">
                                            <tr>
                                                <td class="text-center" v-for="item in list">{{ item.dato }}</td>
                                            </tr>
                                        </template>
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
import ExcelJS from "exceljs";
export default {
    name: "Index ListCreditors",
    components: {
        Layout,
        TopBar,
        Link,
    },
    props: {
        listCreditors: Object
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
            searchTerm: '',
        }
    },
    computed: {
        filteredList() {
            if (!this.searchTerm.trim()) {
                return this.listCreditors.resultado;
            }
            const searchTerm = this.searchTerm.trim().toLowerCase();
            return this.listCreditors.resultado.filter(supplier => {
                return Object.values(supplier).some(valueObj => {
                    // Verificar si el valor es una cadena de texto
                    if (typeof valueObj.dato === 'string') {
                        return valueObj.dato.toLowerCase().includes(searchTerm);
                    }
                    // Verificar si el valor es un número y convertirlo a cadena
                    if (typeof valueObj.dato === 'number') {
                        return valueObj.dato.toString().includes(searchTerm);
                    }
                    // Si el valor no es una cadena ni un número, no se puede buscar
                    return false;
                });
            });
        },
    },
    methods: {
        totalListCreditors() {
            if (this.listCreditors && this.listCreditors.resultado && Array.isArray(this.listCreditors.resultado)) {// Verificar si la propiedad 'resultado' existe y es un array
                return this.listCreditors.resultado.length;
            } else {
                console.error("La estructura del objeto no es válida o no contiene la propiedad 'resultado'.");
                console.log(this.listCreditors)
                return 0;
            }
        },
        exportToExcel: async function () {
            const date = new Date();
            const year = date.getFullYear();
            const month = (date.getMonth() + 1).toString().padStart(2, '0');
            const day = date.getDate().toString().padStart(2, '0');
            const hours = date.getHours().toString().padStart(2, '0');
            const minutes = date.getMinutes().toString().padStart(2, '0');
            const seconds = date.getSeconds().toString().padStart(2, '0');

            const data = this.listCreditors;
            const fileName = `Acreedores_${day}-${month}-${year}_${hours}-${minutes}-${seconds}.xlsx`;

            const workbook = new ExcelJS.Workbook();
            const worksheet = workbook.addWorksheet('Acreedores');

            const customHeaders = [
                'CODPRO','NOFPRO','NIFPRO', 'DOMPRO','TELPRO', 'FALPRO', 'PAIPRO', 'PROPRO','CPOPRO',
            ];
            const headerRow = worksheet.addRow(customHeaders);

            headerRow.eachCell((cell) => {
                cell.font = {
                    bold: true,
                };
            });
            data.resultado.forEach(supplier => {
                const rowData = {};
                supplier.forEach(item => {
                    rowData[item.columna] = item.dato;
                });
                const rowValues = customHeaders.map(header => rowData[header]);
                worksheet.addRow(rowValues);
            });

            const buffer = await workbook.xlsx.writeBuffer();
            const blob = new Blob([buffer], {type: 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'});
            const url = URL.createObjectURL(blob);

            const a = document.createElement('a');
            a.href = url;
            a.download = fileName;
            a.click();
        }
    },
}
</script>

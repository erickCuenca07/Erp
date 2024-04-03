<template>
    <Layout>
        <Top-bar :breadcrumbs="breadcrumbs" />
        <div class="container-fluid mt--6">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header pb-0 d-flex justify-content-between ">
                            <div class="align-self-start">
                                <h3>Tenemos {{ AllListSuppliers() }} proveedores</h3>
                            </div>
                            <button @click="exportToExcel()" class="btn bg-gradient-success  ">
                                <i class="fa-regular fa-file-excel"></i>
                            </button>
                        </div>
                        <hr>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="inputGroup-sizing-default">Buscador</span>
                            <input autofocus v-model="searchTerm" type="text" class="form-control rounded" placeholder="Introduce datos del proveedor">
                        </div>
                        <!-- card body -->
                        <div class="car-body pt-0">
                            <div class="table-responsive">
                                <table class="table align-items-center table-flush" id="datatable-search">
                                    <thead class="thead-light">
                                    <tr>
                                        <th class="text-center text-uppercase">id del proveedor</th>
                                        <th class="text-center text-uppercase">nombre del proveedor</th>
                                        <th class="text-center text-uppercase">nif del proveedor</th>
                                        <th class="text-center text-uppercase">domicilio del proveedor</th>
                                        <th class="text-center text-uppercase">codigo postal del proveedor</th>
                                        <th class="text-center text-uppercase">provincia del proveedor</th>
                                        <th class="text-center text-uppercase">telefono del proveedor</th>
                                        <th class="text-center text-uppercase">fecha de alta del proveedor</th>
                                        <th class="text-center text-uppercase">pais del proveedor</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <template v-for="list in filteredSuppliers">
                                        <tr>
                                            <td class="text-center text-xs"> {{ list.CODPRO }}</td>
                                            <td class="text-center text-xs">{{ list.NOFPRO }}</td>
                                            <td class="text-center text-xs">{{ list.NIFPRO }}</td>
                                            <td class="text-center text-xs">{{ list.DOMPRO }}</td>
                                            <td class="text-center text-xs">{{ list.CPOPRO }}</td>
                                            <td class="text-center text-xs">{{ list.PROPRO }}</td>
                                            <td class="text-center text-xs">{{ list.TELPRO }}</td>
                                            <td class="text-center text-xs">{{ list.FALPRO }}</td>
                                            <td class="text-center text-xs">{{ list.PAIPRO }}</td>
                                        </tr>
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

<script>
import {Link} from '@inertiajs/inertia-vue3'
import Layout from '../../../../Layouts/Layout.vue';
import TopBar from '../../../../Layouts/Navbar/Topbar.vue';
import ExcelJS from "exceljs";
export default {
    name: "Index ListSuppliers",
    components: {
        Layout,
        TopBar,
        Link,
    },
    props: {
        listSuppliers: Object
    },
    data() {
        return {
            breadcrumbs: {
                title: 'Lista de Proveedores',
                breadcrumb: {
                    title: 'Proveedores',
                    url: null
                }
            },
            searchTerm: '',
            showBackToTopButton: false,
        }
    },
   computed: {
       filteredSuppliers() {
          if (!this.searchTerm.trim()) {
            return this.listSuppliers;
          }
           const searchTerm = this.searchTerm.trim().toLowerCase();
           return this.listSuppliers.filter(supplier => {
               return Object.values(supplier).some(valueObj => {
                   // Verificar si el valor es una cadena de texto
                   if (typeof valueObj === 'string') {
                       return valueObj.toLowerCase().includes(searchTerm);
                   }
                   // Verificar si el valor es un número y convertirlo a cadena
                   if (typeof valueObj === 'number') {
                       return valueObj.toString().includes(searchTerm);
                   }
                   // Si el valor no es una cadena ni un número, no se puede buscar
                   return false;
               });
           });
       }
    },
    methods: {
        AllListSuppliers() {
            return this.listSuppliers.length
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
        exportToExcel: async function () {
            const date = new Date();
            const year = date.getFullYear();
            const month = (date.getMonth() + 1).toString().padStart(2, '0');
            const day = date.getDate().toString().padStart(2, '0');
            const hours = date.getHours().toString().padStart(2, '0');
            const minutes = date.getMinutes().toString().padStart(2, '0');
            const seconds = date.getSeconds().toString().padStart(2, '0');

            const data = this.listSuppliers;
            const fileName = `Proveedores_${day}-${month}-${year}_${hours}-${minutes}-${seconds}.xlsx`;

            const workbook = new ExcelJS.Workbook();
            const worksheet = workbook.addWorksheet('Proveedores');

            const customHeaders = [
                'CODPRO','NOFPRO','NIFPRO', 'DOMPRO','TELPRO', 'FALPRO', 'PAIPRO', 'PROPRO','CPOPRO',
            ];
            const headerRow = worksheet.addRow(customHeaders);

            headerRow.eachCell((cell) => {
                cell.font = {
                    bold: true,
                };
            });
            data.forEach(item => {
                const rowData = [
                    item.CODPRO,
                    item.NOFPRO,
                    item.NIFPRO,
                    item.DOMPRO,
                    item.TELPRO,
                    item.FALPRO,
                    item.PAIPRO,
                    item.PROPRO,
                    item.CPOPRO,
                ];
                worksheet.addRow(rowData);
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

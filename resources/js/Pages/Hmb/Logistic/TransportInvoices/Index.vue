<template>
<Layout>
    <Top-bar :breadcrumbs="breadcrumbs" />
    <div class="container-fluid mt--6">
        <div class="row" v-if="this.$permissions(this.$page.props.auth.user, 'logistica-ver-facturas-transporte')">
            <div class="col 12">
                <div class="card">
                    <div class="card-header">
                        <h3>Seleccione las fechas que desee ver.</h3>
                        <hr>
                        <div class="col-12 col-md-4">
                            <div class="input-group mb-4">
                                <form class="input-group" @submit.prevent="search()">
                                    <div class="input-group mb-4">
                                        <div class="form-control">
                                            <label class="form-label">Fecha de inicio</label>
                                            <input class="form-control rounded" type="date" v-model.trim="dateStart" required>
                                            <label class="form-label">Fecha Fin</label>
                                            <input class="form-control rounded" type="date" v-model.trim="dateEnd" required>
                                        </div>
                                    </div>
                                    <button class="btn btn-secondary my-auto rounded">
                                        Buscar
                                        <span v-if="this.isShowSpinner">
                                              <div class="spinner-border spinner-border-sm" role="status">
                                                <span class="visually-hidden">Loading...</span>
                                              </div>
                                            </span>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="car-body pt-0">
                        <button @click="exportToExcel()" class="btn bg-gradient-success  " v-if="showTable">
                            <i class="fa-regular fa-file-excel"></i>
                        </button>
                        <div class="card" v-if="showTable">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table align-items-center">
                                        <thead class="thead-light">
                                        <tr>
                                            <th class="text-uppercase text-secondary text-xs text-center">Agen</th>
                                            <th class="text-uppercase text-secondary text-xs text-center">Nombre Agen</th>
                                            <th class="text-uppercase text-secondary text-xs text-center">Expedicion</th>
                                            <th class="text-uppercase text-secondary text-xs text-center">Fecha</th>
                                            <th class="text-uppercase text-secondary text-xs text-center">Cliente</th>
                                            <th class="text-uppercase text-secondary text-xs text-center">N.Cliente</th>
                                            <th class="text-uppercase text-secondary text-xs text-center">Provincia</th>
                                            <th class="text-uppercase text-secondary text-xs text-center">Poblacion</th>
                                            <th class="text-uppercase text-secondary text-xs text-center">Referencia</th>
                                            <th class="text-uppercase text-secondary text-xs text-center">Bultos</th>
                                            <th class="text-uppercase text-secondary text-xs text-center">kilos</th>
                                            <th class="text-uppercase text-secondary text-xs text-center">pesno.n</th>
                                            <th class="text-uppercase text-secondary text-xs text-center">cbm</th>
                                            <th class="text-uppercase text-secondary text-xs text-center">vol.Alb</th>
                                            <th class="text-uppercase text-secondary text-xs text-center">Palet</th>
                                            <th class="text-uppercase text-secondary text-xs text-center">Exp.</th>
                                            <th class="text-uppercase text-secondary text-xs text-center">F.pago</th>
                                            <th class="text-uppercase text-secondary text-xs text-center">NªAlb</th>
                                            <th class="text-uppercase text-secondary text-xs text-center">Importe</th>
                                            <th class="text-uppercase text-secondary text-xs text-center">Imp.rem</th>
                                            <th class="text-uppercase text-secondary text-xs text-center">i.t.c</th>
                                            <th class="text-uppercase text-secondary text-xs text-center">i.t.f</th>
                                            <th class="text-uppercase text-secondary text-xs text-center">n.f</th>
                                            <th class="text-uppercase text-secondary text-xs text-center">albarán</th>
                                            <th class="text-uppercase text-secondary text-xs text-center">Cod.Repre</th>
                                            <th class="text-uppercase text-secondary text-xs text-center">n.repre</th>
                                            <th class="text-uppercase text-secondary text-xs text-center">concepto</th>
                                            <th class="text-uppercase text-secondary text-xs text-center">importe concepto</th>
                                            <th class="text-uppercase text-secondary text-xs text-center">coste alb</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr v-for="item in resultSearch" :key="item.medioId">
                                            <td class="text-center text-xs">{{ item.medioId }}</td>
                                            <td class="text-center text-xs">{{ item.nameMedio }}</td>
                                            <td class="text-center text-xs"></td>
                                            <td class="text-center text-xs">{{ item.dateAlbaran }}</td>
                                            <td class="text-center text-xs">{{ item.clientId }}</td>
                                            <td class="text-center text-xs">{{ item.clientName }}</td>
                                            <td class="text-center text-xs">{{ item.provincesName }}</td>
                                            <td class="text-center text-xs">{{ item.populationName }}</td>
                                            <td class="text-center text-xs">{{ item.reference }}</td>
                                            <td class="text-center text-xs">{{ item.totalBultos }}</td>
                                            <td class="text-center text-xs"></td>
                                            <td class="text-center text-xs">{{ item.totalPesoNeto.toFixed(2) }}</td>
                                            <td class="text-center text-xs">{{ item.netWeight }}</td>
                                            <td class="text-center text-xs">{{ item.totalVolumen.toFixed(2) }}</td>
                                            <td class="text-center text-xs"></td>
                                            <td class="text-center text-xs">0</td>
                                            <td class="text-center text-xs">{{ item.FPago }}</td>
                                            <td class="text-center text-xs">1</td>
                                            <td class="text-center text-xs">{{ item.totalImport.toFixed(2) }}</td>
                                            <td class="text-center text-xs"></td>
                                            <td class="text-center text-xs"></td>
                                            <td class="text-center text-xs"></td>
                                            <td class="text-center text-xs"></td>
                                            <td class="text-center text-xs">{{item.numAlb}}</td>
                                            <td class="text-center text-xs">{{ item.repreId }}</td>
                                            <td class="text-center text-xs">{{item.repreName}}</td>
                                            <td class="text-center text-xs">{{item.concep}}</td>
                                            <td class="text-center text-xs">{{item.import}}</td>
                                            <td class="text-center text-xs">{{item.totalCosteNeto}}</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
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
import {toast} from "vue3-toastify";
import ExcelJS from "exceljs";

export default {
    name: "Index ListFamilies",
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
                title: 'Facturas de Transporte',
                breadcrumb: {
                    title: 'Logistica',
                    url: null
                }
            },
            dateStart: '',
            dateEnd: '',
            isShowSpinner: false,
            showTable: false,
            resultSearch: [],
            showBackToTopButton: false,
        }
    },
    methods: {
        search() {
            this.isShowSpinner = true
            let data={
                dateStart: this.dateStart,
                dateEnd: this.dateEnd
            }
            axios.post(route('logistic.transportInvoices.search'), data)
                .then(response => {
                    this.isShowSpinner = false
                    this.resultSearch = response.data
                    this.showTable = true
                }).catch(error => {
                    this.isShowSpinner = false
                    toast.error(error.response.data.message,{autoClose: false})
                })
        },
        exportToExcel: async function () {
            const date = new Date();
            const year = date.getFullYear();
            const month = (date.getMonth() + 1).toString().padStart(2, '0');
            const day = date.getDate().toString().padStart(2, '0');
            const hours = date.getHours().toString().padStart(2, '0');
            const minutes = date.getMinutes().toString().padStart(2, '0');
            const seconds = date.getSeconds().toString().padStart(2, '0');

            const data = Object.values(this.resultSearch);
            console.log(typeof this.resultSearch);
            const fileName = `Facturas-Transporte_${day}-${month}-${year}_${hours}-${minutes}-${seconds}.xlsx`;

            const workbook = new ExcelJS.Workbook();
            const worksheet = workbook.addWorksheet('Facturas de Transporte');

            const customHeaders = [
                'Agen','N.Agen','Expedicion','Fecha','Cliente','N.Cliente','Provincia','Poblacion','Referencia'
                ,'Bultos','Kilos','PesoNeto','CBM','Volumen','Palet','Exp','FPago','NumAlb','Importe','Imp.rem','ITC','ITF','NF','Albaran','RepreId','RepreName','Concep','Import','TotalCosteNeto'
            ];
            const headerRow = worksheet.addRow(customHeaders);

            headerRow.eachCell((cell) => {
                cell.font = {
                    bold: true,
                };
            });
            data.forEach(item => {
                const rowData = [
                    item.medioId,
                    item.nameMedio,
                    '',
                    item.dateAlbaran,
                    item.clientId,
                    item.clientName,
                    item.provincesName,
                    item.populationName,
                    item.reference,
                    item.totalBultos,
                    '',
                    item.totalPesoNeto,
                    '',
                    item.totalVolumen,
                    '',
                    0,
                    item.FPago,
                    1,
                    item.totalImport,
                    '',
                    '',
                    '',
                    '',
                    item.numAlb,
                    item.repreId,
                    item.repreName,
                    item.concep,
                    item.import,
                    item.totalCosteNeto
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

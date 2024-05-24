<template>
<Layout>
    <TopBar :breadcrumbs="breadcrumbs"/>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="col">
                            <div class="form-group">
                                <label for="name">Subir Archivo</label>
                                <input type="file" class="form-control rounded" @change="handleFileUpload" accept=".xls,.xlsx">
                            </div>
                        </div>
                    </div>
                    <div class="card-body" v-if="this.resultSearch.length > 0">
                        <button @click="exportToExcel()" class="btn bg-gradient-success ">
                             <i class="fa-regular fa-file-excel"></i>
                        </button>
                        <div class="table-responsive">
                            <table class="table align-items-center table-flush">
                                <thead class="thead-light">
                                <tr>
                                    <th class="text-center text-uppercase text-xs">id producto</th>
                                    <th class="text-center text-uppercase text-xs">descripcion</th>
                                    <th class="text-center text-uppercase text-xs">color</th>
                                    <th class="text-center text-uppercase text-xs">medidas</th>
                                    <th class="text-center text-uppercase text-xs">ean</th>
                                    <th class="text-center text-uppercase text-xs">tarifa</th>
                                    <th class="text-center text-uppercase text-xs">gama</th>
                                    <th class="text-center text-uppercase text-xs">Arancel</th>
                                    <th class="text-center text-uppercase text-xs">proveedor</th>
                                    <th class="text-center text-uppercase text-xs">CBM</th>
                                    <th class="text-center text-uppercase text-xs">familia</th>
                                    <th class="text-center text-uppercase text-xs">Inner</th>
                                    <th class="text-center text-uppercase text-xs">Piezas x Caja</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr v-for="index in this.resultSearch">
                                    <td class="text-center text-xs">{{ index.id }}</td>
                                    <td class="text-center text-xs">{{ index.name }}</td>
                                    <td class="text-center text-xs">{{ index.color }}</td>
                                    <td class="text-center text-xs">{{ index.measure }}</td>
                                    <td class="text-center text-xs">{{ index.ean }}</td>
                                    <td class="text-center text-xs">{{ index.tarifa }}</td>
                                    <td class="text-center text-xs">{{ index.gama }} | {{ index.nameGama }}</td>
                                    <td class="text-center text-xs">{{ index.arancel }} %</td>
                                    <td class="text-center text-xs">{{ index.supplierId }} </td>
                                    <td class="text-center text-xs">{{ index.volume }}</td>
                                    <td class="text-center text-xs">{{ index.family }} | {{ index.nameFamily }}</td>
                                    <td class="text-center text-xs">{{ index.inner }}</td>
                                    <td class="text-center text-xs">{{ index.piecesBox }}</td>
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
import * as XLSX from 'xlsx';
import {toast} from "vue3-toastify";
import ExcelJS from "exceljs";
export default {
    name: "SearchProductMassive",
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
                title: 'Buscar Articulos Masivos',
                breadcrumb: {
                    title: 'Productos',
                    url: null
                }
            },
            dates:null,
            resultSearch:''
        }
    },
    methods: {
        handleFileUpload(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = (e) => {
                    const data = new Uint8Array(e.target.result);
                    const workbook = XLSX.read(data, {type: 'array'});

                    const sheetName = workbook.SheetNames[0]; // Tomar la primera hoja
                    const worksheet = workbook.Sheets[sheetName];
                    const jsonData = XLSX.utils.sheet_to_json(worksheet, {header: 1});

                    console.log(jsonData); // Aquí tienes los datos en formato JSON

                    // Ahora puedes manipular los datos
                    const rows = jsonData.map(row => row[0]); // Asumiendo que solo quieres la primera columna
                    console.log(rows);
                    this.dates = rows;
                    this.searchOfDates();
                };
                reader.readAsArrayBuffer(file);
            }
        },
        searchOfDates(){
            const data = {
                dates: this.dates
            }
            axios.post(route('products.searchArticleMassive.search'), data)
                .then((response) => {
                    toast.success('Articulo/s encontrados');
                    this.resultSearch = response.data;
                }).catch((error) => {
                    if(error.response){
                        toast.error(error.response.data.message,{autoClose:false})
                    }
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

            const data = this.resultSearch;
            const fileName = `Busqueda_Masiva_${day}-${month}-${year}_${hours}-${minutes}-${seconds}.xlsx`;

            const workbook = new ExcelJS.Workbook();
            const worksheet = workbook.addWorksheet('Busqueda Masiva');

            const customHeaders = [
                'Id Producto','Nombre','Color','Medida','EAN','Tarifa','Gama','Nombre Gama','Arancel','Id Proveedor','Volumen','Id Familia','Nombre Familia','Inner','Piezas por Caja'
            ];
            const headerRow = worksheet.addRow(customHeaders);

            headerRow.eachCell((cell) => {
                cell.font = {
                    bold: true,
                };
            });
            data.forEach(item => {
                const rowValues = [
                    item.id, item.name, item.color, item.measure, item.ean, item.tarifa, item.gama,item.nameGama, item.arancel, item.supplierId, item.volume, item.family, item.nameFamily, item.inner, item.piecesBox
                ];
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
    }
}
</script>
<style scoped>

</style>

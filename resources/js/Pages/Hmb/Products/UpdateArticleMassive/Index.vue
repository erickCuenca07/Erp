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
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="name">Partida Arancelaria</label>
                                    <v-select v-model="this.selectPartida" :options="tariffArancelaria.AllPartida" label="name" placeholder="Selecciona la partida arancelaria"></v-select>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="name">Gama</label>
                                    <v-select class="rounded" v-model="gamaSelect" :options="gama" required label="nameGama" placeholder="Seleccione la gama">
                                    </v-select>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="name">Familia</label>
                                    <v-select class="rounded" v-model="familiaSelect" :options="families" required label="nameFamily" placeholder="Seleccione la familia">
                                    </v-select>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="name">Proveedor</label>
                                    <v-select class="rounded" v-model="supplierSelect" :options="suppliers" required :get-option-label="option => option.idProveedor + ' - ' + option.nombre" label="nombre" placeholder="Seleccione el proveedor"></v-select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="name">Marca</label>
                                    <v-select class="rounded" v-model="brandSelect" :options="brand" required :get-option-label="option => option.idBrand + ' - ' + option.nameBrand" label="nameBrand" placeholder="Seleccione la marca"></v-select>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="name">Activo en tarifa</label>
                                    <select class="form-select rounded" v-model="activoTarifa" placeholder="Esta Activo">
                                        <option disabled selected>Esta activo</option>
                                        <option value="1">Si</option>
                                        <option value="0">No</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="name">Dado de Baja</label>
                                    <select class="form-select rounded" v-model="baja" placeholder="Confirma su estado">
                                        <option disabled selected>Elige su estado</option>
                                        <option value="1">Si</option>
                                        <option value="0">No</option>
                                    </select>
                                </div>
                            </div>
                        </div>
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
                                    <th class="text-center text-uppercase text-xs">familia</th>
                                    <th class="text-center text-uppercase text-xs">marca</th>
                                    <th class="text-center text-uppercase text-xs">activo en tarifa</th>
                                    <th class="text-center text-uppercase text-xs">dado de baja</th>
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
                                    <td class="text-center text-xs">{{ index.family }} | {{ index.nameFamily }}</td>
                                    <td class="text-center text-xs">{{index.marcaId}}</td>
                                    <td class="text-center text-xs">{{index.activeTarifa}}</td>
                                    <td class="text-center text-xs" v-if="index.baja === '0'">No</td>
                                    <td class="text-center text-xs" v-if="index.baja === '1'">Si</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <button class="btn bg-gradient-primary">Actualizar</button>
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
import * as XLSX from "xlsx";
import {toast} from "vue3-toastify";
export default {
    name: "UpdateArticleMassive",
    components: {
        Layout,
        TopBar,
        Link,
    },
    props: {
        tariffArancelaria : Object,
        gama : Array,
        families : Array,
        suppliers : Array,
        brand : Array,
    },
    data() {
        return {
            breadcrumbs: {
                title: 'Actualizar Articulos Masivos',
                breadcrumb: {
                    title: 'Productos',
                    url: null
                }
            },
            dates:null,
            resultSearch:'',
            partidaArancelaria:'',
            selectPartida:'',
            gamaSelect:'',
            familiaSelect:'',
            supplierSelect:'',
            brandSelect:'',
            baja:'',
            activoTarifa:'',
        }
    },
    watch:{
        selectPartida(newVal, oldVal){
            if (newVal !== oldVal) {
                console.log('selectPartida',this.selectPartida)
                this.partidaArancelaria = this.tariffArancelaria.PercentagePartida.find(item => item.partidaId === newVal.id)
                console.log('arancel',this.partidaArancelaria)
                for (const item of this.resultSearch){
                    item.arancel = parseFloat(this.partidaArancelaria.percentage).toFixed(2)
                }
            }
        },
        gamaSelect(newVal, oldVal){
            if (newVal !== oldVal) {
                for (const item of this.resultSearch){
                    item.gama = this.gamaSelect.idGama
                    item.nameGama = this.gamaSelect.nameGama
                }
            }
        },
        familiaSelect(newVal, oldVal){
            if (newVal !== oldVal) {
                for (const item of this.resultSearch){
                    item.family = this.familiaSelect.idFamily
                    item.nameFamily = this.familiaSelect.nameFamily
                }
            }
        },
        supplierSelect(newVal, oldVal){
            if (newVal !== oldVal) {
               for (const item of this.resultSearch){
                   item.supplierId = this.supplierSelect.idProveedor
               }
            }
        },
        brandSelect(newVal, oldVal){
            if (newVal !== oldVal) {
                for (const item of this.resultSearch){
                    item.marcaId = this.brandSelect.idBrand
                }
            }
        },
        baja(newVal, oldVal){
            if (newVal !== oldVal) {
                for (const item of this.resultSearch){
                    item.baja = this.baja
                }
            }
        },
        activoTarifa(newVal, oldVal){
            if (newVal !== oldVal) {
                for (const item of this.resultSearch){
                    item.activeTarifa = this.activoTarifa
                }
            }
        },
    },
    methods:{
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

                    //console.log(jsonData); // Aquí tienes los datos en formato JSON

                    // Ahora puedes manipular los datos
                    const rows = jsonData.map(row => row[0]); // Asumiendo que solo quieres la primera columna
                    //console.log(rows);
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
    }
}
</script>

<style scoped>

</style>

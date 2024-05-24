<template>
    <Layout>
        <TopBar :breadcrumbs="breadcrumbs" />
        <div class="container-fluid mt--6" id="print">
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="input-group">
                                        <span class="input-group-text">Supplier</span>
                                        <input type="number" v-model.trim.number="idSupplier" @keydown.enter.prevent="searchSupplier()" required class="form-control rounded" placeholder="Id proveedor">
                                        <input type="text" v-model.trim="nameSupplier" class="form-control rounded" placeholder="Nombre proveedor">
                                    </div>
                                    <div class="input-group">
                                        <span class="input-group-text">Order</span>
                                        <input type="number" v-model="numOrder" required class="form-control rounded" placeholder="nª orden">
                                        <span class="input-group-text">date</span>
                                        <input type="date" required class="form-control rounded" v-model="dateDay">
                                        <span class="input-group-text">$</span>
                                        <input type="number" required class="form-control rounded" v-model="dolarCoin" @change="changeDolar()">
                                        <span class="input-group-text">Asegurar</span>
                                        <input type="text" required class="form-control rounded" value="si">
                                    </div>
                                    <div class="input-group">
                                        <span class="input-group-text">Containers</span>
                                       <v-select :options="container" label="idContainer" v-model="containerSelect" class="form-control rounded" placeholder="container" />
                                        <span class="input-group-text">INCOTERMS</span>
                                        <v-select :options="payment" label="id" v-model="selectPayment" class="form-control rounded" placeholder="payment" required />
                                        <v-select :options="port" label="id" v-model="selectPort" class="form-control rounded" placeholder="port" required/>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="table-responsive">
                                        <table class="tablet table-bordered">
                                            <tbody>
                                            <tr>
                                                <td> GTS.ADIC</td>
                                                <td> <input type="number" v-model="this.additionalCosts" required class="form-control rounded" placeholder="GTS.ADIC" @change="this.calculateTotales"></td>
                                            </tr>
                                            <tr>
                                                <td> IMP.EUR</td>
                                                <td>{{this.impEur}}</td>
                                            </tr>
                                            <tr>
                                                <td> Flete</td>
                                                <td> {{this.flete}} € </td>
                                            </tr>
                                            <tr>
                                                <td> Arancel</td>
                                                <td> {{ this.arancelTotal }}</td>
                                            </tr>
                                            <tr>
                                                <td>Seguro</td>
                                                <td>{{this.sure}}</td>
                                            </tr>
                                            <tr>
                                                <td> fob</td>
                                                <td>{{this.fob}}</td>
                                            </tr>
                                            <tr>
                                                <td> comi.com</td>
                                                <td> 0,00 € </td>
                                            </tr>
                                            <tr>
                                                <td> TOTAL</td>
                                                <td> {{this.allTotales}} € </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="input-group">
                                        <p>{{this.dateDay}} Esc. {{this.scandalCounter.escandallo}}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="row" style="padding-top: 20px">
                                <div class="col-md-6">
                                    <div class="input-group" >
                                        <span class="input-group-text">o.date</span>
                                        <input type="date" required class="form-control rounded" v-model="dateDay">
                                        <span class="input-group-text">DEADLINE</span>
                                        <input type="number" required class="form-control rounded">
                                        <span class="input-group-text">ETD</span>
                                        <input type="date" required class="form-control rounded" v-model="this.etd" @change="updateETA">
                                        <span class="input-group-text">ETA</span>
                                        <input type="date" required class="form-control rounded" v-model="this.eta">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="table-responsive">
                                        <table class="tablet table-bordered" id="table">
                                            <thead>
                                            <tr>
                                                <th></th>
                                                <th class="text-center text-xs">TARIFA</th>
                                                <th class="text-center text-xs">PRECIO 1</th>
                                                <th class="text-center text-xs">PRECIO 2</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td> %M.B</td>
                                                <td class="text-center text-xs">{{this.calculateRate}}</td>
                                                <td class="text-center text-xs">{{this.calculatePrice1}}</td>
                                                <td class="text-center text-xs">{{this.calculatePrice2}}</td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="col-md-1">
                                    <div class="input-group">
                                        <button class="btn btn-primary">Guardar Escandallo</button>
                                    </div>
                                </div>
                                <div class="col-md-1">
                                    <div class="input-group">
                                        <button @click="printPage" class="btn btn-primary">Imprimir</button>
                                    </div>
                                </div>
                                <div class="col-md-1">
                                    <div class="input-group">
                                        <button class="btn btn-success">Crear Propuesta</button>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="table-responsive" style="padding-top: 20px">
                                        <table class="tablet table-bordered table-striped table-striped-columns">
                                            <thead>
                                            <tr>
                                                <th rowspan="2" class="text-center text-xs">Referencia</th>
                                                <th colspan="2" class="text-center text-xs">Descripción</th>
                                                <th rowspan="2" class="text-center text-xs">Prec.Costo</th>
                                                <th rowspan="2" class="text-center text-xs">Marca</th>
                                                <th colspan="2" class="text-center text-xs">Pr.invent</th>
                                                <th rowspan="2" class="text-center text-xs">Cmb</th>
                                                <th rowspan="2" class="text-center text-xs">Total Cmb</th>
                                                <th rowspan="2" class="text-center text-xs">pcs/ctn</th>
                                                <th rowspan="2" class="text-center text-xs">Total cajas</th>
                                                <th rowspan="2" class="text-center text-xs">Total pcs</th>
                                                <th rowspan="2" class="text-center text-xs">Importe</th>
                                                <th rowspan="2" class="text-center text-xs">Arancel</th>
                                                <th rowspan="2" class="text-center text-xs">Acciones</th>
                                                <th  class="text-center text-xs">Tarifa</th>
                                                <th  class="text-center text-xs">Prec.Tarifa</th>
                                                <th colspan="2" class="text-center text-xs">%M.B</th>
                                                <th class="text-center">Precio 1</th>
                                                <th class="text-center">%MB</th>
                                                <th class="text-center">Precio Tecnico</th>
                                            </tr>
                                            <tr>
                                                <th class=" text-center text-xs">Medidas</th>
                                                <th class=" text-center text-xs">Color</th>
                                                <th class="text-center text-xs">Peso(kg)</th>
                                                <th></th>
                                                <th class="text-center text-xs">Cliente</th>
                                                <th class="text-center text-xs">Comision</th>
                                                <th class="text-center text-xs">Dto.PP</th>
                                                <th class="text-center text-xs">Dto.Fra</th>
                                                <th class="text-center">Precio 2</th>
                                                <th class="text-center">%MB</th>
                                                <th class="text-center">Precio Minimo</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td rowspan="2" >
                                                    <input v-model="idArticle" style="width: 120px" class=" rounded" type="text" placeholder="Id del articulo" required @keydown.enter.prevent="searchArticle('main')">
                                                </td>
                                                <td colspan="2" style="font-size: 15px" >
                                                    {{this.nameArticle}}
                                                </td>
                                                <td rowspan="2">
                                                   <input v-model="price" style="width: 66px" class="form-control rounded" type="text" placeholder="costo" required @change="changePrice()">
                                                </td>
                                                <td rowspan="2" class="text-center">
                                                    {{this.brandArticle}}
                                                </td>
                                                <td colspan="2" style="width: 70px;font-size: 13px">
                                                   {{this.priceInventory}} €
                                                </td>
                                                <td rowspan="2" class="text-center" >
                                                    {{this.cbm.toFixed(2)}}
                                                </td>
                                                <td rowspan="2" class="text-center" >
                                                    {{ this.totalCbm.toFixed(2) }}
                                                </td>
                                                <td rowspan="2" class="text-center" >
                                                    {{this.unitBox}}
                                                </td>
                                                <td rowspan="2" class="text-center" >
                                                    <input v-model="totalBox" style="width: 60px" @change="totalPieces('main')" class="form-control rounded" type="text" placeholder="total cajas" required>
                                                </td>
                                                <td rowspan="2" class="text-center" >
                                                    <input v-model="totalPcs" style="width: 64px" @change="totalBoxs('main')" class="form-control rounded" type="text" placeholder="total pcs" required>
                                                </td>
                                                <td rowspan="2" class="text-center" >
                                                    {{this.import}} $
                                                </td>
                                                <td rowspan="2" class="text-center" >
                                                    {{this.arancel.toFixed(2)}} %
                                                </td>
                                                <td rowspan="2" class="text-center">
                                                    <button style="width: 63px" @click="duplicateMainRow">Duplicar</button>
                                                </td>
                                                <td class="text-center">
                                                    <v-select class="rounded" v-model="this.tariffArticle" :options="this.tarifaSelect" required label="tariffArticle"  placeholder="Seleccione la tarifa">
                                                    </v-select>
                                                </td>
                                                <td class="text-center">{{ this.priceTariff }}</td>
                                                <td colspan="2" class="text-center">{{ this.margenBruto}} %</td>
                                                <td class="text-center"> <input v-model="price1" style="width: 105px" class=" rounded" type="number" placeholder="precio 1" @keydown.enter.prevent="calculateMargenBrutoPrice1('main')" required ></td>
                                                <td class="text-center"><input v-model="margenBruto2" style="width: 105px" class=" rounded" type="number" placeholder="%MB 1" @keydown.enter.prevent="calculatePriceTariffFromMargin2('main')" required> </td>
                                                <td class="text-center"> {{this.priceTecnico}} </td>
                                            </tr>
                                            <tr>
                                                <td >
                                                    {{this.measureArticle}}
                                                </td>
                                                <td style="font-size: 15px">
                                                    {{this.colorArticle}}
                                                </td>
                                                <td>
                                                    {{this.weightArticle}}
                                                </td>
                                                <td></td>
                                                <td class="text-center" >
                                                    <v-select class="rounded" v-model="clientSelect" style="font-size: 10px" :options="clients" required :get-option-label="formatOptionLabel"  placeholder="Seleccione el cliente">
                                                    </v-select>
                                                </td>
                                                <td class="text-center">
                                                    {{this.commission}} %
                                                </td>
                                                <td class="text-center">
                                                    {{ this.dtoPP }} %
                                                </td>
                                                <td class="text-center">
                                                    {{ this.dtoFra }} %
                                                </td>
                                                <td class="text-center"> <input v-model="price2" style="width: 105px" class=" rounded" type="number" placeholder="precio 2" @keydown.enter.prevent="calculateMargenBrutoPrice2('main')" required> </td>
                                                <td class="text-center"><input v-model="margenBruto3" style="width: 105px" class=" rounded" type="number" placeholder="%MB 2" @keydown.enter.prevent="calculatePriceTariffFromMargin3('main')" required> </td>
                                                <td class="text-center"> {{this.priceMinimo}} </td>
                                            </tr>
                                            <template v-for="(item,index) in additionalRows">
                                                <tr>
                                                    <td rowspan="2">
                                                        <input v-model="additionalIds[index]" style="width: 120px" class=" rounded" type="text" placeholder="Id del articulo" required @keydown.enter.prevent="searchArticle(index)">
                                                    </td>
                                                    <td colspan="2">
                                                        {{ additionalData[index] ? additionalData[index].nameArticle : '' }}
                                                    </td>
                                                    <td rowspan="2">
                                                        <input :value="additionalData[index] ? additionalData[index].price : ''" style="width: 66px" @input="updatePrice(index, $event.target.value)" class="form-control rounded" type="text" placeholder="costo" required @change="resetImport(index)">
                                                    </td>
                                                    <td rowspan="2" class="text-center">
                                                        {{additionalData[index] ? additionalData[index].brandArticle : ''}}
                                                    </td>
                                                    <td colspan="2" style="width: 70px;">
                                                        {{ additionalData[index] ? additionalData[index].priceInventory : '' }} €
                                                    </td>
                                                    <td rowspan="2" class="text-center">
                                                        {{ additionalData[index] ? additionalData[index].cbm.toFixed(2) : '' }}
                                                    </td>
                                                    <td rowspan="2" class="text-center">
                                                        {{ additionalData[index] ? additionalData[index].totalCbm.toFixed(2) : '' }}
                                                    </td>
                                                    <td rowspan="2" class="text-center">
                                                        {{ additionalData[index] ? additionalData[index].unitBox : '' }}
                                                    </td>
                                                    <td rowspan="2" class="text-center">
                                                        <input :value="additionalData[index] ? additionalData[index].totalBox : ''" style="width: 60px" @input="additionalData[index].totalBox = $event.target.value" @change="totalPieces(index)" class="form-control rounded" type="text" placeholder="total cajas" required>
                                                    </td>
                                                    <td rowspan="2" class="text-center">
                                                        <input :value="additionalData[index] ? additionalData[index].totalPcs : ''" style="width: 60px" @input="additionalData[index].totalPcs = $event.target.value" @change="totalBoxs(index)" class="form-control rounded" type="text" placeholder="total pcs" required>
                                                    </td>
                                                    <td rowspan="2" class="text-center">
                                                        {{ additionalData[index] ? additionalData[index].import.toFixed(2) : '' }} $
                                                    </td>
                                                    <td rowspan="2" class="text-center">
                                                        {{ additionalData[index] ? additionalData[index].arancel.toFixed(2) : '' }} %
                                                    </td>
                                                    <td rowspan="2" class="text-center">
                                                        <button style="width: 72px;color: blue" @click="duplicateRow(index)">Duplicar</button>
                                                        <button  style="width: 72px;color: red" @click="deleteRow(index)">Eliminar línea</button>
                                                    </td>
                                                    <td class="text-center" v-if="additionalData[index]">
                                                        <v-select class="rounded" v-model="additionalData[index].tariffArticle" :options="additionalData[index].tarifaSelect" required label="tariffArticle"  placeholder="Seleccione la tarifa"
                                                        @change="this.calculateTotales">
                                                        </v-select>
                                                    </td>
                                                    <td class="text-center"> {{ additionalData[index] ? additionalData[index].tariffArticle.priceTariff : '' }}</td>
                                                    <td colspan="2" class="text-center"> {{ additionalData[index] ? additionalData[index].margenBruto : 0 }}</td>
                                                    <td class="text-center" v-if="additionalData[index]"> <input v-model="additionalData[index].price1" style="width: 105px" class=" rounded" type="number" placeholder="precio 1" @keydown.enter.prevent="calculateMargenBrutoPrice1('index')" required> </td>
                                                    <td class="text-center" v-if="additionalData[index]"> <input v-model="additionalData[index].margenBruto2" style="width: 105px" class=" rounded" type="number" placeholder="%MB 1" @keydown.enter.prevent="calculatePriceTariffFromMargin2('index')" required></td>
                                                    <td class="text-center" v-if="additionalData[index]"> {{ additionalData[index] ? additionalData[index].priceTecnico : '' }} </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        {{ additionalData[index] ? additionalData[index].measureArticle : '' }}
                                                    </td>
                                                    <td>
                                                        {{ additionalData[index] ? additionalData[index].colorArticle : '' }}
                                                    </td>
                                                    <td>
                                                        {{ additionalData[index] ? additionalData[index].weightArticle : '' }}
                                                    </td>
                                                    <td></td>
                                                    <td class="text-center"  v-if="additionalData[index]">
                                                        <v-select class="rounded" v-model="additionalData[index].clientSelect2" style="font-size: 10px" :options="clients" required :get-option-label="formatOptionLabel" placeholder="Seleccione el cliente"
                                                                  @change="updateClientData(index)">
                                                        </v-select>
                                                    </td>
                                                    <td class="text-center">
                                                        {{ additionalData[index] ? additionalData[index].clientSelect2.commission : '' }} %
                                                    </td>
                                                    <td class="text-center">
                                                        {{ additionalData[index] ? additionalData[index].clientSelect2.dtoPP : '' }} %
                                                    </td>
                                                    <td class="text-center">
                                                        {{additionalData[index] ? additionalData[index].clientSelect2.dtoFra : ''}} %
                                                    </td>
                                                    <td class="text-center" v-if="additionalData[index]"> <input v-model="additionalData[index].price2" style="width: 105px" class=" rounded" type="number" placeholder="precio 2" @keydown.enter.prevent="calculateMargenBrutoPrice2('index')" required> </td>
                                                    <td class="text-center" v-if="additionalData[index]"> <input v-model="additionalData[index].margenBruto3" style="width: 105px" class=" rounded" type="number" placeholder="%MB 2" @keydown.enter.prevent="calculatePriceTariffFromMargin3('index')" required></td>
                                                    <td class="text-center" v-if="additionalData[index]"> {{ additionalData[index] ? additionalData[index].priceMinimo : '' }} </td>
                                                </tr>
                                            </template>
                                            <tr>
                                                <td colspan="5"></td>
                                                <td class="text-center">{{ calculateWeightTotal }} kg</td>
                                                <td colspan="2"></td>
                                                <td class="text-center">{{ calculateCbmTotal }}</td>
                                                <td colspan="1"></td>
                                                <td class="text-center">{{ calculateBoxTotal }} </td>
                                                <td class="text-center">{{ calculatePcsTotal }} </td>
                                                <td  class="text-center">{{ totalImport }} $</td>
                                                <td ></td> <!-- Celda vacía para mantener el diseño -->
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </Layout>
</template>
<script>
import {Link} from '@inertiajs/inertia-vue3';
import Layout from '../../../../Layouts/Layout.vue';
import TopBar from '../../../../Layouts/Navbar/Topbar.vue';
import {toast} from "vue3-toastify";
import jsPDF from "jspdf";
import autoTable from 'jspdf-autotable';
import $ from 'jquery';
export default {
    name: "Index Scandal",
    components: {
        Layout,
        TopBar,
        Link
    },
    props: {
        payment: Array,
        port: Array,
        clients: Array,
        container: Array,
        scandalCounter: Object
    },
    data() {
        return {
            breadcrumbs: {
                title: 'Crear Escandallo',
                breadcrumb: {
                    title: 'Compras',
                    url: null
                }
            },
            idSupplier: '',
            nameSupplier: '',
            numOrder: '',
            dolarCoin: 1.05,
            containerSelect:'',
            selectPayment: '',
            selectPort: '',
            dateDay: new Date().toISOString().substr(0, 10),
            idArticle: '',
            nameArticle: '',
            colorArticle: '',
            measureArticle: '',
            brandArticle: '',
            price: 0,
            cbm: 0,
            unitBox: 0,
            totalBox: 0,
            totalPcs: 0,
            import: 0,
            totalCbm:0,
            clientSelect:'',
            commission: 0,
            dtoPP:0,
            dtoFra: 0,
            clientSelect2: null,
            arancel:0,
            arancelTotal:0,
            weightArticle:0,
            additionalRows:3,
            additionalIds: [],
            additionalData: [],
            originalWeight: 0,
            totalImport: 0,
            calculateBoxTotal:0,
            calculateCbmTotal:0,
            calculatePcsTotal:0,
            calculateWeightTotal:0,
            priceTariff:0,
            sure:0,
            impEur:0,
            updatingClient: false,
            fob:1350,
            priceInventory:0,
            allTotales:0,
            margenBruto:0,
            price1:null,
            price2:null,
            margenBruto2:null,
            margenBruto3:null,
            priceTecnico:0,
            priceMinimo:0,
            cv:0.0935,
            mc:0.2396,
            additionalCosts:0,
            calculateRate:0,
            calculatePrice1:0,
            calculatePrice2:0,
            etd:null,
            eta:null,
            tarifaSelect:[],
            flete:0,
            tariffArticle:'',
        }
    },
    watch: {
        clientSelect: function(newClient, oldClient) {
            if (!this.updatingClient && newClient !== oldClient) {
                this.updatingClient = true;
                this.commission = newClient.commission;
                this.dtoPP = newClient.dtoPP;
                this.dtoFra = newClient.dtoFra;
                this.calculateTotales();
                this.updatingClient = false;
            }
        },
        selectPayment(newValue) {
            let originalPrice = this.containerSelect.priceContainer;
            if (newValue.id === 'CIF') {
                this.flete = 0;
                this.fob = 1350;
            } else if (newValue.id === 'EXW') {
                this.flete = 0;
                this.fob = 0;
            }else if (newValue.id === 'FOB') {
                let transform = parseFloat(originalPrice) / parseFloat(this.dolarCoin)
                this.flete = Math.round(transform)
                this.fob = 1350;
            }
        },
        tariffArticle(newVal,old) {
            if (newVal !== old) {
                const selectedTariff = this.tarifaSelect.find(item => item.tariffArticle === newVal.tariffArticle);
                if (selectedTariff) {
                    this.priceTariff = parseFloat(selectedTariff.priceTariff);
                    this.calculateTotales();
                } else {
                    this.priceTariff = null;
                }
            }
        },
    },
    methods: {
        changeDolar(){
            let transform = parseFloat(this.containerSelect.priceContainer) / parseFloat(this.dolarCoin)
            this.flete = Math.round(transform)
            this.calculateTotales();
        },
        updateClientData(index) {
            console.log('data',index)
            const selectedClient = this.additionalData[index].clientSelect2;
            console.log(selectedClient)
            if (selectedClient) {
                this.additionalData[index].clientSelect2.commission = selectedClient.commission;
                this.additionalData[index].clientSelect2.dtoPP = selectedClient.dtoPP;
                this.additionalData[index].clientSelect2.dtoFra = selectedClient.dtoFra;
                this.calculateTotales();
            }
        },
        formatOptionLabel(option) {
            return `${option.nameGroupCli}-${option.marca}`;
        },
        printPage: async function() {
            const doc = new jsPDF('l', 'pt', 'a4');
            const data = [
                ['Supplier', this.idSupplier + ' - ' + this.nameSupplier],
                ['Order', this.numOrder],
                ['Date', this.dateDay],
                ['Dolar Coin', '$' + this.dolarCoin],
                ['Asegurar', 'si'],
                ['Container', this.containerSelect.idContainer],
                ['INCOTERMS', this.selectPayment.id],
                ['Port', this.selectPort.id]
            ];
            doc.autoTable({
                startY: 20,
                startX:20,
                head: false,
                body: data,
                styles: {
                    cellPadding: 2, // Reducir el espaciado entre celdas
                    cellWidth: 115, // Reducir el ancho de las celdas
                },
                margin: { left: 20 } // Margen izquierdo para la primera tabla
            })
            // Tabla 2: Otros datos
            const otherData = [
                ['GTS.ADIC', this.additionalCosts],
                ['IMP.EUR', this.impEur],
                ['Flete', this.flete + ' €' ],
                ['Arancel', this.arancelTotal],
                ['Seguro', this.sure],
                ['fob', this.fob],
                ['comi.com', '0,00 €'],
                ['TOTAL', this.allTotales + ' €']
            ];
            doc.autoTable({
                startY: 20, // Misma altura de inicio que la primera tabla
                head: false,
                body: otherData,
                styles: {
                    fontSize: 10, // Reducir el tamaño de la fuente
                    cellPadding: 2, // Reducir el espaciado entre celdas
                    cellWidth: 63, // Ancho de las celdas
                    lineHeight: 10 // Reducir el interlineado
                },
                margin: { left: 300 }
            });
            doc.autoTable({
                startY: 20, // Misma altura de inicio que la primera tabla
                html: '#table',
                styles: {
                    fontSize: 8, // Reducir el tamaño de la fuente
                    cellPadding: 2, // Reducir el espaciado entre celdas
                    cellWidth: 63, // Ancho de las celdas
                    lineHeight: 10, // Reducir el interlineado
                    valign: 'middle', // Centrar verticalmente el contenido de las celdas
                    halign: 'center' // Centrar horizontalmente el contenido de las celdas
                },
                margin: { left: 500 }
            })
            doc.autoTable({
                startY: 60, // Misma altura de inicio que la primera tabla
                head:[
                  ['O.Date', 'DEADLINE', 'ETD', 'ETA']
                ],
                body: [
                    [this.dateDay, , this.etd, this.eta]
                ],
                styles: {
                    fontSize: 8, // Reducir el tamaño de la fuente
                    cellPadding: 2, // Reducir el espaciado entre celdas
                    cellWidth: 63, // Ancho de las celdas
                    lineHeight: 10, // Reducir el interlineado
                    valign: 'middle', // Centrar verticalmente el contenido de las celdas
                    halign: 'center' // Centrar horizontalmente el contenido de las celdas
                },
                margin: { left: 500 }
            })
            doc.autoTable({
                startY: 100,
                head: [
                    ['T.Peso','T.CBM','T.Cajas','T.Pcs','T.Importe']
                ],
                body:[
                    [this.calculateWeightTotal, this.calculateCbmTotal, this.calculateBoxTotal, this.calculatePcsTotal, this.totalImport]
                ],
                styles: {
                    fontSize: 8, // Reducir el tamaño de la fuente
                    cellPadding: 2, // Reducir el espaciado entre celdas
                    cellWidth: 63, // Ancho de las celdas
                    lineHeight: 10, // Reducir el interlineado
                    valign: 'middle', // Centrar verticalmente el contenido de las celdas
                    halign: 'center' // Centrar horizontalmente el contenido de las celdas
                },
                margin: { left: 500 }
            })
            //tabla 3: articulos
             const rows = this.additionalData.map(item =>[item.idArticle, item.nameArticle, item.measureArticle, item.colorArticle, item.price, item.brandArticle, item.priceInventory, item.weightArticle,
                parseFloat(item.cbm).toFixed(2), parseFloat(item.totalCbm).toFixed(2), item.unitBox, item.totalBox, item.totalPcs, parseFloat(item.import).toFixed(2), item.arancel,item.tariffArticle.tariffArticle,item.priceTariff,item.margenBruto,item.clientSelect2.nameGroupCli,item.clientSelect2.commission,item.clientSelect2.dtoPP,item.clientSelect2.dtoFra,item.price1,item.margenBruto2,item.price2,item.margenBruto3,item.priceTecnico,item.priceMinimo
            ]);
             let fixedImport = parseFloat(this.import).toFixed(2);
             let fixedCbm = parseFloat(this.totalCbm).toFixed(2);
             rows.unshift([this.idArticle, this.nameArticle, this.measureArticle, this.colorArticle, this.price, this.brandArticle, this.priceInventory, this.weightArticle, parseFloat(this.cbm).toFixed(2), fixedCbm,
                 this.unitBox, this.totalBox, this.totalPcs, fixedImport, this.arancel,this.tariffArticle.tariffArticle,this.priceTariff,this.margenBruto,this.clientSelect.nameGroupCli,this.commission,this.dtoPP,this.dtoFra,this.price1,this.margenBruto2,this.price2,this.margenBruto3,this.priceTecnico,this.priceMinimo
             ]);
            doc.autoTable({
                startY: 200,
                theme: 'grid',
                head:[
                       ['Referencia','Nombre','Medidas','Color','Pre.Costo','Marca','Pre.Invent','Peso','CBM','Total CBM','PCS','Total Cajas','Total PCS','Importe','Arancel','Tarifa','Pre.Tarifa','MB','Cliente','Comision','Dto PP','Dto FR','Precio 1','MB','Precio 2','MB','Prec.Tecnico','Prec.Minimo']
                ],
                body: rows,
                styles: {
                    fontSize: 6, // Tamaño de fuente global
                    lineHeight: 8, // Reducir espacio entre líneas
                    cellPadding: 2, // Reducir el espaciado entre celdas
                    valign: 'middle', // Centrar verticalmente el contenido de las celdas
                    halign: 'center' // Centrar horizontalmente el contenido de las celdas
                },

                margin: { left: 20 },
            });
            const currentDate = new Date();
            const currentHour = currentDate.getHours();
            const currentMinute = currentDate.getMinutes();
            const totalPages = doc.internal.getNumberOfPages();
            for (let i = 1; i <= totalPages; i++) {
                doc.setPage(i);
                doc.setFontSize(10);
                const pageNumberText = `Página ${i} de ${totalPages}`; // Texto del número de página
                const pageNumberWidth = doc.getStringUnitWidth(pageNumberText) * doc.internal.getFontSize(); // Ancho del texto del número de página
                const footerText = `Esc. ${this.scandalCounter.escandallo}`; // Texto del pie de página
                const footerX = doc.internal.pageSize.getWidth() - 20 - pageNumberWidth; // Posición X del texto del pie de página
                doc.text(footerText, 20, doc.internal.pageSize.getHeight() - 10); // Texto del pie de página a la izquierda
                doc.text(pageNumberText, footerX, doc.internal.pageSize.getHeight() - 10); // Número de página a la derecha
            }
            const fileName = `Escandallo-${this.scandalCounter.escandallo}+${this.dateDay}+${currentHour}_${currentMinute}.pdf`;
            doc.save(fileName);
        },
        searchSupplier() {
            toast('Buscando proveedor...');
            const data = {
                idSupplier: this.idSupplier
            }
            axios.post(route('createScandal.searchSupplier'), data).then((response) => {
                toast.success('Proveedor encontrado');
                this.nameSupplier = response.data[0].nombre
                this.numOrder = response.data[0].numPedido
                if (this.numOrder === 0){
                    this.numOrder = 1
                }else{
                    this.numOrder = response.data[0].numPedido + 1
                }
            }).catch(error => {
                toast.error(error.response.data.message,{autoClose:false})
            })
        },
        searchArticle(idInput) {
            toast('Buscando articulo...');
            const idArticle = idInput === 'main' ? this.idArticle : this.additionalIds[idInput];
            const data = {
                idArticle: idArticle
            }
            axios.post(route('createScandal.searchArticle'), data).then((response) => {
                if(response.data.length === 0){
                    toast.error(`Artículo ${idArticle} no encontrado`, {autoClose:false});
                    return
                }
                toast.success('Articulo encontrado');
                if(idInput === 'main') {
                    this.nameArticle = response.data[0].nameArticle
                    this.colorArticle = response.data[0].colorArticle
                    this.measureArticle = response.data[0].measureArticle
                    this.brandArticle = response.data[0].brandArticle
                    this.unitBox = response.data[0].unitBox
                    this.totalPcs = this.unitBox
                    this.totalBox = 1
                    this.price = parseFloat(response.data[0].preCost)
                    this.import = parseFloat(this.totalPcs * this.price).toFixed(2)
                    this.arancel = parseFloat(response.data[0].arancel)
                    this.weightArticle = parseFloat(response.data[0].weightArticle)
                    this.originalWeight = parseFloat(response.data[0].weightArticle)
                    //this.priceTariff = parseFloat(response.data[1].priceTariff)
                    this.totalImport = parseFloat(this.import).toFixed(2)
                    this.calculateBoxTotal = this.totalBox
                    this.calculatePcsTotal = this.totalPcs
                    this.calculateWeightTotal = this.weightArticle
                    this.cbm = parseFloat(response.data[0].cbm)
                    this.totalCbm = this.cbm
                    this.calculateCbmTotal = this.cbm
                    this.tarifaSelect = response.data[2]
                    if (this.brandArticle === 'LEO') {
                        const tariffObj = this.tarifaSelect.find(item => item.tariffArticle === 'LG');
                        const client = this.clients.find(item => item.nameGroupCli === 'General' && item.marca === this.brandArticle);
                        this.clientSelect = client
                        if (tariffObj) {
                            this.tariffArticle = tariffObj;
                            this.priceTariff = parseFloat(tariffObj.priceTariff)
                        } else {
                            this.tariffArticle = this.tarifaSelect[0]
                            this.priceTariff = parseFloat(this.tariffArticle.priceTariff)
                        }
                    }else if (this.brandArticle === 'ICE') {
                        const tariffObj = this.tarifaSelect.find(item => item.tariffArticle === 'HG');
                        const client = this.clients.find(item => item.nameGroupCli === 'General' && item.marca === this.brandArticle);
                        this.clientSelect = client
                        if (tariffObj) {
                            this.tariffArticle = tariffObj;
                            this.priceTariff = parseFloat(tariffObj.priceTariff)
                        } else {
                            this.tariffArticle = this.tarifaSelect[0]
                            this.priceTariff = parseFloat(this.tariffArticle.priceTariff)
                        }
                    } else{
                        this.tariffArticle = this.tarifaSelect[0]
                        this.priceTariff = parseFloat(this.tariffArticle.priceTariff)
                    }
                }else{
                    this.additionalData[idInput] = {
                        idArticle: this.additionalIds[idInput],
                        nameArticle: response.data[0].nameArticle,
                        colorArticle: response.data[0].colorArticle,
                        measureArticle: response.data[0].measureArticle,
                        brandArticle: response.data[0].brandArticle,
                        unitBox: response.data[0].unitBox,
                        price: parseFloat(response.data[0].preCost),
                        arancel: parseFloat(response.data[0].arancel),
                        weightArticle: parseFloat(response.data[0].weightArticle),
                        originalWeight: parseFloat(response.data[0].weightArticle),
                        totalBox:1,
                        totalPcs:response.data[0].unitBox,
                        import: response.data[0].unitBox * parseFloat(response.data[0].preCost),
                        priceTariff: 0,
                        cbm: parseFloat(response.data[0].cbm),
                        totalCbm : parseFloat(response.data[0].cbm),
                        clientSelect2:[],
                        tarifaSelect:response.data[2],
                        tariffArticle: 0,
                        dtoFra:0,
                        margenBruto:0,
                    };
                    if (this.totalImport === 0) {
                        this.totalImport = this.additionalData[idInput].import
                    }else{
                        this.totalImport += this.additionalData[idInput].import
                        this.totalImport = parseFloat(this.totalImport).toFixed(2)
                    }
                    if (this.calculateBoxTotal === 0) {
                        this.calculateBoxTotal = this.additionalData[idInput].totalBox
                    }else{
                        this.calculateBoxTotal += this.additionalData[idInput].totalBox
                    }
                    if (this.calculatePcsTotal === 0) {
                        this.calculatePcsTotal = parseFloat(this.additionalData[idInput].totalPcs)
                    }else{
                        const totalPcs = parseFloat(this.additionalData[idInput].totalPcs).toFixed(2);
                        this.calculatePcsTotal = (parseFloat(this.calculatePcsTotal) + parseFloat(totalPcs)).toFixed(2);
                    }
                    if (this.additionalData[idInput].brandArticle === 'LEO') {
                        const tariffObj = this.additionalData[idInput].tarifaSelect.find(item => item.tariffArticle === 'LG');
                        const client = this.clients.find(item => item.nameGroupCli === 'General' && item.marca === this.additionalData[idInput].brandArticle);
                        this.additionalData[idInput].clientSelect2 = client
                        this.additionalData[idInput].clientSelect2.dtoPP = (client.dtoPP)
                        this.additionalData[idInput].clientSelect2.dtoFra = parseFloat(client.dtoFra)
                        console.log('clientSelect2',this.additionalData[idInput].clientSelect2.dtoPP)
                        if (tariffObj) {
                            this.additionalData[idInput].tariffArticle = tariffObj;
                            this.additionalData[idInput].priceTariff = parseFloat(tariffObj.priceTariff).toFixed(2)
                        } else {
                            this.additionalData[idInput].tariffArticle = this.additionalData[idInput].tarifaSelect[0]
                            this.additionalData[idInput].priceTariff = parseFloat(this.additionalData[idInput].tariffArticle.priceTariff).toFixed(2)
                        }
                        this.calculateTotales();
                    }else if (this.additionalData[idInput].brandArticle === 'ICE') {
                        const tariffObj = this.additionalData[idInput].tarifaSelect.find(item => item.tariffArticle === 'HG');
                        const client = this.clients.find(item => item.nameGroupCli === 'General' && item.marca === this.additionalData[idInput].brandArticle);
                        this.additionalData[idInput].clientSelect2 = client
                        this.additionalData[idInput].clientSelect2.dtoPP = parseFloat(client.dtoPP)
                        this.additionalData[idInput].clientSelect2.dtoFra = parseFloat(client.dtoFra)
                        if (tariffObj) {
                            this.additionalData[idInput].tariffArticle = tariffObj;
                            this.additionalData[idInput].priceTariff = parseFloat(tariffObj.priceTariff).toFixed(2)
                        } else {
                            this.additionalData[idInput].tariffArticle = this.additionalData[idInput].tarifaSelect[0];
                            this.additionalData[idInput].priceTariff = parseFloat(this.additionalData[idInput].tariffArticle.priceTariff).toFixed(2)
                        }
                        this.calculateTotales()
                    } else {
                        this.additionalData[idInput].tariffArticle = this.additionalData[idInput].tarifaSelect[0];
                        this.additionalData[idInput].priceTariff = parseFloat(this.additionalData[idInput].tariffArticle.priceTariff).toFixed(2)
                    }
                }
            }).catch(error => {
                if(error.response){
                    toast.error(error.response.data.message,{autoClose:false})
                }
            })
        },
        totalPieces(index){
            if (index === 'main'){
                this.totalPcs = this.totalBox * this.unitBox
                this.totalCbm = this.totalBox * this.cbm
                this.import = this.totalPcs * this.price
                this.import = parseFloat(this.import).toFixed(2)
                const peso = this.originalWeight * this.totalPcs
                this.weightArticle = peso.toFixed(2);
                this.calculateTotales()
            }else{
                const item = this.additionalData[index];
                if (!item) return;
                item.totalPcs = item.totalBox * item.unitBox;
                item.totalCbm= item.totalBox * item.cbm;
                item.import = item.totalPcs * item.price;
                const peso = item.originalWeight * item.totalPcs;
                item.weightArticle = peso.toFixed(2);
                this.calculateTotales();
            }
        },
        totalBoxs(index){
            if (index === 'main'){
                this.totalBox = this.totalPcs / this.unitBox
                this.totalCbm = this.totalBox * this.cbm
                this.import = this.totalPcs * this.price
                this.import = parseFloat(this.import).toFixed(2)
                const peso = this.originalWeight * this.totalPcs
                this.weightArticle = peso.toFixed(2);
                this.calculateTotales()
            }else{
                const item = this.additionalData[index];
                if (!item) return;
                item.totalBox = item.totalPcs / item.unitBox;
                item.totalCbm = item.totalBox * item.cbm;
                item.import = item.totalPcs * item.price;
                const peso = item.originalWeight * item.totalPcs;
                item.weightArticle = peso.toFixed(2);
                this.calculateTotales();
            }

        },
        changePrice() {
            this.import=0
            this.arancelTotal=0
            this.weightArticle=this.originalWeight
            this.totalPcs=0
            this.totalCbm=0
            this.totalBox=0
            this.totalImport=0
            this.calculatePcsTotal=0
            this.calculateCbmTotal=0
            this.calculateBoxTotal=0
        },
        updatePrice(index, value) {
            this.additionalData[index].price = value;
        },
        resetImport(index) {
            this.additionalData[index].import = 0;
            this.additionalData[index].totalPcs = 0;
            this.additionalData[index].totalCbm = 0;
            this.additionalData[index].totalBox = 0;
            this.additionalData[index].weightArticle = this.additionalData[index].originalWeight;
            this.arancelTotal = 0;
            this.additionalData[index].totalImport = 0;
            this.additionalData[index].calculatePcsTotal = 0;
            this.additionalData[index].calculateCbmTotal = 0;
            this.additionalData[index].calculateBoxTotal = 0;
        },
        calculateTotales(){
            this.totalImport = 0
            this.totalImport = parseFloat(this.import);
            this.calculatePcsTotal = 0
            this.calculatePcsTotal = parseFloat(this.totalPcs);
            this.calculateBoxTotal = 0
            this.calculateBoxTotal = parseFloat(this.totalBox);
            this.calculateCbmTotal = 0
            this.calculateCbmTotal = parseFloat(this.totalCbm);
            let calculateArancel = (this.import * this.arancel) / 100
            this.arancelTotal = calculateArancel
            this.calculateWeightTotal = this.weightArticle
            for (const item of this.additionalData) {
                this.totalImport += parseFloat(item.import);
                this.calculatePcsTotal += parseFloat(item.totalPcs);
                this.calculateBoxTotal += parseFloat(item.totalBox);
                this.calculateCbmTotal += parseFloat(item.totalCbm);
                let calculateArancel = (item.import * item.arancel) / 100
                this.arancelTotal += calculateArancel
                this.calculateWeightTotal = parseFloat(this.calculateWeightTotal) + parseFloat(item.weightArticle);
                item.priceTariff = item.tariffArticle.priceTariff
            }
            this.calculateWeightTotal = parseFloat(this.calculateWeightTotal).toFixed(2)
            this.arancelTotal = (this.arancelTotal / this.dolarCoin).toFixed(2);
            this.totalImport = parseFloat(this.totalImport.toFixed(2));
            this.calculatePcsTotal = parseFloat(this.calculatePcsTotal.toFixed(2));
            this.calculateBoxTotal = parseFloat(this.calculateBoxTotal.toFixed(2));
            this.calculateCbmTotal = parseFloat(this.calculateCbmTotal.toFixed(2));
            const sure =this.totalImport * 1.1;
            let sure12 = sure * 0.0012
            let sureTotal = sure12 * this.dolarCoin
            this.sure = sureTotal.toFixed(2)
            let a = (this.import / this.dolarCoin) + ((((this.arancel) * this.import) / this.dolarCoin) / 100) + ((parseFloat(this.sure) + parseFloat(this.flete) + this.fob + parseFloat(this.additionalCosts)) * parseFloat(this.totalCbm).toFixed(2)) / this.calculateCbmTotal
            a = a/ this.totalPcs;
            this.priceInventory = a.toFixed(4)
            for (const item of this.additionalData){
                let a = (parseFloat(item.import) / this.dolarCoin) + ((((item.arancel) * parseFloat(item.import)) / this.dolarCoin) / 100) + ((parseFloat(this.sure) + parseFloat(this.flete) + this.fob + parseFloat(this.additionalCosts)) * parseFloat(item.totalCbm).toFixed(2)) / this.calculateCbmTotal
                a = a/ item.totalPcs;
                item.priceInventory = a.toFixed(4)
            }
            this.impEur=(this.totalImport / this.dolarCoin).toFixed(2)
            this.calculateMargenBruto();
            this.calculateMargenAdditional();
            this.allTotales = (parseFloat(this.impEur) + parseFloat(this.flete) + parseFloat(this.arancelTotal) + parseFloat(this.sure) + parseFloat(this.fob) + parseFloat(this.additionalCosts)).toFixed(2)
            let calculate = (this.totalImport *  (this.margenBruto / 100)) / this.totalImport;
            this.calculateRate = (calculate * 100).toFixed(2)
        },
        duplicateRow(index){
            const newData = {
                idArticle: '',
                nameArticle: '',
                colorArticle: '',
                measureArticle: '',
                brandArticle: '',
                unitBox: '',
                tariffArticle: '',
                price: 0,
                arancel: 0,
                weightArticle: 0,
                originalWeight: 0,
                totalBox:0,
                totalPcs:'',
                import: 0,
                totalCbm:0,
                priceTariff: 0,
                clientSelect2:'',
                cbm:0
            };
            this.additionalData.push(newData);
            this.additionalRows++;
        },
        deleteRow(index) {
            if (index >= 0 && index < this.additionalData.length) {
                this.additionalData.splice(index, 1);
                this.additionalRows--;
                this.calculateTotales();
            } else {
                toast.error('No se puede eliminar esta linea',{autoClose:false})
            }
        },
        duplicateMainRow(){
            const newData = {
                idArticle: this.idArticle,
                nameArticle: this.nameArticle,
                colorArticle: this.colorArticle,
                measureArticle: this.measureArticle,
                brandArticle: this.brandArticle,
                unitBox: this.unitBox,
                tariffArticle: this.tariffArticle,
                price: parseFloat(this.price),
                arancel: parseFloat(this.arancel),
                weightArticle: parseFloat(this.weightArticle),
                originalWeight: parseFloat(this.originalWeight),
                totalBox:1,
                totalPcs:this.unitBox,
                import: this.unitBox * parseFloat(this.price),
                totalCbm:0,
                priceTariff: parseFloat(this.priceTariff),
                clientSelect2:'',
                cbm:this.cbm
            };
            this.additionalData.push(newData);
            this.additionalRows++;
        },
        calculateMargenBruto(){
            console.log('dtoPP',this.dtoPP)
            console.log('dtoFra',this.dtoFra)
            console.log('priceTariff',this.priceTariff)
            console.log('priceInventory',this.priceInventory)
            let priceSale = this.priceTariff - (this.priceTariff * (this.dtoPP / 100)) - (this.priceTariff * (this.dtoFra / 100))
            let margenBrutoPercent = ((parseFloat(priceSale) - this.priceInventory) / parseFloat(priceSale)) * 100;
            let rest = 1- this.cv;
            this.priceMinimo = (this.priceInventory / rest).toFixed(2);
            let rest2 = 1- this.mc;
            this.priceTecnico = (this.priceInventory / rest2).toFixed(2);
            return this.margenBruto = margenBrutoPercent.toFixed(2)
        },
        calculateMargenAdditional(){
            for (const item of this.additionalData){
                let priceSale = parseFloat(item.priceTariff) - (parseFloat(item.priceTariff) * (parseFloat(item.clientSelect2.dtoPP) / 100)) - (parseFloat(item.priceTariff) * (parseFloat(item.clientSelect2.dtoFra) / 100))
                let margenBrutoPercent = ((parseFloat(priceSale) - item.priceInventory) / parseFloat(priceSale)) * 100;
                let rest = 1- this.cv;
                item.priceMinimo = (item.priceInventory / rest).toFixed(2);
                let rest2 = 1- this.mc;
                item.priceTecnico = (item.priceInventory / rest2).toFixed(2);
                item.margenBruto = margenBrutoPercent.toFixed(2)
            }
        },
        calculateMargenBrutoPrice1(idInput){
            if (idInput === 'main') {
                let priceSale = this.price1 - (this.price1 * (this.dtoPP / 100)) - (this.price1 * (this.dtoFra / 100));
                let margenBruto = ((priceSale - this.priceInventory) / priceSale) * 100;
                this.margenBruto2 = margenBruto.toFixed(2);
                let calculate = (this.totalImport *  (this.margenBruto2 / 100)) / this.totalImport;
                this.calculatePrice1 = (calculate * 100).toFixed(2)
            }else{
                for (const item of this.additionalData){
                    let priceSale = parseFloat(item.price1) - ((parseFloat(item.clientSelect2.dtoPP) / 100) * parseFloat(item.priceTariff)) - ((parseFloat(item.clientSelect2.dtoFra) / 100) * parseFloat(item.price1))
                    let margenBrutoPercent = ((parseFloat(priceSale).toFixed(2) - item.priceInventory) / parseFloat(priceSale).toFixed(2)) * 100;
                    item.margenBruto2 = margenBrutoPercent.toFixed(2);
                    let calculate = (this.totalImport *  (item.margenBruto2 / 100)) / this.totalImport;
                    this.calculatePrice1 = (calculate * 100).toFixed(2)
                }
            }
        },
        calculateMargenBrutoPrice2(idInput){
            if (idInput === 'main') {
                let priceSale = this.price2 - (this.price2 * (this.dtoPP / 100)) - (this.price2 * (this.dtoFra / 100));
                let margenBruto = ((priceSale - this.priceInventory) / priceSale) * 100;
                this.margenBruto3 = margenBruto.toFixed(2);
                let calculate = (this.totalImport *  (this.margenBruto3 / 100)) / this.totalImport;
                this.calculatePrice2 = (calculate * 100).toFixed(2)
            }else{
                for (const item of this.additionalData){
                    let priceSale = item.price2 - ((item.clientSelect2.dtoPP / 100) * item.priceTariff) - ((item.clientSelect2.dtoFra / 100) * item.price2)
                    let margenBrutoPercent = ((parseFloat(priceSale).toFixed(2) - item.priceInventory) / parseFloat(priceSale).toFixed(2)) * 100;
                    item.margenBruto3 = margenBrutoPercent.toFixed(2);
                    let calculate = (this.totalImport *  (item.margenBruto3 / 100)) / this.totalImport;
                    this.calculatePrice2 = (calculate * 100).toFixed(2)
                }
            }
        },
        calculatePriceTariffFromMargin2(id) {
            if (id === 'main') {
                let rest = 1 - (this.margenBruto2 / 100)
                let priceSale = this.priceInventory / rest;
                let priceTariff = priceSale / (1 - (this.dtoPP / 100)) - (this.dtoFra / 100);
                return this.price1 = priceTariff.toFixed(2);
            }else{
                for (const item of this.additionalData){
                    let rest = 1 - (item.margenBruto2 / 100)
                    let priceSale = parseFloat(item.priceInventory) / rest;
                    let priceTariff = priceSale / (1 - (parseFloat(item.clientSelect2.dtoPP) / 100) - (parseFloat(item.clientSelect2.dtoFra) / 100));
                    item.price2 = priceTariff.toFixed(2);
                }
            }
        },
        calculatePriceTariffFromMargin3(id) {
            if (id === 'main') {
                let rest = 1 - (this.margenBruto3 / 100)
                let priceSale = this.priceInventory / rest;
                let priceTariff = priceSale / (1 - (this.dtoPP / 100)) - (this.dtoFra / 100);
                return this.price2 = priceTariff.toFixed(2);
            }else{
                for (const item of this.additionalData){
                    let rest = 1 - (item.margenBruto3 / 100)
                    let priceSale = parseFloat(item.priceInventory) / rest;
                    let priceTariff = priceSale / (1 - (parseFloat(item.clientSelect2.dtoPP) / 100) - (parseFloat(item.clientSelect2.dtoFra) / 100));
                    item.price2 = priceTariff.toFixed(2);
                }
            }
        },
        updateETA() {
            if (this.etd) {
                const etd = new Date(this.etd);
                const eta = new Date(etd.getTime() + (110 * 24 * 60 * 60 * 1000)); // Suma 110 días en milisegundos
                this.eta = eta.toISOString().substr(0, 10);
            }
        }
    },
}
</script>
<style scoped>
table thead th,td[rowspan] {
    vertical-align: middle;
}
</style>

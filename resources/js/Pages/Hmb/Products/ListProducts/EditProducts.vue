<template>
<Layout>
        <TopBar :breadcrumbs="breadcrumbs"/>
    <div class="container-fluid mt--6">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header pb-0">
                        <h3>Estas editando el articulo: <strong>{{searchProduct[0].id}}</strong>-<strong>{{searchProduct[0].name}}</strong></h3>
                    </div>
                    <div class="card-body pt-0">
                        <div class="container">
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="name">Nombre</label>
                                        <input v-model="searchProduct[0].name" type="text" class="form-control rounded" id="name">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="name">Peso Bruto</label>
                                        <input v-model="searchProduct[0].weight" type="text" class="form-control rounded" id="name">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="name">Peso Neto</label>
                                        <input v-model="searchProduct[0].netWeight" type="text" class="form-control rounded" id="name">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="name">CBM / Volumen</label>
                                        <input v-model="searchProduct[0].volume" type="text" class="form-control rounded" id="name">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="input-group">
                                        <label for="name">Gama</label>
                                        <v-select class="form-control rounded" v-model="gamaSelect" :options="gama" required label="nameGama" placeholder="Seleccione la gama">
                                        </v-select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="name">EAN</label>
                                        <input v-model="searchProduct[0].ean" disabled type="text" class="form-control rounded" id="name">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="name">Familia</label>
                                        <v-select class="form-control rounded" v-model="this.familySelect" :options="families" required label="nameFamily" placeholder="Seleccione la familia">
                                        </v-select>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="name">Tarifa</label>
                                        <v-select class="form-control rounded" v-model="this.rateSelect" :options="rates" required label="nameRate" placeholder="Seleccione la tarifa">
                                        </v-select>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="name">Piezas x Caja</label>
                                        <input v-model="searchProduct[0].piecesBox" type="text" class="form-control rounded" id="name">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="name">Relleno</label>
                                        <input v-model="searchProduct[0].relleno" type="text" class="form-control rounded" id="name">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="name">Medidas</label>
                                        <input type="text" v-model="searchProduct[0].measure" class="form-control rounded" >
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="name">Precio Medio Coste</label>
                                        <input type="text" v-model="searchProduct[0].premedcoste" class="form-control rounded" >
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="name">Precio Tecnico</label>
                                        <input type="text" v-model="searchProduct[0].pretecnico" class="form-control rounded" >
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="name">Precio Minimo</label>
                                        <input type="text" v-model="searchProduct[0].preminimo" class="form-control rounded" >
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="name">Precio Tarifa</label>
                                        <input type="text" v-model="searchProduct[0].pretarifa" class="form-control rounded" >
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="name">Marca</label>
                                        <input v-model="searchProduct[0].marcaId" class="form-control rounded">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="name">Inner</label>
                                        <input v-model="searchProduct[0].inner" class="form-control rounded">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="name">Size Bag</label>
                                        <input v-model="searchProduct[0].sizeBag" class="form-control rounded">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="name">Arancel</label>
                                        <input v-model="searchProduct[0].arancel" class="form-control rounded">
                                    </div>
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
<script >
import {Link} from '@inertiajs/inertia-vue3'
import Layout from '../../../../Layouts/Layout.vue';
import TopBar from '../../../../Layouts/Navbar/Topbar.vue';

export default {
    name: "EditProducts",
    components: {
        Layout,
        TopBar,
        Link,
    },
    props: {
        searchProduct: Array,
        families: Array,
        rates: Array,
        gama: Array,
    },
    data() {
        return {
            breadcrumbs: {
                title: 'Editar Productos',
                breadcrumb: {
                    title: 'Productos',
                    url: null
                }
            },
            familySelect: '',
            rateSelect: '',
            gamaSelect: '',
        }
    },
    created() {
        this.familySelect = this.families.find(family => family.idFamily === parseInt(this.searchProduct[0].family));
        this.rateSelect = this.rates.find(rate => rate.idRate === (this.searchProduct[0].tarifa));
        this.gamaSelect = this.gama.find(gama => gama.idGama === parseInt(this.searchProduct[0].gama));
    }
}
</script>
<style scoped>

</style>

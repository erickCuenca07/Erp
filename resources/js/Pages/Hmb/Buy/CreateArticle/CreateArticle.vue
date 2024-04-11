<template>
<Layout>
    <TopBar :breadcrumbs="breadcrumbs" />
    <div class="container-fluid mt--6">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3>Creacion de Articulo</h3><br>
                    </div>
                    <hr class="horizontal dark">
                    <div class="car-body" v-if="this.$permissions(this.$page.props.auth.user, 'compras-crear-articulo')">
                        <div class="row">
                            <div class="col-12 ">
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                        <tr>
                                            <th>id articulo</th>
                                            <th>nombre articulo</th>
                                            <th>color</th>
                                            <th>medida</th>
                                            <th>gramaje</th>
                                            <th>relleno</th>
                                            <th>construccion</th>
                                            <th>med.bolsa</th>
                                            <th>med.caja</th>
                                            <th>piezas x caja</th>
                                            <th>marca</th>
                                            <th>cliente</th>
                                            <th>tarifa</th>
                                            <th>gama</th>
                                            <th>familia</th>
                                            <th>Pcs</th>
                                            <th>Inner</th>
                                            <th>peso</th>
                                            <th>umv</th>
                                            <th>Eti.textil</th>
                                            <th>Eti.Hangtag</th>
                                            <th>Pegatinas</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td>
                                                <div class="row">
                                                    <div class="col-sm">
                                                        <div class="input-group">
                                                            <input v-model="idArticle" class="form-control rounded" type="text" placeholder="Id del articulo" required="required">
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="row">
                                                    <div class="col-sm">
                                                        <div class="input-group">
                                                            <input v-model="nameArticle" class="form-control rounded" type="text" placeholder="nombre del articulo" required="required">
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="row">
                                                    <div class="col-sm">
                                                        <div class="input-group">
                                                            <input v-model="colorArticle" class="form-control rounded" type="text" placeholder="color del articulo" required="required">
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="row">
                                                    <div class="col-sm">
                                                        <div class="input-group">
                                                            <input v-model="measureArticle" class="form-control rounded" type="text" placeholder="medida del articulo" required="required">
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="row">
                                                    <div class="col-sm">
                                                        <div class="input-group">
                                                            <input v-model="gramajeArticle" class="form-control rounded" type="text" placeholder="gramaje del articulo" required="required">
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="row">
                                                    <div class="col-sm">
                                                        <div class="input-group">
                                                            <input v-model="rellenoArticle" class="form-control rounded" type="text" placeholder="relleno del articulo" required="required">
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="row">
                                                    <div class="col-sm">
                                                        <div class="input-group">
                                                            <input v-model="buildingArticle" class="form-control rounded" type="text" placeholder="construccion del articulo" required="required">
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="row">
                                                    <div class="col-sm">
                                                        <div class="input-group">
                                                            <input v-model="bagMeasureArticle" class="form-control rounded" type="text" placeholder="medidas bolsa del articulo" required="required">
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="row">
                                                    <div class="col-sm">
                                                        <div class="input-group">
                                                            <input v-model="boxMeasureArticle" class="form-control rounded" type="text" placeholder="medidas caja del articulo" required="required">
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="row">
                                                    <div class="col-sm">
                                                        <div class="input-group">
                                                            <input v-model="piecesBoxArticle" class="form-control rounded" type="text" placeholder="piezas x caja del articulo" required="required">
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="row">
                                                    <div class="col-sm">
                                                        <div class="input-group">
                                                            <v-select class="form-control rounded" v-model="brandSelect" label="nameBrand" :options="brand" placeholder="Seleccione la marca">
                                                            </v-select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="row">
                                                    <div class="col-sm">
                                                        <div class="input-group">
                                                            <v-select class="form-control rounded" v-model="clientSelect" :options="clients" label="nameGroupCli" placeholder="Seleccione el cliente">
                                                            </v-select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="row">
                                                    <div class="col-sm">
                                                        <div class="input-group">
                                                            <v-select class="form-control rounded" v-model="rateSelect" :options="rates" label="nameRate" placeholder="Seleccione la tarifa">
                                                            </v-select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="row">
                                                    <div class="col-sm">
                                                        <div class="input-group">
                                                            <v-select class="form-control rounded" v-model="gamaSelect" :options="gama" label="nameGama" placeholder="Seleccione la gama">
                                                            </v-select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="row">
                                                    <div class="col-sm">
                                                        <div class="input-group">
                                                            <v-select class="form-control rounded" v-model="familySelect" :options="families" label="nameFamily" placeholder="Seleccione la familia">
                                                            </v-select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="row">
                                                    <div class="col-sm">
                                                        <div class="input-group">
                                                            <input v-model="pcsArticle" class="form-control rounded" type="text" placeholder="pcs" required="required">
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="row">
                                                    <div class="col-sm">
                                                        <div class="input-group">
                                                            <input v-model="innerArticle" class="form-control rounded" type="text" placeholder="inner" required="required">
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="row">
                                                    <div class="col-sm">
                                                        <div class="input-group">
                                                            <input v-model="pesoArticle" class="form-control rounded" type="text" placeholder="peso" required="required">
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="row">
                                                    <div class="col-sm">
                                                        <div class="input-group">
                                                            <input v-model="umvArticle" class="form-control rounded" type="text" placeholder="umv" required="required">
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="row">
                                                    <div class="col-sm">
                                                        <div class="input-group">
                                                            <select v-model="textilArticle" class="form-select rounded" placeholder="Etiqueta textil" required="required">
                                                                <option disabled selected>Elige la etiqueta</option>
                                                                <option value="si">Si</option>
                                                                <option value="no">No</option>
                                                            </select></div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="row">
                                                    <div class="col-sm">
                                                        <div class="input-group">
                                                            <select v-model="hangtagArticle" class="form-select rounded" placeholder="Etiqueta hangtag" required="required">
                                                                <option disabled selected>Elige la etiqueta</option>
                                                                <option value="si">Si</option>
                                                                <option value="no">No</option>
                                                            </select></div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="row">
                                                    <div class="col-sm">
                                                        <div class="input-group">
                                                            <select v-model="stickerArticle" class="form-select rounded" placeholder="Etiqueta pegatina" required="required">
                                                                <option disabled selected>Elige la etiqueta</option>
                                                                <option value="si">Si</option>
                                                                <option value="no">No</option>
                                                            </select></div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <template v-if="this.dataRepet.length > 0">
                                            <tr v-for="item in this.dataRepet" :key="item.idArticle">
                                                <td class="text-center text-xs">{{ item }}</td>
                                                <td>
                                                    <div class="row">
                                                        <div class="col-sm">
                                                            <div class="input-group">
                                                                <input  v-model="item.idArticle" class="form-control rounded" type="text" placeholder="Id del articulo" required="required">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="row">
                                                        <div class="col-sm">
                                                            <div class="input-group">
                                                                <input  v-model="item.nameArticle" class="form-control rounded" type="text" placeholder="Nombre del articulo" required="required">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>

                                        </template>
                                        <tr>
                                            <div class="row">
                                                <div class="col-sm">
                                                    <div class="input-group">
                                                        <label class="form-label">Nº veces a crear</label>
                                                        <div class="input-group">
                                                            <input class="form-control rounded" type="number" v-model="numberCreated" placeholder="nº veces a crear" required="required">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            {{this.dataRepet}}
                                        </tr>
                                        <!-- Repite esta estructura para cada campo -->
                                        </tbody>
                                    </table>
                                </div>
                                <div class="card-footer">
                                    <button class="btn btn-primary btn-sm" @click="addData">Crear</button>
                                    <Link class="btn btn-warning btn-sm" >Cancelar</Link>
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
import {Link} from '@inertiajs/inertia-vue3'
import Layout from '../../../../Layouts/Layout.vue';
import TopBar from '../../../../Layouts/Navbar/Topbar.vue';
import {toast} from "vue3-toastify";

const notify = ( message, type="warning",autoClose = true) =>
    toast(message, {
        type: type,
        theme: "auto",
        autoClose: autoClose,
    });

export default {
    name: "Index CreateArticle",
    components: {
        Layout,
        TopBar,
        Link,
    },
    props: {
        clients: Array,
        rates: Array,
        families: Array,
        gama: Array,
        brand: Array
    },
    data() {
        return {
            breadcrumbs: {
                title: 'Crear Articulo',
                breadcrumb: {
                    title: 'Compras',
                    url: null
                }
            },
            idArticle: '',
            nameArticle: '',
            colorArticle: '',
            measureArticle: '',
            gramajeArticle: '',
            rellenoArticle: '',
            buildingArticle: '',
            bagMeasureArticle: '',
            boxMeasureArticle: '',
            piecesBoxArticle: '',
            clientSelect:'',
            rateSelect:'',
            familySelect:'',
            gamaSelect:'',
            brandSelect:'',
            pcsArticle: '',
            innerArticle: '',
            pesoArticle: '',
            umvArticle: '',
            textilArticle: '',
            hangtagArticle: '',
            stickerArticle: '',
            numberCreated: '',
            originData: [],
            dataRepet: [],
        }
    },
    methods: {
        addData() {
        this.originData.push({
            idArticle: this.idArticle,
            nameArticle: this.nameArticle,
            colorArticle: this.colorArticle,
            measureArticle: this.measureArticle,
            gramajeArticle: this.gramajeArticle,
            rellenoArticle: this.rellenoArticle,
            buildingArticle: this.buildingArticle,
            bagMeasureArticle: this.bagMeasureArticle,
            boxMeasureArticle: this.boxMeasureArticle,
            piecesBoxArticle: this.piecesBoxArticle,
            clientSelect: this.clientSelect,
            rateSelect: this.rateSelect,
            familySelect: this.familySelect,
            gamaSelect: this.gamaSelect,
            brandSelect: this.brandSelect,
            pcsArticle: this.pcsArticle,
            innerArticle: this.innerArticle,
            pesoArticle: this.pesoArticle,
            umvArticle: this.umvArticle,
            textilArticle: this.textilArticle,
            hangtagArticle: this.hangtagArticle,
            stickerArticle: this.stickerArticle,
        })
            for (let i = 0; i < this.numberCreated; i++) {
                this.dataRepet.push(this.originData)
            }
        }
    }
}
</script>
<style scoped>

</style>

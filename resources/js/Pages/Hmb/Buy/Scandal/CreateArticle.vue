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
                    <div class="car-body">
                        <div class="row">
                            <div class="col-12 ">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-sm">
                                            <label class="form-label">Id del Articulo</label>
                                            <div class="input-group">
                                                <input class="form-control rounded" type="text" placeholder="Id del articulo" required="required">
                                            </div>
                                        </div>
                                        <div class="col-sm">
                                            <label class="form-label">Nombre del Articulo</label>
                                            <div class="input-group">
                                                <input class="form-control rounded" type="text" placeholder="Nombre del articulo" required="required">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <label class="form-label">Color</label>
                                            <div class="input-group">
                                                <input class="form-control rounded" type="text" placeholder="Color" required="required">
                                            </div>
                                        </div>
                                        <div class="col">
                                            <label class="form-label">Medida</label>
                                            <div class="input-group">
                                                <input class="form-control rounded" type="text" placeholder="Medida" required="required">
                                            </div>
                                        </div>
                                        <div class="col">
                                            <label class="form-label">Gramaje</label>
                                            <div class="input-group">
                                                <input class="form-control rounded" type="text" placeholder="Gramaje" required="required">
                                            </div>
                                        </div>
                                        <div class="col">
                                            <label class="form-label">Relleno</label>
                                            <div class="input-group">
                                                <input class="form-control rounded" type="text" placeholder="Relleno" required="required">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <label class="form-label">Construccion</label>
                                            <div class="input-group">
                                                <input class="form-control rounded" type="text" placeholder="Construccion" required="required">
                                            </div>
                                        </div>
                                        <div class="col">
                                            <label class="form-label">Medidas de bolsa</label>
                                            <div class="input-group">
                                                <input class="form-control rounded" type="text" placeholder="medidas de bolsa" required="required">
                                            </div>
                                        </div>
                                        <div class="col">
                                            <label class="form-label">Medidas de caja</label>
                                            <div class="input-group">
                                                <input class="form-control rounded" type="text" placeholder="Medidas de caja" required="required">
                                            </div>
                                        </div>
                                        <div class="col">
                                            <label class="form-label">Piezas x Caja</label>
                                            <div class="input-group">
                                                <input class="form-control rounded" type="text" placeholder="piezas x caja" required="required">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <label class="form-label">Cliente</label>
                                            <div class="input-group">
                                                <select v-model="clientSelect" class="js-example-basic-single" name="state">
                                                    <option disabled value="">Selecciona un cliente</option>
                                                    <option v-for="client in clients" :key="client.idClient" :value="client.idClient">{{ client.nameClient }}</option>
                                                </select>
                                                <p>Cliente seleccionado: {{ clientSelect }}</p>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <label class="form-label">Tarifa</label>
                                            <div class="input-group">
                                                <input class="form-control rounded" type="text" placeholder="Tarifa" required="required">
                                            </div>
                                        </div>
                                        <div class="col">
                                            <label class="form-label">Precio</label>
                                            <div class="input-group">
                                                <input class="form-control rounded" type="text" placeholder="Precio" required="required">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <label class="form-label">Pcs</label>
                                            <div class="input-group">
                                                <input class="form-control rounded" type="text" placeholder="Pcs" required="required">
                                            </div>
                                        </div>
                                        <div class="col">
                                            <label class="form-label">Inner</label>
                                            <div class="input-group">
                                                <input class="form-control rounded" type="text" placeholder="Inner" required="required">
                                            </div>
                                        </div>
                                        <div class="col">
                                            <label class="form-label">Peso</label>
                                            <div class="input-group">
                                                <input class="form-control rounded" type="text" placeholder="Peso" required="required">
                                            </div>
                                        </div>
                                        <div class="col">
                                            <label class="form-label">Marca</label>
                                            <div class="input-group">
                                                <input class="form-control rounded" type="text" placeholder="Marca" required="required">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <label class="form-label">Gama</label>
                                            <div class="input-group">
                                                <input class="form-control rounded" type="text" placeholder="Gama" required="required">
                                            </div>
                                        </div>
                                        <div class="col">
                                            <label class="form-label">Familia</label>
                                            <div class="input-group">
                                                <input class="form-control rounded" type="text" placeholder="Familia" required="required">
                                            </div>
                                        </div>
                                        <div class="col">
                                            <label class="form-label">Umv</label>
                                            <div class="input-group">
                                                <input class="form-control rounded" type="text" placeholder="Umv" required="required">
                                            </div>
                                        </div>
                                        <div class="col">
                                            <label class="form-label">Prevision mes a mes </label>
                                            <div class="input-group">
                                                <input class="form-control rounded" type="text" placeholder="Prevision mes a mes" required="required">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <label class="form-label">Etiqueta textil</label>
                                            <div class="input-group">
                                                <select class="form-select rounded" placeholder="Etiqueta textil" required="required">
                                                    <option selected>Elige la etiqueta</option>
                                                    <option value="1">Si</option>
                                                    <option value="2">No</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <label class="form-label">Etiqueta Hangtag</label>
                                            <div class="input-group">
                                                <select class="form-select rounded" placeholder="Etiqueta textil" required="required">
                                                    <option selected>Elige la etiqueta</option>
                                                    <option value="1">Si</option>
                                                    <option value="2">No</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <label class="form-label">Pegatinas</label>
                                            <div class="input-group">
                                                <select class="form-select rounded" placeholder="Pegatinas" required="required">
                                                    <option selected>Elige la etiqueta</option>
                                                    <option value="1">Si</option>
                                                    <option value="2">No</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button class="btn btn-primary btn-sm">Guardar</button>
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
        clients: Array
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
            clientSelect:''
        }
    },
    mounted() {
        console.log(this.clients)
    },
    methods: {
    }
}
</script>
<style scoped>

</style>

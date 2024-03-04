<template>
    <Layout>
        <Top-bar :breadcrumbs="breadcrumbs" />
        <div class="container-fluid mt--6">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header pb-0">
                            {{ apiDelSol }}
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="inputGroup-sizing-default">Buscador</span>
                                <input autofocus type="text" class="form-control rounded" placeholder="Busca por nombre o id del cliente o número de pedido">
                            </div>
                        </div>
                        <hr>
                        <!-- card body -->
                        <div class="car-body pt-0">
                            <div class="table-responsive">

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
    name: "Index ApiDelSol",
    components: {
        Layout,
        TopBar,
        Link,
    },
    props: {
        apiDelSol: Array
    },
    data() {
        return {
            breadcrumbs: {
                title: 'Api',
                breadcrumb: {
                    title: 'Api',
                    url: null
                }
            },
        }
    },
    methods: {
    },
}
</script>

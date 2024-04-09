<template>
<Layout>
    <TopBar :breadcrumbs="breadcrumbs" />
    jejej siuuu
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
    name: "Index Scandal",
    components: {
        Layout,
        TopBar,
        Link
    },
    props: {
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
        }
    },
    methods: {
    }
}
</script>
<style scoped>

</style>

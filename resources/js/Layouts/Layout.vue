<template>
    <div class="min-height-300 position-absolute w-100" :class=" 'bg-primary'"></div>
    <Sidebar />
    <main class="main-content position-relative border-radius-lg" id="panel">
        <slot />
    </main>
    <TemplateManager />
</template>

<script>
import Sidebar from './Navbar/Sidebar.vue';
import { loadScript } from "vue-plugin-load-script";
import TemplateManager from "../Shared/TemplateManager.vue";



loadScript("/argon/js/argon-dashboard.min.js?v=2.0.2");

export default {
    name: "Layout",
    components: {
        Sidebar,
        TemplateManager,
    }
}
</script>

<style scoped>

</style>

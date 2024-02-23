<template>
    <aside
        class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4 "
        id="showSidebar">
        <div class="sidenav-header">
            <a class="navbar-brand m-0" :href="route('index')">
                <img src="/argon/img/favicon.png" class="navbar-brand-img h-100"
                     style="display: block; margin-left: 20px;" alt="main_logo">
            </a>
        </div>
        <hr class="horizontal dark mt-0">
        <div class="navbar-collapse w-auto h-auto" id="sidenav-collapse-main">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <Link :href="route('index')"
                          class="nav-link" :class="{'active' : $page.component === 'Hmb/Dashboard' }">
                        <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fa fa-home text-secondary text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Panel</span>
                    </Link>
                </li>
                <li class="nav-item" v-if="this.$permissions(this.$page.props.auth.user, ['admin-ver usuarios'])">
                    <a  href="#navbar-admin" class="nav-link" aria-controls="navbar-admin" role="button">
                        <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fa-solid fa-home text-secondary text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Administrador</span>
                    </a>
                </li>
            </ul>
        </div>
        <!-- Divider -->
        <hr class="horizontal dark mt-3">
        <div class="sidenav-footer">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <Link class="nav-link" :href="route('logout')" method="post" as="button">
                        <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fa-solid fa-right-from-bracket text-danger text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Cerrar Sesión</span>
                    </Link>
                </li>
            </ul>
        </div>
    </aside>
</template>
<script>
import {Link} from "@inertiajs/inertia-vue3";
const logout = () => {
    router.post(route('logout'));
};
export default {
    name: "Sidebar",
    components: {
        Link,
    },
    mounted() {
        console.log(this.$page.props);
    }
}
</script>

<style scoped>
</style>

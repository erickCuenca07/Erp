<template>
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl " id="navbarBlur" data-scroll="false">
      <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm">
              <a class="text-white" :href="route('index')">
              <i class="fa-solid fa-house"></i>
              </a>
            </li>
            <li v-if="breadcrumbs.breadcrumb != null" class="breadcrumb-item text-sm text-white">
              <Link class="opacity-5 text-white" :href="breadcrumbs.breadcrumb.url" v-if="breadcrumbs.breadcrumb.url != null">{{ breadcrumbs.breadcrumb.title }}</Link>
              <Link class="opacity-5 text-white" href="javascript:;" v-else>{{ breadcrumbs.breadcrumb.title }}</Link>
            </li>
            <li class="breadcrumb-item text-sm text-white active" v-else>
            </li>
          </ol>
          <h6 class="font-weight-bolder mb-0 text-white">{{ breadcrumbs.title }}</h6>
        </nav>
        <div class="navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
          <div class="ms-md-auto pe-md-3 d-flex align-items-center">

          </div>
          <ul class="navbar-nav  justify-content-end">
            <li class="nav-item dropdown pe-2 d-flex align-items-center">
              <a href="javascript:;" class="nav-link text-white px-0" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fa fa-user-circle cursor-pointer"></i>
              </a>
              <ul class="dropdown-menu  dropdown-menu-end" aria-labelledby="dropdownMenuButton">
                <li class="nav-item">
                  <div class="dropdown-header">
                        <h6 class="text-overflow m-0">Bienvenido, {{ $page.props.auth.user.name }}</h6>
                    </div>
                </li>
                <li class="mb-2">
                  <a class="dropdown-item border-radius-md" :href="route('profile')">
                    <div class="d-flex py-1">
                      <div class="my-auto">
                        <i class="ni ni-single-02"></i>
                      </div>
                      <div class="d-flex flex-column justify-content-center">
                        <h6 class="text-sm font-weight-normal mb-1">
                          <span class="font-weight-bold">Mi perfil</span>
                        </h6>
                      </div>
                    </div>
                  </a>
                </li>
                <li class="nav-item w-100">
                      <Link :href="route('logout')" method="post" class="dropdown-item" as="button">
                        <i class="ni ni-user-run"></i>
                        <span>Cerrar Sesión</span>
                      </Link>
                    </li>
              </ul>
            </li>
            <!--<li class="nav-item px-3 d-flex align-items-center">
              <a href="javascript:;" class="nav-link text-white p-0">
                <i class="fa fa-cog fixed-plugin-button-nav cursor-pointer"></i>
              </a>
            </li>-->
          </ul>
        </div>
      </div>
    </nav>
</template>

<script>
import { Link } from "@inertiajs/inertia-vue3";
import Dropdown from "@/Components/Dropdown.vue";
import DropdownLink from "@/Components/DropdownLink.vue";
import ResponsiveNavLink from "@/Components/ResponsiveNavLink.vue";

export default {
    name: "Topbar",
    components: {
        ResponsiveNavLink,
        DropdownLink, Dropdown,
        //FlashMessages,
        Link,
    },
    props: {
        breadcrumbs: Object
    },

    data(){
        return {
            flash:null
        }

    }
}
</script>
<style>
/* Estilos para tamaños de pantalla móvil */
@media (max-width: 767px) {
    .sidenav-toggler {
        display: block !important;
    }
}
.navbar .fa-user-circle {
    font-size: 24px;
}
.navbar .fa-cog {
  font-size: 24px;
}
</style>

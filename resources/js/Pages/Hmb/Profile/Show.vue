<template>
    <layout>
        <Top-bar :breadcrumbs="breadcrumbs" />
        <div class="container-fluid mt--6">
          <div class="row">
            <div class="col">
              <div class="card">
                <div class="card-body table-responsive mt-4">
                  <div v-if="$page.props.jetstream.canUpdateProfileInformation">
                    <UpdateProfileInformationForm :user="$page.props.auth.user" />
                  </div>
                  <hr class="horizontal my-5">
                  <div v-if="$page.props.jetstream.canUpdatePassword">
                    <UpdatePasswordForm />
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>    
    </layout>
</template>

<script>

import Layout from '../../../Layouts/Layout.vue';
import TopBar from "../../../Layouts/Navbar/Topbar.vue";
import Footer from '../../../Layouts/Partials/Footer.vue'

import UpdatePasswordForm from '../Profile/Partials/UpdatePasswordForm.vue';
import UpdateProfileInformationForm from '../Profile/Partials/UpdateProfileInformationForm.vue';

export default {
    name: "Show",
    components: {
        TopBar,
        Layout,
        Footer,
        UpdatePasswordForm,
        UpdateProfileInformationForm
    },
    data() {
        return {
            breadcrumbs:
                {
                    title: 'Inicio',
                    breadcrumb: null
                },
        }
    },
    methods: {
    }
}
</script>
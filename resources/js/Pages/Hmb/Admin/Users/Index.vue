<template>
    <Layout>
        <Top-bar :breadcrumbs="breadcrumbs" />
        hola
    </Layout>
    </template>
    
    <script>
    import { Link } from '@inertiajs/inertia-vue3'
    import Layout from '../../../../Layouts/Layout.vue';
    import TopBar from '../../../../Layouts/Navbar/Topbar.vue';
    
    export default {
      name: "UserIndex",
      components: {
        Layout,
        TopBar,
        Link,
      },
      props: {
        
      },
      data() {
        return {
          breadcrumbs: {
            title: 'Usuarios',
            breadcrumb: {
              title: 'Admin',
              url: null
            }
          },
          ellipsis: {
            'width': '200px',
            'overflow': 'hidden',
            'text-overflow': 'ellipsis',
          }
        }
      },
    }
    </script>
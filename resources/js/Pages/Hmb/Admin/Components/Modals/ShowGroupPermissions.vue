<template>
    <div class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" id="modal-show-permissions"  aria-labelledby="exampleModalLabel" >
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Grupo de Permisos asociados a: {{roleName}} </h5>
                    <button  type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span class="text-dark" data-bs-dismiss="modal" aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body p-0">
                    <div class="card-body">
                        <div class="form-group text-center">
                            <h6 class="modal-subtitle"></h6>
                            <textarea class="form-control" rows="3" readonly > {{ modalPermissions }}</textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn bg-gradient-secondary"  data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "ShowGroupPermissions",
    props:{
        roleName: String,
        modalPermissions: Array,
    },
    computed: {
    },
    data() {
    }
}
</script>

<style scoped>

</style>

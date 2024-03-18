<template>
    <div class="modal" style="top:150px" tabindex="-1" role="dialog" id="modal-create-permission">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="form-group">
                        <label class="form-control-label" >Crear Permiso</label>
                        <input autofocus required v-model.trim="permission" type="text" class="form-control rounded" placeholder="Nombre del Permiso">
                    </div>
                </div>
                <div class="modal-footer">
                    <button  class="btn btn-secondary my-0" data-bs-dismiss="modal">Volver</button>
                    <button  class="btn btn-primary my-0" @click="createPermission">Crear</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import {toast} from "vue3-toastify";

const notify = ( message, type="warning") =>
    toast(message, {
        type: type,
        theme: "auto",
    });
export default {
    name: "ModalCreatePermission",
    data: function() {
        return {
            permission: "",
        };
    },
    methods: {
        createPermission: function () {
            if (this.permission.trim() === "") {
                notify('El campo no puede estar vacio');
                return;
            }
            axios.post(route('admin.permissions.create'), {name: this.permission})
                .then((response) => {
                    notify(response.data[1], response.data[0]);
                    this.permission = "";
                })
                .catch((error) => {
                    notify(error.response.data.message, 'error');
                });
        },
    },
}
</script>

<style scoped>

</style>

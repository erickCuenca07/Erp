<template>
    <div class="modal" tabindex="-1" role="dialog" id="modal-options-update-massive">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                   <div class="row">
                       <div class="col">
                           <div class="form-group">
                               <label for="name">Partida Arancelaria</label>
                               <v-select v-model="this.selectPartida" :options="tariffArancelaria.AllPartida" label="name" placeholder="Seleecciona la partida arancelaria"></v-select>
                                <p v-if="this.selectPartida">Has selectionado {{ this.selectPartida.name }} y su porcentaje es {{ this.partidaArancelaria.percentage }}</p>
                           </div>
                       </div>
                   </div>
                </div>
                <div class="modal-footer">
                    <button  class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button @click="save" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
</template>
<script >
export default {
    name: "ModalOptionsUpdateMassive",
    props: {
        tariffArancelaria:{type: Object, required: true},
    },
    data() {
        return {
            partidaArancelaria:'',
            selectPartida:'',
        }
    },
    watch:{
      selectPartida(newVal, oldVal){
          if (newVal !== oldVal) {
              console.log(newVal)
              this.partidaArancelaria = this.tariffArancelaria.PercentagePartida.find(item => item.partidaId === newVal.id)
              console.log(this.partidaArancelaria)
          }
      }
    },
    methods: {
        save(){
            console.log(this.partidaArancelaria);
        }
    }
}
</script>
<style scoped>

</style>

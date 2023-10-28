<template>
  <modalTemplate>
    <div class="w-full h-full flex justify-center items-center">
      <form @submit.prevent="storeDelete" class="flex justify-between flex-col gap-5 bg-white rounded-md p-10">
        <div class="text-center text-lg">
          Kamu yakin mau menghapus <span class="font-semibold">{{ dataFile.fileName }}</span>
        </div>
        <button class="bg-red-400 w-full flex items-center justify-center gap-3 p-1">
          <img src="src/assets/img/trashW.svg" class="w-4">
          <span class=" font-semibold text-white rounded-md">Hapus</span>
        </button>
      </form>
    </div>
  </modalTemplate>
</template>
<script>
import modalTemplate from './modalTemplate.vue';
import {deleteFile} from "../../../methods/files/methodFile"

export default {
  components:{
    modalTemplate
  },
  props: ["dataFile"],
  emits: ["response"],
  methods: {
    storeDelete(){
      deleteFile(this.dataFile.id)
      .then(Response=>{
        return this.$emit("response")
      }).catch(Response=>{
        return this.$emit("response")
      })
    }
  }
}
</script>
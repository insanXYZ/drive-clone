<template>
  <modalTemplate>
    <div class="w-full h-full flex justify-center items-center z-20">
      <form @submit.prevent="store" action="" class="p-10 w-1/3 h-1/4 min-w-[200px] min-h-[150px] flex flex-col justify-between bg-white rounded-md relative">
        <input v-model="input" type="text" class="border p-1 focus:outline-none" :placeholder="dataFile.fileName" required min="1">
        <button class="w-full bg-green-400 text-white p-1">Perbarui</button>
      </form>
    </div>
  </modalTemplate>
</template>
<script>
import modalTemplate from "./modalTemplate.vue"
import {updateName} from "../../../methods/files/methodFile";

export default {
  data(){
    return{
      input: ""
    }
  },
  components: {
    modalTemplate,
  },
  props: ["dataFile"],
  emits: ["response"],
  methods: {
    store()
    {
      updateName(this.input, this.dataFile.fileName , this.dataFile.id)
      .then((Response)=>{
        return this.$emit("response")
      }).catch(Response=>{
        console.log(Response);
      })
    }
  }
}
</script>
<style>
  
</style>
<template>
  <modalTemplate>
     <!-- topbar -->
     <div class="flex items-center justify-between w-full">
        <div class="flex items-center gap-5">
          <img @click="closeModal()" src="src/assets/img/back.png" class="w-6 cursor-pointer">
          <span class="text-lg font-semibold text-white">{{ dataFile.fileName }}</span>
        </div>
        <div class="flex items-center gap-10">
          <div class="relative flex gap-6 justify-center items-center">
            <a v-if="dataFile.type == 'doc'" :href="dataFile.url" target="_blank">
              <img src="src/assets/img/eye.png" class="w-6 cursor-pointer" alt="">
            </a>
            <img @click="show = !show" src="src/assets/img/dotW.png" class="w-6 cursor-pointer">
            <Transition name="slide-fade">
                      <div v-if="show" class="absolute -left-64 -bottom-40 bg-white shadow-2xl px-1 py-4 flex gap-3 flex-col w-[250px] rounded-md">
                        <options @click="download(dataFile.fileName)" img="download.png">Download</options>
                        <options @click="changeName(dataFile.fileName , dataFile.id)" img="edit.png">Ganti nama</options>
                        <options @click="deleteFile(dataFile.fileName, dataFile.id)" img="trash.png">Hapus</options>
                      </div>
                    </Transition>
          </div>
        </div>
      </div>
      <!-- value -->
      <img v-if="dataFile.type == 'image'" :src="dataFile.url" class="h-full p-10 w-auto object-contain" >
      <div v-else class=" w-full h-full flex justify-center items-center p-10">
        <img src="src/assets/img/folder.png" class=" w-32 " >
      </div>
  </modalTemplate>
</template>
     

<script>
import options from "../../../components/app/home/options.vue";
import modalTemplate from "./modalTemplate.vue"

export default {
  data(){
    return {
      show: false
    }
  },
  components: {
    options,
    modalTemplate
  },
  props: ["dataFile"],
  emits: ['closeModal','changeName',"deleteFile",'download'],
  methods: {
    closeModal(){
      this.$emit("closeModal")
    },
    changeName(fileName , id){
      this.$emit("changeName",{fileName,id})
    },
    deleteFile(fileName , id){
      this.$emit("deleteFile",{fileName : fileName,id : id})
    },
    download(fileName) {
      this.$emit("download", {fileName})
    }
  }

}
</script>
<style>
.slide-fade-enter-active {
  transition: all 0.1s ease-out;
}

.slide-fade-leave-active {
  transition: all 0.1s cubic-bezier(1, 0.5, 0.8, 1);
}

.slide-fade-enter-from,
.slide-fade-leave-to {
  transform: translateX(20px);
  opacity: 0;
}</style>

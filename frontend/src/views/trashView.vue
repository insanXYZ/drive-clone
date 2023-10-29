<template >
  <bar>
      <div v-if="files.length == 0" class="w-full h-full flex flex-col gap-7 justify-center items-center overflow-y-auto">
      <img src="src/assets/img/garbage.png" class="w-40 opacity-70">
      <span class="text-2xl font-light">Sampah Kosong</span>
      </div>
      <div v-else class="w-full h-full flex flex-col">
        <table class="min-w-full divide-y divide-gray-200">
            <thead>
              <tr>
                <th
                  class="px-6 py-3 text-left text-xs leading-4  text-gray-600 uppercase tracking-wider"
                >
                  Nama
                </th>
                <th
                  class="px-6 py-3 text-left text-xs leading-4  text-gray-600 uppercase tracking-wider"
                >
                  Terakhir diubah
                </th>
                <th
                  class="px-6 py-3 text-left text-xs leading-4  text-gray-600 uppercase tracking-wider"
                >
                  Ukuran File
                </th>
                <th class="px-6 py-3">
                  <img src="src/assets/img/edit.png" class="w-4">
                </th>
              </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
              <tr v-for="(item , i) in files" :key="item.id" class="hover:bg-zinc-100">
                <td class="px-6 py-4 gap-4 whitespace-no-wrap flex items-center cursor-pointer">
                  <img v-if="item.type == 'doc'" src="src/assets/img/doc.png" class="w-4">
                  <img v-if="item.type == 'image'" src="src/assets/img/image.png" class="w-4">
                  {{ item.fileName }}
                </td>
                <td class="px-6 py-4 whitespace-no-wrap">
                  {{ item.updated_at }}
                </td>
                <td class="px-6 py-4 whitespace-no-wrap">
                  {{ convertByte(item.size) }}
                </td>
                <td class="px-6 py-4 whitespace-no-wrap relative">
                  <img @click="toggleOption(i)" src="src/assets/img/dot.png" class="w-4 cursor-pointer p-[5px] rounded-full hover:bg-zinc-200 box-content">
                  <Transition name="slide-fade">
                    <div v-if="option === i" class="absolute -left-60 -bottom-24 bg-white shadow-2xl px-1 py-4 flex gap-3 z-50 flex-col w-[250px] ">
                      <options @click="Restore(item.id)" img="recent.png">Pulihkan</options>
                      <options @click="Delete(item.id)" img="trashB.png">Hapus Selamanya</options>
                    </div>
                  </Transition>
                </td>
              </tr>
            </tbody>
          </table>
      </div>
</bar>
</template>
<script>
import { getTrash , restore , forceDelete} from "../methods/files/methodFile";
import bar from "./templates/bar.vue";
import convertByte from "../methods/files/convertByte";
import options from "../components/app/home/options.vue";

export default {
  data(){
    return{
      option : "",
      files: [],
    }
  },
  created() {
    this.getDrive()
  },
  components: {
    bar,
    options
  },
  methods: {
    convertByte,
    Restore(id){
      restore(id).then(response=>{
        this.getDrive()
        this.option = ""
      }).catch(error=>{
        console.log(error.response.data);
      })
    },
    getDrive(){
      getTrash()
      .then(Response => {
        this.files = Response.data.data
      }).catch(error => {
        console.log(error.response);
      })
    },
    toggleOption(index) {
      this.option = this.option === index ? null : index;
    },
    Delete(id){
      forceDelete(id).then(response=>{
        this.getDrive()
      }).catch(error=>{
        console.log(error.response.data);
      })
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

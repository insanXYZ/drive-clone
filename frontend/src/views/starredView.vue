<template>
  <bar @input="item => searchFile(item) ">
    <div v-if="files.length == 0" class="w-full h-full flex flex-col gap-7 justify-center items-center overflow-y-auto">
      <img src="src/assets/img/starSlash.png" class="w-40 opacity-70">
      <span class="text-2xl font-light">Tidak ada file berbintang</span>
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
                    <div v-if="option === i" class="absolute -left-60 -top-8 bg-white shadow-2xl px-1 py-4 flex gap-3 z-50 flex-col w-[250px] ">
                      <options @click="starred(item.id)" v-if="item.stared == 0" img="star.png">Beri bintang</options>
                      <options @click="starred(item.id)" v-else img="starred.png">Hapus bintang</options>
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
import bar from './templates/bar.vue';
import options from '../components/app/home/options.vue';
import convertByte from '../methods/files/convertByte';
import {getStarred , starred , searchFile} from "../methods/files/methodFile"

export default {
  data(){
    return{
      files : [],
      option: ""
    }
  },
  components: {
    bar,
    options
  },
  created(){
    this.getDrive()
  },
  methods: {
    searchFile(fileName){
      searchFile(fileName , "starred").then(response=>{
        if(response.data.data.length > 0){
          this.files = response.data.data
        }
      }).catch(error=>{
        console.log(error.response.data);
      })
    },
    starred(id){
      starred(id).then(response=>{
        this.files.map(item => {
          if(item.id == id){
            item.stared = ! item.stared
          }
        })
      }).catch(error => {
        console.log(error.response);
      })
    },  
    convertByte,
    getDrive(){
      getStarred().then(response=>{
        this.files = response.data.data
      }).catch(error => {
        console.log(error.response.data);
      })
    },
    toggleOption(index) {
      this.option = this.option === index ? null : index;
    },

  }
}
</script>
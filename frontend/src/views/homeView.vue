<template>
  <modalFile @starred="item => starred(item)" @download="item => Download(item.fileName)" @deleteFile="(item) => showDelete(item.fileName , item.id) " @changeName="item=>showDetail(item.fileName , item.id)" @closeModal="closeModal()" v-if="modal" :dataFile="dataFile">
  </modalFile>
  <modalDetail @response="closeDetail" v-if="detailShow" :dataFile="detailsFile">
  </modalDetail>
  <modalDelete @response="closeDelete" v-if="deleteShow" :dataFile="deleteFile">
  </modalDelete>
  <bar @input="item => console.log(item)" @response="getDrive()">
    <div class="w-full flex flex-col gap-5 overflow-y-auto">
      <div class="grid lg:grid-cols-4 md:grid-cols-3 gap-3">
        <div
          v-for="item in files.slice(0, windowWidth)" 
          @click="showModal(item.fileName , item.url , item.type, item.id , item.stared)"
          class="w-full overflow-hidden rounded-md flex flex-col gap-3 bg-zinc-100 px-2 py-4 cursor-pointer hover:bg-zinc-200 transition-all"
        >
          <div class="flex gap-5 items-center px-2">
            <img
              v-if="item.type == 'image'"
              src="src/assets/img/image.png"
              class="w-5"
            />
            <img v-else src="src/assets/img/doc.png" class="w-5" />
            <div class="truncate text-sm">{{ item.fileName }}</div>
          </div>
          <img
            v-if="item.type == 'image'"
            :src="item.url"
            class="w-full h-[115px] object-cover rounded-md"
          />
          <div
            v-else
            class="w-full h-[115px] flex justify-center items-center bg-white rounded-md"
          >
            <img src="src/assets/img/folder.png" class="w-14" />
          </div>
        </div>
      </div>
      <div v-if="files.length > 4" class="w-full">
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
                  Ukuran file
                </th>
                <th class="px-6 py-3">
                  <img src="src/assets/img/edit.png" class="w-4">
                </th>
              </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
              <tr v-for="(item , i) in files.slice(4, files.length)" :key="item.id" class="hover:bg-zinc-100">
                <td class="px-6 py-4 gap-4 whitespace-no-wrap flex items-center cursor-pointer" @click="showModal(item.fileName , item.url , item.type, item.id)">
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
                    <div v-if="option === i" class="absolute -left-60 -top-36 bg-white shadow-2xl px-1 py-4 flex gap-3 flex-col w-[250px] ">
                      <options @click="starred(item.id)" v-if="item.stared == 0" img="star.png">Beri bintang</options>
                      <options @click="starred(item.id)" v-else img="starred.png">Hapus bintang</options>
                      <options @click="Download(item.fileName)" img="download.png">Download</options>
                      <options @click="showDetail(item.fileName , item.id)" img="edit.png">Ganti nama</options>
                      <options @click="showDelete(item.fileName ,item.id)" img="trash.png">Hapus</options>
                    </div>
                  </Transition>
                </td>
              </tr>
            </tbody>
          </table>
      </div>
    </div>
  </bar>
</template>
<script>
import bar from "./templates/bar.vue";
import {get,download , starred} from "../methods/files/methodFile"
import convertByte from "../methods/files/convertByte";
import options from "../components/app/home/options.vue";
import modalFile from "../components/app/home/modalFile.vue"
import modalDetail from "../components/app/home/modalDetail.vue"
import modalDelete from "../components/app/home/modalDelete.vue";


export default {
  data() {
    return {
      deleteFile: "",
      deleteShow: false ,
      detailShow: false,
      modal: false,
      dataFile: {},
      option: null,
      files: [],
      detailsFile: {},
      windowWidth: window.innerWidth > 1024 ? 4 : 3,
    };
  },
  mounted() {
    this.$nextTick(() => {
      window.addEventListener("resize", this.onResize);
    });
  },
  methods: {
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
    Download(fileName){
      download(fileName)
      .then(response => {
        const url = window.URL.createObjectURL(new Blob([response.data]));
        const link = document.createElement("a");
        link.href = url;
        link.setAttribute("download", fileName);
        document.body.appendChild(link);
        link.click();
        link.remove();

        this.toggleOption(null)
      })
      .catch(error => {
        console.log(error.response);
      })
    },
    getDrive(){
      get()
    .then((response) => {
        this.files = response.data.data;
      })
      .catch((response) => {
        console.log(response);
      });
    },
    toggleOption(index) {
      this.option = this.option === index ? null : index;
    },
    onResize() {
      this.windowWidth = window.innerWidth > 1024 ? 4 : 3;
    },
    showModal(fileName ,url = null , type , id , stared){
      this.dataFile= {
        fileName,
        url,
        type,
        id,
        stared
      }
      this.modal = true
    },
    closeModal(){
      this.dataFile = {}
      this.modal = false
    },
    showDetail(fileName , id){
      this.detailsFile = {
        id,
        fileName
      }
      this.detailShow = true
    },
    closeDetail(){
      this.detailsFile = {},
      this.detailShow = false
      this.modal = false
      this.dataFile = {}
      this.getDrive()
      this.toggleOption(null)
    },
    showDelete(fileName, id){
      this.deleteFile = {
        fileName : fileName,
        id : id
      }

      this.deleteShow = true
    },
    closeDelete(){
      this.deleteFile = {}
      this.deleteShow = false
      this.modal = false
      this.dataFile = {}
      this.getDrive()
      this.toggleOption(null)
    },
    convertByte,
  },
  components: {
    bar,
    options,
    modalFile,
    modalDetail,
    modalDelete
  },
  created() {
    this.getDrive()
  },
};
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

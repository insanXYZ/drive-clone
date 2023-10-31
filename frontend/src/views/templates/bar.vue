<template>
  <!-- flex -->
  <modalProgress v-if="showProgress" :value="value"></modalProgress>
  <div class="w-screen h-screen flex bg-zinc-100 z-10">
    <!-- leftbar -->
    <div class="flex w-[270px] flex-col gap-6 h-full px-5 py-3">
      <router-link to="/" class="flex gap-2 items-center">
        <img class="w-10" src="/src/assets/img/drive.png" />
        <span class="text-2xl font-light">Drive</span>
      </router-link>
      <!-- input -->
      <inputFile @uploadInput="(item) => upload(item)"></inputFile>
      <div class="flex flex-col gap-4 w-full">
        <menuLabel to="/" image="/src/assets/img/storage.png"
          >Drive saya</menuLabel
        >
        <menuLabel to="starred" image="/src/assets/img/star.png">Berbintang</menuLabel>
        <menuLabel to="trash" image="/src/assets/img/trash.png">Sampah</menuLabel>
      </div>
    </div>
    <!-- rightbar -->
    <div class="w-full h-full overflow-hidden relative" >
      <!-- topbar -->
      <div class="w-full px-1 pr-5 flex justify-between h-[50px]">
        <form action="" @submit.prevent="formInput" class="flex items-center">
          <img
            src="src/assets/img/search.png"
            class="w-8 bg-white p-2 border-white rounded-l-full"
          />
          <input v-model="input"
            type="text"
            class="p-1 w-[350px] rounded-r-full focus:border-none focus:outline-none"
          />
          <input type="submit" class="hidden" />
        </form>
        <div class="flex gap-5 items-center">
          <img src="src/assets/img/setting.png" class="w-5" />
          <div class="relative">
            <img @click="openAccount()" src="src/assets/img/user.png" class="w-5 cursor-pointer" />
            <Transition name="slide-fade">
              <div v-if="showAccount" class="absolute z-20 p-4 bg-white shadow-2xl flex flex-col gap-3 w-[250px] -bottom-28 -left-64">
                <options img="user.png">{{ name }}</options>
                <options @click="exit()" img="exit.png">Keluar</options>
              </div>
            </Transition>
          </div>
        </div>
      </div>
      <!-- mainBar -->
      <div
        class="bg-white w-[calc(100%-10px)] h-[calc(100%-55px)] relative  box-border m-auto rounded-lg p-5  overflow-y-auto "
      >
        <slot></slot>
      </div>
    </div>
  </div>
</template>
<script>
import menuLabel from "../../components/app/menuLabel.vue";
import {input} from "../../methods/files/methodFile";
import {exit} from "../../methods/auth/methodAuth";
import inputFile from "../../components/app/inputFile.vue";
import modalProgress from "../../components/app/modalProgress.vue";
import options from "../../components/app/home/options.vue";
import Cookies from "js-cookie"


export default {
  data(){
    return{
      showProgress: false,
      value: 0,
      input : "",
      showAccount : false,
      name : Cookies.get("username")
    }
  },
  components: {
    menuLabel,
    inputFile,
    modalProgress,
    options
  },
  emits: ["response", "input"],
  methods: {
    upload(item) {
      let formdata = new FormData();

      for (let i = 0; i < item.length; i++) {
        formdata.append("file[]", item[i]);
      }

      this.showProgress = true;

      input(formdata, (progressEvent) => {
        const { loaded, total } = progressEvent;
        let percent = Math.floor((loaded * 100) / total);
        if (percent <= 100) {
          this.value = percent
        }
      })
        .then((response) => {
          if(response.data.success == true){
            this.showProgress = false
          }
          this.$emit("response")
        })
        .catch((error) => {
          thi.$emit("response")
        });
    },
    formInput(){
      this.$emit("input",this.input)
    },
    openAccount(){
      this.showAccount = ! this.showAccount
    },
    exit(){
      exit().then(response=>{
        Cookies.remove("token")
        Cookies.remove("username")
        this.$router.push("/login")
      }).catch(error=>{
        console.log(error.response);
      })
    }
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

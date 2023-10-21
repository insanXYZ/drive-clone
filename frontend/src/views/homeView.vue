<template>
  <bar>
    <div class="w-full flex flex-col">
      <div class="grid lg:grid-cols-4 md:grid-cols-3 gap-3">
        <!-- <div v-for="item in files">
          {{ item.fileName }}
        </div> -->
      </div>
    </div>
  </bar>
</template>
<script>
import bar from "./templates/bar.vue";
import get from "../methods/files/get";

export default {
  data() {
    return {
      files : '',
    };
  },
  components: {
    bar,
  },
  created() {
    get().then((response) => {
      console.log(response.data[0]);
      this.files = response.data.file;
    }).catch((response)=>{
      console.log(response);
    })
  },
};
</script>

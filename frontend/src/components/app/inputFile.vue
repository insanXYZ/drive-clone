<template>
  <form @submit.prevent="upload" >
    <label for="inputfile"
      class="flex justify-center items-center py-3 shadow-lg gap-2 w-[100px] rounded-lg cursor-pointer bg-white"
    >
      <img src="src/assets/img/plus.png" class="w-5" />
      <span>Baru</span>
    </label>
    <input @change="autoSubmit" ref="file" type="file" id="inputfile" multiple class="hidden">
    <button type="submit" ref="buttonClick" class="hidden"></button>
  </form>
</template>
<script>
export default {
  emits: ["uploadInput"],
  methods: {
    autoSubmit() {
      this.$refs.buttonClick.click();
    },
    upload() {
      this.$emit("uploadInput", this.$refs.file.files);
    },
  },
};
</script>

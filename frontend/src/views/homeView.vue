<template>
  <bar>
    <div class="w-full flex flex-col gap-5">
      <div class="grid lg:grid-cols-4 md:grid-cols-3 gap-3">
        <div
          v-for="item in files.slice(0, windowWidth)"
          class="w-full overflow-hidden rounded-md flex flex-col gap-3 bg-zinc-100 px-2 py-4 cursor-pointer"
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
            v-if="item.url"
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
        <div class="">
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
              <tr v-for="(item , i) in files.slice(4, files.length)" :key="item.id">
                <td class="px-6 py-4 gap-4 whitespace-no-wrap flex items-center">
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
                  <img @click="toggleOption(i)" src="src/assets/img/dot.png" class="w-4 cursor-pointer">
    <div v-if="option === i" class="absolute -left-60 -top-28 bg-white shadow-2xl px-1 py-4 flex gap-3 flex-col w-[250px] ">
      <options img="download.png">Download</options>
      <options img="edit.png">Ganti nama</options>
      <options img="trash.png">Hapus</options>
    </div>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </bar>
</template>
<script>
import bar from "./templates/bar.vue";
import get from "../methods/files/get";
import convertByte from "../methods/files/convertByte";
import options from "../components/app/options.vue";

export default {
  data() {
    return {
      option: null,
      files: [],
      windowWidth: window.innerWidth > 1024 ? 4 : 3,
    };
  },
  mounted() {
    this.$nextTick(() => {
      window.addEventListener("resize", this.onResize);
    });
  },
  methods: {
    toggleOption(index) {
      this.option = this.option === index ? null : index;
    },
    onResize() {
      this.windowWidth = window.innerWidth > 1024 ? 4 : 3;
    },
    convertByte,
  },
  components: {
    bar,
    options
  },
  created() {
    get()
      .then((response) => {
        this.files = response.data.data;
      })
      .catch((response) => {
        console.log(response);
      });
  },
};
</script>

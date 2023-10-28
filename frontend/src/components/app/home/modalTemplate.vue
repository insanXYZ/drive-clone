<template >
  <div class="fixed w-screen h-screen z-10 bg-opacity-50 bg-black flex items-center justify-center">
    <div class="w-full h-full bg-opacity-25 rounded p-5 shadow-xl backdrop-filter backdrop-blur-sm flex flex-col">
      <slot></slot>
    </div>
  </div>

</template>
<script>
export default{}
</script>
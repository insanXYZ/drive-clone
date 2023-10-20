<template>
  <Transition name="slide-fade">
    <div class="fixed bottom-10 flex flex-col items-center justify-center gap-10 right-10 bg-white rounded-md shadow-2xl px-1 py-2 w-[500px] h-[225px]">
      <div class="text-xl "><span class="font-semibold">Wait!!</span> your file is being uploaded</div>
      <progress class="rounded-full" ref="progress" max="100" :value="value"></progress>
    </div>
  </Transition>
</template>
<script>
export default {
  props: ["value"],
}
</script>
<style>
.slide-fade-enter-active {
  transition: all 0.3s ease-out;
}

.slide-fade-leave-active {
  transition: all 0.8s cubic-bezier(1, 0.5, 0.8, 1);
}

.slide-fade-enter-from,
.slide-fade-leave-to {
  transform: translateX(20px);
  opacity: 0;
}
</style>
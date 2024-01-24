<template>
  <div
    class="input-group flex flex-col gap-2 mb-5 w-full"
    v-if="type === 'textarea'"
  >
    <label for="name" class="">{{ name }}</label>
    <textarea
      :type="text"
      :placeholder="placeholder"
      class="textarea textarea-bordered"
      :class="class"
      :value="value"
    />
  </div>
</template>

<script setup></script>

<style lang="scss" scoped></style>

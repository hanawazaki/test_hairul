<template>
    <div class="input-group flex flex-col gap-2 mb-5 w-full">
        <label for="name" class="">{{ label }}</label>
        <input
            :type="type"
            :placeholder="placeholder"
            class="input input-bordered w-full max-w-xs"
            :value="inputValue"
            @input="updateInput"
        />

        <InputError :message="isError" />
    </div>
</template>

<script setup>
import { ref } from "vue";
import InputError from "../../Components/InputError.vue";

const props = defineProps({
    label: {
        type: String,
    },
    type: {
        type: String,
    },
    modelValue: {
        type: String,
    },
    placeholder: {
        type: String,
    },
    isError: {
        type: String,
    },
});

const emits = defineEmits();

const inputValue = ref(props.modelValue);

const updateInput = (event) => {
    inputValue.value = event.target.value;
    emits("update:modelValue", inputValue.value);
};
</script>

<style lang="scss" scoped></style>

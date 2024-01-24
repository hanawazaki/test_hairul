<template>
    <div class="input-group flex flex-col gap-2 mb-5 w-full">
        <label for="name" class="">{{ label }}</label>
        <select
            class="select select-bordered w-full max-w-xs"
            :value="inputValue"
            @input="updateInput"
        >
            <option value="" disabled selected>Pilih {{ label }}</option>
            <option v-for="(option, index) in props.options" :key="index">
                {{ option }}
            </option>
        </select>

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
    modelValue: {
        type: String,
    },
    options: {
        type: Array,
    },
    class: {
        type: String,
    },
    isError: {
        type: String,
    },
});

const inputValue = ref("");
const emits = defineEmits();

const updateInput = (val) => {
    inputValue.value = val.target.value;
    emits("update:modelValue", inputValue.value);
};
</script>

<style lang="scss" scoped></style>

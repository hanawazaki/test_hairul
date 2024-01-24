<template>
    <AuthenticatedLayout>
        <div class="flex justify-between">
            <h3 class="font-bold text-lg">Tambah Data Baru</h3>
        </div>
        <form @submit.prevent="handleSubmit" class="mt-5">
            <div class="grid grid-cols-2 gap-3">
                <InputText
                    type="text"
                    label="Nama"
                    placeholder="isi nama"
                    v-model="formData.name"
                    :isError="formData.errors.name"
                />
                <InputText
                    type="email"
                    label="Email"
                    placeholder="isi email"
                    v-model="formData.email"
                    :isError="formData.errors.email"
                />
                <InputText
                    type="password"
                    label="Password"
                    placeholder="isi password"
                    v-model="formData.password"
                    :isError="formData.errors.password"
                />
                <SelectInput
                    label="Role"
                    :options="selectOptions"
                    v-model="formData.status"
                    :isError="formData.errors.status"
                />
            </div>
            <div class="flex gap-2 justify-end">
                <button
                    type="button"
                    class="btn btn-secondary w-32"
                    @click="router.visit('/users-master')"
                >
                    Kembali
                </button>
                <button
                    type="submit"
                    v-if="!isSubmitted"
                    class="btn btn-primary w-32"
                >
                    Simpan
                </button>
                <button type="button" v-else class="btn btn-primary w-32">
                    <Loader />
                </button>
            </div>
        </form>
    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from "../../Layouts/AuthenticatedLayout.vue";
import { ref } from "vue";
import InputText from "../../components/custom/inputtext.vue";
import SelectInput from "../../components/custom/selectinput.vue";
import Loader from "../../Components/Custom/Loader.vue";
import CustomRadioInput from "../../components/custom/customRadioinput.vue";
import { Link, useForm, router } from "@inertiajs/vue3";

const emits = defineEmits();

const formData = useForm({
    name: "",
    email: "",
    password: "",
    role: "",
});

const isSubmitted = ref(false);

const handleSubmit = () => {
    try {
        isSubmitted.value = true;

        formData.post(route("users-master.store"));
        isSubmitted.value = false;
    } catch (error) {
        console.log(error);
        isSubmitted.value = false;
    }
};

const selectOptions = ref(["admin", "user"]);
</script>

<style lang="scss" scoped></style>

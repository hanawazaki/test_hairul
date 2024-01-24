<template>
    <AuthenticatedLayout>
        <div class="flex justify-between">
            <h3 class="font-bold text-lg">Tambah Data Baru</h3>
        </div>
        <form @submit.prevent="handleSubmit" class="mt-5">
            <div class="grid grid-cols-2 gap-3">
                <InputText
                    type="text"
                    label="NIK"
                    placeholder="isi nik"
                    v-model="formData.nik"
                    :isError="formData.errors.nik"
                />
                <InputText
                    type="text"
                    label="Nama"
                    placeholder="isi nama"
                    v-model="formData.name"
                    :isError="formData.errors.name"
                />
                <InputText
                    type="text"
                    label="Position"
                    placeholder="isi position"
                    v-model="formData.position"
                    :isError="formData.errors.position"
                />
                <InputText
                    type="number"
                    label="Gaji Pokok"
                    placeholder="isi position"
                    v-model="formData.salary"
                    :isError="formData.errors.salary"
                />
                <InputText
                    type="number"
                    label="Insentif"
                    placeholder="isi insentif"
                    v-model="formData.incentive"
                    :isError="formData.errors.incentive"
                />
            </div>
            <div class="flex gap-2 justify-end">
                <button
                    type="button"
                    class="btn btn-secondary w-32"
                    @click="router.visit('/employees-master')"
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
import Loader from "../../Components/Custom/Loader.vue";
import { Link, useForm, router } from "@inertiajs/vue3";

const emits = defineEmits();

const formData = useForm({
    nik: "",
    name: "",
    position: "",
    salary: "",
    incentive: "",
});

const isSubmitted = ref(false);

const handleSubmit = () => {
    try {
        isSubmitted.value = true;

        formData.post(route("employees-master.store"));
        isSubmitted.value = false;
    } catch (error) {
        console.log(error);
        isSubmitted.value = false;
    }
};
</script>

<style lang="scss" scoped></style>

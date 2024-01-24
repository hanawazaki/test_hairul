<template>
    <AuthenticatedLayout>
        <div class="flex justify-between items-center mb-4">
            <h1 class="text-2xl font-bold">Users List</h1>
            <div class="flex space-x-2">
                <input
                    type="text"
                    placeholder="Search..."
                    class="input input-sm input-bordered w-full max-w-xs"
                    v-model="search"
                />
                <Link
                    :href="route('users-master.create')"
                    class="btn btn-outline btn-sm"
                >
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke-width="1.5"
                        stroke="currentColor"
                        class="w-6 h-6"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"
                        />
                    </svg>
                    New Data
                </Link>
            </div>
        </div>
        <div class="overflow-x-auto">
            <table class="table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr
                        v-if="props.users.data.length"
                        v-for="item in filteredData"
                        :key="item.id"
                    >
                        <td>
                            <div class="flex items-center gap-3">
                                <div>
                                    <div class="font-bold">
                                        {{ item.name }}
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td>
                            {{ item.email }}
                        </td>
                        <td class="">
                            <Link
                                :href="route('users-master.edit', item.id)"
                                class="btn btn-success btn-xs mr-2"
                            >
                                Edit
                            </Link>

                            <button
                                @click="deleteData(item.id)"
                                class="btn btn-error btn-xs"
                            >
                                Delete
                            </button>
                        </td>
                    </tr>
                    <tr v-else>
                        <td colspan="5">
                            <h5 class="text-center font-mono my-5">
                                Tidak ada data
                            </h5>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <Pagination
            :items="props.users"
            v-model:current-page="props.users.current_page"
            @update:current-page="fetchUsers"
        />
    </AuthenticatedLayout>
</template>

<script setup>
import { Head, Link, router } from "@inertiajs/vue3";
import { ref, onMounted, computed } from "vue";
import Pagination from "../../components/Custom/Pagination.vue";
import AuthenticatedLayout from "../../Layouts/AuthenticatedLayout.vue";

const props = defineProps({
    users: {
        type: Object,
        required: true,
    },
});
const search = ref("");

const filteredData = computed(() => {
    return props.users.data.filter((user) =>
        user.name.toLowerCase().includes(search.value.toLowerCase())
    );
});

const deleteData = (id) => {
    if (confirm("are you sure?")) {
        router.delete(route("users-master.destroy", id), {
            preserveScroll: true,
        });
    }
};

function fetchUsers(page) {
    router.visit(`/users-master?page=${page}`);
}
</script>

<style lang="scss" scoped></style>

<template>
    <div v-if="items.last_page > 1" class="flex justify-center my-5">
        <div class="join">
            <button
                class="join-item btn"
                @click="prevPage(items.current_page - 1)"
                v-if="items.current_page > 1"
            >
                Prev
            </button>

            <button
                class="join-item btn"
                @click="handleChangePage(page)"
                v-for="page in items.last_page"
                :key="page"
                :class="{
                    'btn-active': page === state.currentPage,
                }"
            >
                {{ page }}
            </button>

            <button
                class="join-item btn"
                @click="nextPage(items.current_page + 1)"
                v-if="items.current_page < items.last_page"
            >
                Next
            </button>
        </div>
    </div>

    <!--  -->
</template>

<script setup>
import { reactive, computed, getCurrentInstance } from "vue";

const props = defineProps({
    items: {
        type: Object,
    },
});

const state = reactive({
    currentPage: props.items.current_page,
});

const totalPages = computed(() =>
    Math.ceil(props.items.total / props.items.per_page)
);

const handleChangePage = (page) => {
    state.currentPage = page;
    instance.emit("update:currentPage", state.currentPage);
};

const nextPage = () => {
    if (state.currentPage < totalPages.value) {
        state.currentPage++;
        instance.emit("update:currentPage", state.currentPage);
    }
};

const prevPage = () => {
    if (state.currentPage > 1) {
        state.currentPage--;
        instance.emit("update:currentPage", state.currentPage);
    }
};

const instance = getCurrentInstance();
</script>

<style scoped>
.active {
    @apply bg-indigo-500 text-white;
}
</style>

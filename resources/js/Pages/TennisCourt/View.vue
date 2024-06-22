<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import ViewerLayout from '@/Layouts/ViewerLayout.vue';

import {Head, usePage} from '@inertiajs/vue3';
import {computed, ref} from "vue";

defineProps({
    tennisCourts: Array
})

const headers = ref([
    { title: 'Número', key: 'court_number', align: 'center', sortable: false},
    { title: 'Tipo', key: 'court_type', align: 'center', sortable: false},
    { title: 'Status', key: 'status', align: 'center', sortable: false},
])

const { auth } = usePage().props;
const isAuthenticated = computed(() => !!auth.user);
console.log(isAuthenticated.value)

</script>

<template>
    <Head title="Tennis courts" />

    <component :is="isAuthenticated ? AuthenticatedLayout : ViewerLayout">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Quadras de tênis</h2>
        </template>

        <div class="py-6">
            <div class="max-w-8xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <v-data-table class="elevation-1"
                      :items="tennisCourts"
                      :headers="headers"
                      :items-per-page="20"
                    >
                    </v-data-table>
                </div>
            </div>
        </div>
    </component>
</template>

<style>
.v-data-table-header__content {
    font-size: 20px !important;
    font-weight: bold;
}
</style>

<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';

defineProps({
    tennisCourts: Array
})
</script>

<template>
    <Head title="Tennis courts" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Quadras de tênis</h2>
        </template>

        <div class="py-6">
            <div class="max-w-8xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <v-data-table :items="tennisCourts"></v-data-table>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>


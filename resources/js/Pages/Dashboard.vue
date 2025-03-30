<script setup>
import Table from '@/Components/Table.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { ref } from 'vue';

const props = defineProps(['data']);

const tableHeaders = ref([
   {
     name: 'Title',
     value: "title"
   },
   {
     name: 'Description',
     value: "description"
   },
   {
     name: 'Date',
     value: "created_at"
   }
]);


</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2
                class="text-xl font-semibold leading-tight text-gray-800"
            >
                Dashboard
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto">
                <div class="p-6 text-gray-900">
                    <Table
                        :headers="tableHeaders"
                        :data="props?.data"
                        :tableTitle="'POSTS'"
                        :url="'dashboard'"
                    />
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

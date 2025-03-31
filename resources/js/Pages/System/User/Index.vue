<script setup>
import Table from '@/Components/Table.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { ref } from 'vue';

const props = defineProps(['users']);

const tableHeaders = ref([
   {
     name: 'Msisdn',
     value: "msisdn"
   },
   {
     name: 'City',
     value: "city_id"
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
                        :data="props?.users"
                        :tableTitle="'Users'"
                        :url="'users'"
                    />
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

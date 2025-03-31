<script setup>
import { onMounted, ref, watch } from 'vue';
import { router, useForm, usePage } from '@inertiajs/vue3';
import PaginationServerSide from './PaginationServerSide.vue';
import usePagination from '@/Helper/usePagination';
import moment from 'moment';
import PrimaryButton from './PrimaryButton.vue';

moment.locale('ja');

const props = defineProps({
  data: {
    type: Array,
    required: true
  },
  headers: {
    type: Array,
    required: true
  },
  url: {
    type: String
  },
  tableTitle: {
    type: String
  },
  data_model: {
    type: String
  }
});

const statusForm = useForm({
    status: null,
});

const activeForm = useForm({
    status: true,
});

const perPage = ref('10');
const queryParams = ref({});

const pagination = ref({
    current_page: props?.data?.current_page,
    per_page: props?.data.per_page,
    total: props?.data.total
});

const updatePerPage = () => {
  const currentUrl = props?.url;
  const newUrl = addOrUpdateQueryParam(currentUrl, 'per_page', perPage.value);
  router.get(newUrl);
};

const addOrUpdateQueryParam = (url, param, value) => {
  const urlObj = new URL(url, window.location.origin);
  urlObj.searchParams.set(param, value);
  return urlObj.href;
};

const form = useForm();

const deleteForm = (id, route) => {
    form.delete(route(route, id), {
        onSuccess: () => {
        },
        onError: (error) => {
            console.error("Form submission error:", error);
        },
    });
}

const page = usePage();

const emit = defineEmits();

const fetchData = (page) => {
  router.get(props.url, { page: page });
};

const changeStatus = (item, status) => {
    statusForm.status = status

    statusForm.post(route('dashboard.posts.status', item.id), {
        onSuccess: () => {
            statusForm.reset();
        },
        onError: (error) => {
            console.error("Form submission error:", error);
        },
    });
}

const changeActive = (item, status) => {
    activeForm.status = status

    activeForm.post(route('users.status', item.id), {
        onSuccess: () => {
            statusForm.reset();
        },
        onError: (error) => {
            console.error("Form submission error:", error);
        },
    });
}

watch(() => pagination.value.current_page, (newPage) => {
  fetchData(newPage);
});

const paginate = usePagination(props.data);

// Add this function to handle column widths
const getColumnWidth = (header) => {
  const columnWidths = {
    'description': { width: '300px', minWidth: '300px' },
    'name': { width: '200px', minWidth: '200px' },
  };

  return columnWidths[header.value] || { width: '150px', minWidth: '150px' };
};

onMounted(() => {
    const params = new URLSearchParams(window.location.search);
    queryParams.value = Object.fromEntries(params.entries());
    console.log(queryParams.value.per_page);
    perPage.value = queryParams.value.per_page ?? 10
});


</script>

<template>
    <VCard class="app-table-card">
        <VCardTitle style="background-color: #F0F2F5;">
            <h4>{{ tableTitle ?? 'Unknown Title' }}</h4>
        </VCardTitle>
        <VCardTitle class="mb-5" style="font-size: 0.8rem; border-bottom: 1px solid rgb(0,0,0,0.1);">
            <div class="d-flex justify-between my-3">
                <p class="pt-3">1−{{ perPage }} Per Page {{props?.data.total}} Items</p>
                <div class="d-flex ">
                    <div class="d-flex ml-5">
                        <span style="padding-top: 0.6rem;" class="mr-3">
                            Per Page
                        </span>
                        <v-select
                        :items="['10', '20', '50', '100', '250', '500']"
                        dense
                        style="width: 95px; font-size: 12px;"
                        variant="outlined" density="compact" required hide-details
                        v-model="perPage"
                        @update:modelValue="updatePerPage"
                        ></v-select>
                    </div>

                </div>
            </div>
        </VCardTitle>
        <VCardText style="box-shadow: none;">
            <div class="table-wrapper">
                <VTable class="app-table">
                    <thead class="table-header">
                    <tr>
                        <th class="header-cell" style="min-width: 80px; width: 80px;">
                            ID
                        </th>
                        <th
                        class="header-cell"
                        v-for="header in headers"
                        :key="header.value"
                        :style="getColumnWidth(header)"
                        >
                            {{ header.name }}
                        </th>
                        <!-- Fixed action column -->
                        <th
                            class="header-cell fixed-column fixed-header"
                            style="min-width: 100px; width: 100px;"
                        >
                        </th>
                    </tr>
                    </thead>

                    <tbody class="tbody-container">
                        <tr v-if="!data?.data?.length">
                            <td :colspan="headers.length" class="text-center pt-5">
                                No Data Available
                            </td>
                        </tr>

                        <tr v-else v-for="(item, index) in data?.data" :key="index" class="cursor-pointer">
                            <td style="color: #45B4D3; min-width: 80px; width: 80px;">
                                {{ index + 1 }}
                            </td>
                            <td
                                v-for="(header,i) in headers"
                                :key="i"
                                :style="getColumnWidth(header)"
                            >
                                <div v-if="header.value == 'description'">
                                    {{ item[header.value]?.length > 40 ? item[header.value].substring(0, 40) + '...' : item[header.value] }}
                                </div>
                                <div v-if="header.value == 'city_id'">
                                    {{ item.city?.name_mm }}
                                </div>
                                <div v-else-if="header.value == 'created_at'">
                                    <div v-if="item.created_at">
                                        {{ moment(item.created_at).format('MMM D h:mm A') }} ({{ moment(item.created_at).fromNow() }})
                                    </div>
                                    <div v-else>N/A</div>
                                </div>

                                <div v-else>
                                    {{ item[header.value] }}
                                </div>
                            </td>
                            <!-- Fixed action column -->
                            <td
                            v-if="url == 'dashboard'"
                            class="fixed-column"
                            style="min-width: 100px; width: 100px;"
                            >
                                <VBtn color="green" class="text-white" v-if="item.status == 'closed'" @click="changeStatus(item, 'active')">Approve</VBtn>
                                <VBtn class="mx-2" color="red" v-if="item.status == 'active' || item.status == 'done'" @click="changeStatus(item, 'closed')">Cancel</VBtn>
                                <VBtn class="mx-2" color="red" @click="deleteForm(item.id, 'dashboard.posts.delete')">Delete</VBtn>
                            </td>
                            <td
                                v-if="url == 'users'"
                                class="fixed-column"
                                style="min-width: 100px; width: 100px;"
                            >
                                <VBtn class="mx-2" color="red" @click="deleteForm(item.id, 'users.destroy')">Delete</VBtn>
                                <VBtn class="mx-2" color="red" v-if="item.is_active == true" @click="changeActive(item, false)">Ban</VBtn>
                                <VBtn class="mx-2 text-white" color="green" v-if="item.is_active == false" @click="changeActive(item, true)">Restore</VBtn>
                            </td>
                        </tr>
                    </tbody>
                </VTable>
            </div>
            <div class="my-10">
                <PaginationServerSide
                    :total="paginate.lastPage"
                    :current-page="paginate.currentPage"
                    :next-page-url="paginate.nextPage"
                    :previous-page-url="paginate.previousPage"
                    :base="paginate.path"
                />
            </div>
        </VCardText>
    </VCard>
</template>

<style scoped>
.app-table {
  width: 100%;
  min-height: 60vh;
  border-collapse: separate; /* Changed from collapse */
  border-spacing: 0;
}

.fixed-header {
  background-color: #f0f2f6 !important; /* Match your header background color */
  z-index: 4 !important; /* Higher z-index to stay on top */
}

.table-header {
  background-color: #f0f2f6;
  position: sticky;
  top: 0;
  z-index: 2;
}

.header-cell {
  color: #333;
  font-weight: bold;
  padding: 10px;
  white-space: nowrap; /* Prevent header text wrapping */
}

.tbody-container tr {
  background-color: #fff;
}

.tbody-container tr:nth-child(even) {
  background-color: #f0f2f6;
}

.tbody-container td {
  padding: 10px;
  white-space: nowrap;
}

.app-table-card {
  border-width: 1px;
  border-radius: 15px;
  margin-bottom: 2rem;
}

.app-table-card-message {
  border: none;
  box-shadow: none;
  margin-bottom: 2rem;
}

/* Fixed column styles */
.fixed-column {
  position: sticky !important;
  right: 0;
  background-color: inherit;
  z-index: 3;
  /* box-shadow: -2px 0 5px rgba(0,0,0,0.1); */
}

.fixed-column::after {
  content: '';
  position: absolute;
  left: 0;
  top: 0;
  bottom: 0;
  width: 4px;
  /* background: linear-gradient(to right, rgba(0,0,0,0.1), transparent); */
}

/* Scrollbar styling */
.table-wrapper::-webkit-scrollbar {
  height: 8px;
}

.table-wrapper::-webkit-scrollbar-track {
  background: #f1f1f1;
}

.table-wrapper::-webkit-scrollbar-thumb {
  background: #888;
  border-radius: 4px;
}

.table-wrapper::-webkit-scrollbar-thumb:hover {
  background: #555;
}
</style>

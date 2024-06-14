<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {Head, usePage} from '@inertiajs/vue3';
import { defineProps, ref, computed, watch } from 'vue';
import { addTennisCourt, editTennisCourt, deleteTennisCourt } from './api';

const props = defineProps({
    tennisCourts: Array,
    tennisCourtTypes: Array,
    tennisCourtStatus: Array,
    // auth: Object
})

props.tennisCourtTypes = props.tennisCourtTypes.map((type) => {
    return { title: type, value: type }
})

props.tennisCourtStatus = props.tennisCourtStatus.map((status) => {
    return { title: status, value: status }
})

const headers = ref([
    { title: 'Número', key: 'court_number', align: 'center', sortable: false},
    { title: 'Tipo', key: 'court_type', align: 'center', sortable: false},
    { title: 'Status', key: 'status', align: 'center', sortable: false},
    { title: 'Ações', key: 'actions', align: 'center', sortable: false},
])

const dialog = ref(false)
const dialogDelete = ref(false)
const editedIndex = ref(-1)
const editedItem = ref({
    court_number: '',
    court_type: 'Saibro',
    status: 'Disponivel'
})
const defaultItem = ref({
    court_number: '',
    court_type: '',
    status: ''
});

const showSnackbar = ref(false);
let snackbarText = '';
const snackbarTimeout = 3000;

const editItem = (item) => {
    editedIndex.value = props.tennisCourts.indexOf(item)
    editedItem.value = Object.assign({}, item)
    dialog.value = true
}

const deleteItem = (item) => {
    editedIndex.value = props.tennisCourts.indexOf(item)
    editedItem.value = Object.assign({}, item)
    dialogDelete.value = true
}

const deleteItemConfirm = async () => {
    try {
        await deleteTennisCourt(editedItem.value.court_number);
        props.tennisCourts.splice(editedIndex.value, 1);
        closeDelete();
    } catch (error) {
        showSnackbar.value = true;
        snackbarText = error.message;
    }
};

const close = () => {
    dialog.value = false
    editedItem.value = Object.assign({}, defaultItem.value)
    editedIndex.value = -1
}

const closeDelete = () => {
    dialogDelete.value = false
    editedItem.value = Object.assign({}, defaultItem.value)
    editedIndex.value = -1
}

const save = async () => {
    try {
        if (editedIndex.value > -1) {  // Edit
            await editTennisCourt(editedItem.value.court_number, editedItem.value);
            props.tennisCourts[editedIndex.value] = editedItem.value;
        } else {  // Add
            const response = await addTennisCourt(editedItem.value);
            props.tennisCourts.push(editedItem.value)
        }
        close();
    } catch (error) {
        showSnackbar.value = true;
        snackbarText = error.message;
    }
};

const formTitle = computed(() => {
    return editedIndex.value === -1 ? 'Nova quadra' : 'Editar quadra'
})

watch(dialog, (val) => {
    val || close()
})

watch(dialogDelete, (val) => {
    val || closeDelete()
})
</script>

<template>
    <Head title="Tennis courts" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Controle de quadras de tênis</h2>
        </template>

        <div class="py-6">
            <div class="max-w-8xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <v-data-table class="elevation-1"
                        :items="tennisCourts"
                        :headers="headers"
                        :items-per-page="20"
                    >
                        <template v-slot:top>
                            <v-toolbar flat>
                                <v-toolbar-title>Quadras</v-toolbar-title>
                                <v-divider class="mx-4" inset vertical></v-divider>
                                <v-spacer></v-spacer>
                                <v-dialog v-model="dialog" max-width="700px">
                                    <template v-slot:activator="{ props }">
                                        <v-btn class="mb-2" color="primary" dark v-bind="props">
                                            Nova quadra
                                        </v-btn>
                                    </template>
                                    <v-card>
                                        <v-card-title>
                                            <span class="text-h5">{{ formTitle }}</span>
                                        </v-card-title>

                                        <v-card-text>
                                            <v-container>
                                                <v-row>
                                                    <v-col cols="12" md="4" sm="6">
                                                        <v-text-field
                                                            v-model="editedItem.court_number"
                                                            label="Número"
                                                            type="number"
                                                        ></v-text-field>
                                                    </v-col>
                                                    <v-col cols="12" md="4" sm="6">
                                                        <v-select
                                                            v-model="editedItem.court_type"
                                                            label="Tipo"
                                                            :items="props.tennisCourtTypes"
                                                            item-title="title"
                                                            item-value="value"
                                                        ></v-select>
                                                    </v-col>
                                                    <v-col cols="12" md="4" sm="6">
                                                        <v-select
                                                            v-model="editedItem.status"
                                                            label="Status"
                                                            :items="props.tennisCourtStatus"
                                                            item-title="title"
                                                            item-value="value"
                                                        ></v-select>
                                                    </v-col>
                                                </v-row>
                                            </v-container>
                                        </v-card-text>

                                        <v-card-actions>
                                            <v-spacer></v-spacer>
                                            <v-btn color="blue-darken-1" variant="text" @click="close">
                                                Cancel
                                            </v-btn>
                                            <v-btn color="blue-darken-1" variant="text" @click="save">
                                                Save
                                            </v-btn>
                                        </v-card-actions>
                                    </v-card>
                                </v-dialog>
                                <v-dialog v-model="dialogDelete" max-width="700px">
                                    <v-card>
                                        <v-card-title class="text-h5"
                                        >Are you sure you want to delete this item?</v-card-title
                                        >
                                        <v-card-actions>
                                            <v-spacer></v-spacer>
                                            <v-btn color="blue-darken-1" variant="text" @click="closeDelete"
                                            >Cancel</v-btn
                                            >
                                            <v-btn
                                                color="blue-darken-1"
                                                variant="text"
                                                @click="deleteItemConfirm"
                                            >OK</v-btn
                                            >
                                            <v-spacer></v-spacer>
                                        </v-card-actions>
                                    </v-card>
                                </v-dialog>
                            </v-toolbar>
                        </template>
                        <template v-slot:item.actions="{ item }">
                            <v-icon class="me-2" size="small" @click="editItem(item)">
                                mdi-pencil
                            </v-icon>
                            <v-icon size="small" @click="deleteItem(item)"> mdi-delete </v-icon>
                        </template>
                    </v-data-table>
                    <v-snackbar
                        v-model="showSnackbar"
                        :timeout="snackbarTimeout"
                    >
                        {{ snackbarText }}

                        <template v-slot:actions>
                            <v-btn
                                color="pink"
                                variant="text"
                                @click="showSnackbar = false"
                            >
                                Close
                            </v-btn>
                        </template>
                    </v-snackbar>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<style>
.v-data-table-header__content {
    font-size: 20px !important;
    font-weight: bold;
}
</style>

<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { defineProps, ref, computed, watch } from 'vue';

const props = defineProps({
    tennisCourts: Array
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
    court_type: '',
    status: ''
})
const defaultItem = ref({
    court_number: '',
    court_type: '',
    status: ''
});

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

const deleteItemConfirm = () => {
    props.tennisCourts.splice(editedIndex.value, 1)
    closeDelete()
}

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

const save = () => {
    if (editedIndex.value > -1) {
        Object.assign(props.tennisCourts[editedIndex.value], editedItem.value)
    } else {
        props.tennisCourts.push(editedItem.value)
    }
    close()
}

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
                                <v-dialog v-model="dialog" max-width="500px">
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
                                                        ></v-text-field>
                                                    </v-col>
                                                    <v-col cols="12" md="4" sm="6">
                                                        <v-text-field
                                                            v-model="editedItem.court_type"
                                                            label="Tipo"
                                                        ></v-text-field>
                                                    </v-col>
                                                    <v-col cols="12" md="4" sm="6">
                                                        <v-text-field
                                                            v-model="editedItem.status"
                                                            label="Status"
                                                        ></v-text-field>
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
                                <v-dialog v-model="dialogDelete" max-width="500px">
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

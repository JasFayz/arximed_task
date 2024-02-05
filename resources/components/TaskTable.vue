<template>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Name
                <div class="d-flex">
                    <sort-button
                        query-param="name"
                        :key="1"
                        @sortChanged="(data) => emit('sortChanged', data)"
                    />
                </div>
            </th>
            <th scope="col">Email
                <div class="d-flex">
                    <sort-button
                        query-param="email"
                        :key="2"
                        @sortChanged="(data) => emit('sortChanged', data)"
                    />
                </div>
            </th>
            <th scope="col">Description</th>
            <th scope="col">Status
                <div class="d-flex">
                    <sort-button query-param="status"
                                 :key="3"
                                 @sortChanged="(data) => emit('sortChanged', data)"
                    />
                </div>
            </th>
            <th v-if="auth?.is_admin" class="text-right">Actions</th>
        </tr>
        </thead>
        <tbody>
        <tr v-if="loading">
            <th colspan="6">
                <div class="spinner-border text-primary" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
            </th>
        </tr>
        <tr v-for="task in tasks?.data" v-else-if="tasks?.data?.length> 0">
            <th scope="row">{{ task.id }}</th>
            <td>{{ task.name }}</td>
            <td>{{ task.email }}</td>
            <td>{{ task.description }}</td>
            <td>{{ task.statusText }}</td>
            <td v-if="auth?.is_admin" class="text-right">
                <button class="btn btn-primary btn-sm mx-2"
                        @click="selectTask(task)">
                    Редактировать
                </button>
                <button class="btn btn-success btn-sm mx-2"
                        v-if="!task.status"
                        @click="closeTask(task.id)">
                    Завершить
                </button>
            </td>
        </tr>

        <tr v-else>
            <th colspan="6" class="text-center ">No Data</th>
        </tr>
        </tbody>
    </table>
    <pagination :models="tasks"
                v-model="currentPage"
    />
</template>

<script setup>
import {computed, onMounted, ref, watch} from "vue";
import SortButton from "./SortButton.vue";
import Pagination from "./Pagination.vue";

const currentPage = ref(1)

const props = defineProps({
    tasks: Object,
    auth: Object,
    loading: Boolean
})
const data = ref({})
const isAdmin = computed(() => {
    return props?.auth?.is_admin
})
const emit = defineEmits(['closeEmit', 'selectTask', 'sortChanged', 'pageChanged'])
watch(() => currentPage.value, () => {
    emit('pageChanged', currentPage.value)
})
const closeTask = (id) => {
    axios.patch('/api/tasks/' + id + '/set-done')
        .then(response => {
            emit('closeEmit');
        }).catch(e => {
        console.log(e)
    })
}
const selectTask = (task) => {
    emit('selectTask', task)
}
</script>

<style scoped>

</style>

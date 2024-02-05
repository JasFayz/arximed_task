<template>
    <h4>First Task</h4>
    <task-form :task="task"
               @taskCreated="() => handleGetTask()"
               @taskUpdate="() => handleGetTask()"
    />
    <task-table
        :tasks="tasks"
        @selectTask="selectTask"
        @closeEmit="() => handleGetTask()"
        @sortChanged="(data) => {
            query.param = data.param
            query.sort = data.sort
            handleGetTask()
        }"
        @pageChanged="(page) => {
            query.page = page
            handleGetTask()
        }"
        :auth="auth"
        :loading="loading"
    />
</template>

<script setup>
import TaskForm from './../components/TaskForm.vue';
import TaskTable from './../components/TaskTable.vue';
import {onMounted, onUpdated, ref} from "vue";

const loading = ref(false)
const tasks = ref({})
const task = ref({})
const props = defineProps({
    auth: null
})

const selectTask = (data) => {
    task.value = data
}
const query = ref({
    param: null,
    sort: null,
    page: 1
})

const handleGetTask = () => {
    loading.value = true
    axios.get('/api/tasks', {
        params: {...query.value}
    })
        .then(res => {
            tasks.value = res.data.data
        }).catch(e => {
        console.log(e)
    }).finally(e => {
        loading.value = false
    })
}

onMounted(() => {
    handleGetTask()
})


</script>


<style scoped>

</style>

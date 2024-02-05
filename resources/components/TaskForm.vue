<template>
    <form action="" class="mb-6">
        <h4>{{ Object.keys(task).length !== 0 ? "Обновить " + task.id : "Создать" }}</h4>

        <div class="alert alert-success" role="alert" v-if="success">
            Success
        </div>

        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control"
                   v-model="form.name"
                   :class="{
                       'is-invalid': errors?.name
                   }"
                   id="name" placeholder="Name">
            <div class="invalid-feedback" v-if="errors?.name">
                {{ errors?.name }}
            </div>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email"
                   :class="{
                       'is-invalid': errors?.email
                   }"
                   v-model="form.email" class="form-control" id="email"
                   placeholder="Email">
            <div class="invalid-feedback" v-if="errors?.email">
                {{ errors?.name }}
            </div>
        </div>
        <div class="mb-3">
            <label for="desc"
                   class="form-label">Task description</label>
            <textarea v-model="form.description"
                      id="desc"
                      :class="{'is-invalid': errors?.description}"
                      placeholder="Desc"
                      class="form-control"></textarea>
            <div class="invalid-feedback" v-if="errors?.description">
                {{ errors?.description }}
            </div>
        </div>
        <button type="button" class="btn btn-primary" @click="handleSubmit">Save</button>
    </form>
</template>

<script setup>
import {ref, watch} from "vue";

const errors = ref({})
const props = defineProps({
    task: Object
})
const form = ref({
    name: null,
    email: null,
    description: null
})

watch(() => props.task, (newValue) => {
    form.value.name = newValue.name
    form.value.email = newValue.email
    form.value.description = newValue.description
})
const success = ref(false)
const emit = defineEmits(['actionSuccess'])

const handleSubmit = () => {
    if (props.task?.id) {
        form._method = 'PUT'
        axios.put('api/tasks/' + props.task.id, form.value)
            .then(res => {
                clearForm()
                errors.value = null
                success.value = true
                emit('taskUpdate')
            }).catch(e => {
            console.log(e)
        })

    } else {
        axios.post('/api/tasks', form.value)
            .then(response => {
                if (response.data.success) {
                    errors.value = null
                    clearForm()
                    emit('taskCreated')
                }
            }).catch(e => {
            errors.value = e.response.data.errors
        })
    }
}
const clearForm = () => {
    Object.entries(form.value).forEach(entry => {
        const [key, value] = entry
        form.value[key] = null
    })
}

</script>

<style scoped>

</style>

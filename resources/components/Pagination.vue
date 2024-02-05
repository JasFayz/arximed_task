<template>
    <nav aria-label="Page navigation example">
        <ul class="pagination">
            <li class="page-item"
                :class="{
                    'disabled': !page.url,
                    'active': models?.current_page === parseInt(page.label)
                }"
                v-for="page in models.links">
                <a href="#" class="page-link" @click.prevent="changePage(page.url)"
                   v-html="page.label"/>

            </li>
        </ul>
    </nav>
</template>

<script setup>

import {ref} from "vue";

const page = ref(1)

const props = defineProps({
    models: Object,
    modelValue: {
        type: Number,
        default: 1
    }
})

const emit = defineEmits(['update:modelValue'])

const changePage = (page) => {

    const url = new URL(page)

    emit('update:modelValue', parseInt(url.searchParams.get('page')))
}

</script>

<style scoped>

</style>

<template>
    <h4>Second Task</h4>
    <el-table :data="hotels?.data" v-loading="loading">
        <el-table-column prop="id" label="ID" width="50"/>
        <el-table-column prop="name" label="Name">
            <template #header="props">
                <el-input v-model="search.name" placeholder="Name"
                          @keydown.enter="handleGetHotel"/>
            </template>
        </el-table-column>
        <el-table-column prop="price" label="Price">
            <template #header="props">
                <el-form-item label="Price">
                    <el-slider v-model="search.price_range"
                               range show-stops :max="400000" step="100"
                               @change="handleGetHotel"
                    />
                </el-form-item>
            </template>
        </el-table-column>
        <el-table-column prop="bedrooms" label="Bedrooms">
            <template #header>
                <el-form-item label="Bedrooms">
                    <el-input-number v-model="search.bedrooms"
                                     @keydown.enter="handleGetHotel"/>
                </el-form-item>
            </template>
        </el-table-column>
        <el-table-column prop="bathrooms" label="Bathrooms">
            <template #header>
                <el-form-item label="Bathrooms">
                    <el-input-number v-model="search.bathrooms"
                                     @keydown.enter="handleGetHotel"/>
                </el-form-item>
            </template>
        </el-table-column>
        <el-table-column prop="storeys" label="Storeys">
            <template #header>
                <el-form-item label="Storeys">
                    <el-input-number v-model="search.storeys"
                                     @keydown.enter="handleGetHotel"/>
                </el-form-item>
            </template>
        </el-table-column>
        <el-table-column prop="garages" label="Garages">
            <template #header>
                <el-form-item label="Garages">
                    <el-input-number v-model="search.garages"
                                     @keydown.enter="handleGetHotel"/>
                </el-form-item>
            </template>
        </el-table-column>
    </el-table>
</template>

<script setup>
import {onMounted, ref} from "vue";

const loading = ref(false)

const search = ref({})
const hotels = ref(null)
const handleGetHotel = () => {
    loading.value = true;
    axios.get('/api/hotels', {
        params: {...search.value}
    }).then(res => {
        hotels.value = res.data.hotels

    }).catch(e => {
        console.log(r)
    }).finally(e => {
        loading.value = false
    })
}


onMounted(() => {
    handleGetHotel()
})
</script>


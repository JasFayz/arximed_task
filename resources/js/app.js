import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

import Task from './Task.vue';
import TaskForm from '../components/TaskForm.vue';
import TaskTable from '../components/TaskTable.vue';
import Hotel from './Hotel.vue';

import {createApp} from 'vue'
import ElementUI from 'element-plus';
import 'element-plus/dist/index.css';
import ru from 'element-plus/dist/locale/ru.min.js';


const app = createApp({
    components: {
        Task, TaskForm, TaskTable,
        Hotel
    }
})
app.use(ElementUI, {
    locale: ru,
})
app.mount('#app')

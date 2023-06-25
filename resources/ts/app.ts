import './bootstrap';
import { createApp } from 'vue';

import App from './main.vue';

const mainApp = createApp(App);
mainApp.mount('#app');

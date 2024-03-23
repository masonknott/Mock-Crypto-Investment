import './bootstrap';
import { createApp } from 'vue';
import InvestmentTable from './components/InvestmentTable.vue'

const app = createApp({});
app.component('investment-table', InvestmentTable);
app.mount('#app');
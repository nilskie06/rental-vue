<template>
  <div class="admin-page">
    <div class="page-header"><h1>Payments</h1><button @click="showModal = true" class="btn-primary">+ Record Payment</button></div>
    <table class="data-table">
      <thead><tr><th>Tenant</th><th>Amount</th><th>Date</th><th>Method</th><th>Status</th></tr></thead>
      <tbody>
        <tr v-for="p in payments" :key="p.id">
          <td>{{ p.tenant?.first_name }} {{ p.tenant?.last_name }}</td>
          <td>₱{{ p.amount?.toLocaleString() }}</td><td>{{ p.payment_date }}</td>
          <td>{{ p.payment_method }}</td>
          <td><span class="badge" :class="p.status">{{ p.status }}</span></td>
        </tr>
      </tbody>
    </table>
    <div class="modal" v-if="showModal" @click.self="showModal = false">
      <div class="modal-content">
        <h2>Record Payment</h2>
        <form @submit.prevent="save">
          <select v-model="form.invoice_id" required><option v-for="i in invoices" :key="i.id" :value="i.id">{{ i.invoice_number }} - ₱{{ i.amount }}</option></select>
          <input v-model.number="form.amount" type="number" placeholder="Amount" required>
          <input v-model="form.payment_date" type="date" required>
          <select v-model="form.payment_method"><option>cash</option><option>bank_transfer</option><option>gcash</option><option>maya</option><option>paymongo</option></select>
          <button type="submit" class="btn-primary">Record</button>
        </form>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import axios from 'axios';
const payments = ref([]); const invoices = ref([]); const showModal = ref(false);
const form = ref({ invoice_id: '', amount: 0, payment_date: '', payment_method: 'cash' });
onMounted(async () => { payments.value = (await axios.get('/api/payments')).data; invoices.value = (await axios.get('/api/invoices')).data; });
const save = async () => { await axios.post('/api/payments', form.value); payments.value = (await axios.get('/api/payments')).data; showModal.value = false; };
</script>

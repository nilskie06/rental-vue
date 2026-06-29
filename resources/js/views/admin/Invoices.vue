<template>
  <div class="admin-page">
    <div class="page-header"><h1>Invoices</h1><button @click="showModal = true" class="btn-primary">+ Create Invoice</button></div>
    <table class="data-table">
      <thead><tr><th>#</th><th>Tenant</th><th>Amount</th><th>Paid</th><th>Due</th><th>Status</th><th>Actions</th></tr></thead>
      <tbody>
        <tr v-for="i in invoices" :key="i.id">
          <td>{{ i.invoice_number }}</td>
          <td>{{ i.lease?.tenant?.first_name }} {{ i.lease?.tenant?.last_name }}</td>
          <td>₱{{ i.amount?.toLocaleString() }}</td><td>₱{{ i.paid_amount?.toLocaleString() }}</td>
          <td>{{ i.due_date }}</td>
          <td><span class="badge" :class="i.status">{{ i.status }}</span></td>
          <td><button @click="edit(i)">Edit</button></td>
        </tr>
      </tbody>
    </table>
    <div class="modal" v-if="showModal" @click.self="showModal = false">
      <div class="modal-content">
        <h2>Create Invoice</h2>
        <form @submit.prevent="save">
          <select v-model="form.lease_id" required><option v-for="l in leases" :key="l.id" :value="l.id">{{ l.tenant?.first_name }} - {{ l.unit?.unit_number }}</option></select>
          <input v-model.number="form.amount" type="number" placeholder="Amount" required>
          <input v-model="form.due_date" type="date" required>
          <select v-model="form.type"><option>rent</option><option>utility</option><option>fee</option><option>late</option></select>
          <button type="submit" class="btn-primary">Create</button>
        </form>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import axios from 'axios';
const invoices = ref([]); const leases = ref([]); const showModal = ref(false);
const form = ref({ lease_id: '', amount: 0, due_date: '', type: 'rent' });
onMounted(async () => { invoices.value = (await axios.get('/api/invoices')).data; leases.value = (await axios.get('/api/leases')).data; });
const edit = (i) => { form.value = { ...i }; showModal.value = true; };
const save = async () => { await axios.post('/api/invoices', form.value); invoices.value = (await axios.get('/api/invoices')).data; showModal.value = false; };
</script>

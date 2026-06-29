<template>
  <div class="admin-page">
    <div class="page-header"><h1>Expenses</h1><button @click="showModal = true" class="btn-primary">+ Add Expense</button></div>
    <table class="data-table">
      <thead><tr><th>Category</th><th>Description</th><th>Amount</th><th>Date</th><th>Vendor</th><th>Actions</th></tr></thead>
      <tbody>
        <tr v-for="e in expenses" :key="e.id">
          <td><span class="badge">{{ e.category }}</span></td><td>{{ e.description }}</td>
          <td>₱{{ e.amount?.toLocaleString() }}</td><td>{{ e.expense_date }}</td><td>{{ e.vendor }}</td>
          <td><button @click="del(e.id)" class="btn-danger">Delete</button></td>
        </tr>
      </tbody>
    </table>
    <div class="modal" v-if="showModal" @click.self="showModal = false">
      <div class="modal-content">
        <h2>Add Expense</h2>
        <form @submit.prevent="save">
          <select v-model="form.category"><option>utilities</option><option>maintenance</option><option>insurance</option><option>tax</option><option>other</option></select>
          <input v-model="form.description" placeholder="Description" required>
          <input v-model.number="form.amount" type="number" placeholder="Amount" required>
          <input v-model="form.expense_date" type="date" required>
          <input v-model="form.vendor" placeholder="Vendor">
          <button type="submit" class="btn-primary">Add</button>
        </form>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import axios from 'axios';
const expenses = ref([]); const showModal = ref(false);
const form = ref({ category: 'utilities', description: '', amount: 0, expense_date: '', vendor: '' });
onMounted(async () => { expenses.value = (await axios.get('/api/expenses')).data; });
const save = async () => { await axios.post('/api/expenses', form.value); expenses.value = (await axios.get('/api/expenses')).data; showModal.value = false; };
const del = async (id) => { if (confirm('Delete?')) { await axios.delete(`/api/expenses/${id}`); expenses.value = expenses.value.filter(e => e.id !== id); } };
</script>

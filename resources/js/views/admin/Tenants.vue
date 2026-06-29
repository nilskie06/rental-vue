<template>
  <div class="admin-page">
    <div class="page-header"><h1>Tenants</h1><button @click="showModal = true" class="btn-primary">+ Add Tenant</button></div>
    <table class="data-table">
      <thead><tr><th>Name</th><th>Email</th><th>Phone</th><th>Leases</th><th>Actions</th></tr></thead>
      <tbody>
        <tr v-for="t in tenants" :key="t.id">
          <td>{{ t.first_name }} {{ t.last_name }}</td><td>{{ t.email }}</td><td>{{ t.phone }}</td><td>{{ t.leases_count }}</td>
          <td><button @click="edit(t)">Edit</button><button @click="del(t.id)" class="btn-danger">Delete</button></td>
        </tr>
      </tbody>
    </table>
    <div class="modal" v-if="showModal" @click.self="showModal = false">
      <div class="modal-content">
        <h2>{{ form.id ? 'Edit' : 'Add' }} Tenant</h2>
        <form @submit.prevent="save">
          <input v-model="form.first_name" placeholder="First Name" required>
          <input v-model="form.last_name" placeholder="Last Name" required>
          <input v-model="form.email" type="email" placeholder="Email" required>
          <input v-model="form.phone" placeholder="Phone" required>
          <button type="submit" class="btn-primary">Save</button>
        </form>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import axios from 'axios';
const tenants = ref([]); const showModal = ref(false);
const form = ref({ first_name: '', last_name: '', email: '', phone: '' });
onMounted(async () => { tenants.value = (await axios.get('/api/tenants')).data; });
const edit = (t) => { form.value = { ...t }; showModal.value = true; };
const save = async () => {
  if (form.value.id) await axios.put(`/api/tenants/${form.value.id}`, form.value);
  else await axios.post('/api/tenants', form.value);
  tenants.value = (await axios.get('/api/tenants')).data; showModal.value = false;
};
const del = async (id) => { if (confirm('Delete?')) { await axios.delete(`/api/tenants/${id}`); tenants.value = tenants.value.filter(t => t.id !== id); } };
</script>

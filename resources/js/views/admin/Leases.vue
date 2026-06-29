<template>
  <div class="admin-page">
    <div class="page-header"><h1>Leases</h1><button @click="showModal = true" class="btn-primary">+ New Lease</button></div>
    <table class="data-table">
      <thead><tr><th>Tenant</th><th>Unit</th><th>Period</th><th>Rent</th><th>Status</th><th>Actions</th></tr></thead>
      <tbody>
        <tr v-for="l in leases" :key="l.id">
          <td>{{ l.tenant?.first_name }} {{ l.tenant?.last_name }}</td>
          <td>{{ l.unit?.unit_number }} - {{ l.unit?.building?.name }}</td>
          <td>{{ l.start_date }} → {{ l.end_date }}</td>
          <td>₱{{ l.monthly_rent?.toLocaleString() }}</td>
          <td><span class="badge" :class="l.status">{{ l.status }}</span></td>
          <td><button @click="edit(l)">Edit</button></td>
        </tr>
      </tbody>
    </table>
    <div class="modal" v-if="showModal" @click.self="showModal = false">
      <div class="modal-content">
        <h2>{{ form.id ? 'Edit' : 'New' }} Lease</h2>
        <form @submit.prevent="save">
          <select v-model="form.unit_id" required><option v-for="u in units" :key="u.id" :value="u.id">{{ u.unit_number }} - {{ u.building?.name }}</option></select>
          <select v-model="form.tenant_id" required><option v-for="t in tenants" :key="t.id" :value="t.id">{{ t.first_name }} {{ t.last_name }}</option></select>
          <input v-model="form.start_date" type="date" required>
          <input v-model="form.end_date" type="date" required>
          <input v-model.number="form.monthly_rent" type="number" placeholder="Monthly Rent" required>
          <button type="submit" class="btn-primary">Save</button>
        </form>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import axios from 'axios';
const leases = ref([]); const units = ref([]); const tenants = ref([]); const showModal = ref(false);
const form = ref({ unit_id: '', tenant_id: '', start_date: '', end_date: '', monthly_rent: 0 });
onMounted(async () => { leases.value = (await axios.get('/api/leases')).data; units.value = (await axios.get('/api/units')).data; tenants.value = (await axios.get('/api/tenants')).data; });
const edit = (l) => { form.value = { ...l }; showModal.value = true; };
const save = async () => {
  if (form.value.id) await axios.put(`/api/leases/${form.value.id}`, form.value);
  else await axios.post('/api/leases', form.value);
  leases.value = (await axios.get('/api/leases')).data; showModal.value = false;
};
</script>

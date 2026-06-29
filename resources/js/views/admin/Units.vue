<template>
  <div class="admin-page">
    <div class="page-header">
      <h1>Units</h1>
      <button @click="showModal = true" class="btn-primary">+ Add Unit</button>
    </div>
    <table class="data-table">
      <thead><tr><th>Unit</th><th>Building</th><th>Type</th><th>Bed/Bath</th><th>Rent</th><th>Status</th><th>Actions</th></tr></thead>
      <tbody>
        <tr v-for="u in units" :key="u.id">
          <td>{{ u.unit_number }}</td><td>{{ u.building?.name }}</td><td>{{ u.type }}</td>
          <td>{{ u.bedrooms }}/{{ u.bathrooms }}</td><td>₱{{ u.rent_amount?.toLocaleString() }}</td>
          <td><span class="badge" :class="u.status">{{ u.status }}</span></td>
          <td><button @click="edit(u)">Edit</button><button @click="del(u.id)" class="btn-danger">Delete</button></td>
        </tr>
      </tbody>
    </table>
    <div class="modal" v-if="showModal" @click.self="showModal = false">
      <div class="modal-content">
        <h2>{{ form.id ? 'Edit' : 'Add' }} Unit</h2>
        <form @submit.prevent="save">
          <select v-model="form.building_id" required><option v-for="b in buildings" :key="b.id" :value="b.id">{{ b.name }}</option></select>
          <input v-model="form.unit_number" placeholder="Unit Number" required>
          <select v-model="form.type"><option>apartment</option><option>studio</option><option>condo</option><option>house</option></select>
          <input v-model.number="form.bedrooms" type="number" placeholder="Bedrooms" required>
          <input v-model.number="form.bathrooms" type="number" placeholder="Bathrooms" required>
          <input v-model.number="form.rent_amount" type="number" placeholder="Monthly Rent" required>
          <button type="submit" class="btn-primary">Save</button>
        </form>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import axios from 'axios';
const units = ref([]); const buildings = ref([]); const showModal = ref(false);
const form = ref({ building_id: '', unit_number: '', type: 'apartment', bedrooms: 1, bathrooms: 1, rent_amount: 0 });
onMounted(async () => { units.value = (await axios.get('/api/units')).data; buildings.value = (await axios.get('/api/buildings')).data; });
const edit = (u) => { form.value = { ...u }; showModal.value = true; };
const save = async () => {
  if (form.value.id) await axios.put(`/api/units/${form.value.id}`, form.value);
  else await axios.post('/api/units', form.value);
  units.value = (await axios.get('/api/units')).data; showModal.value = false;
};
const del = async (id) => { if (confirm('Delete?')) { await axios.delete(`/api/units/${id}`); units.value = units.value.filter(u => u.id !== id); } };
</script>

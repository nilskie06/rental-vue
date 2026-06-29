<template>
  <div class="admin-page">
    <div class="page-header">
      <h1>Buildings</h1>
      <button @click="showModal = true" class="btn-primary">+ Add Building</button>
    </div>
    <table class="data-table">
      <thead><tr><th>Name</th><th>Address</th><th>City</th><th>Units</th><th>Actions</th></tr></thead>
      <tbody>
        <tr v-for="b in buildings" :key="b.id">
          <td>{{ b.name }}</td><td>{{ b.address }}</td><td>{{ b.city }}</td><td>{{ b.units_count }}</td>
          <td><button @click="edit(b)">Edit</button><button @click="del(b.id)" class="btn-danger">Delete</button></td>
        </tr>
      </tbody>
    </table>
    <div class="modal" v-if="showModal" @click.self="showModal = false">
      <div class="modal-content">
        <h2>{{ form.id ? 'Edit' : 'Add' }} Building</h2>
        <form @submit.prevent="save">
          <input v-model="form.name" placeholder="Name" required>
          <input v-model="form.address" placeholder="Address" required>
          <input v-model="form.city" placeholder="City" required>
          <input v-model="form.state" placeholder="State" required>
          <input v-model="form.zip" placeholder="Zip" required>
          <textarea v-model="form.description" placeholder="Description"></textarea>
          <button type="submit" class="btn-primary">Save</button>
        </form>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import axios from 'axios';
const buildings = ref([]); const showModal = ref(false);
const form = ref({ name: '', address: '', city: '', state: '', zip: '', description: '' });
onMounted(async () => { buildings.value = (await axios.get('/api/buildings')).data; });
const edit = (b) => { form.value = { ...b }; showModal.value = true; };
const save = async () => {
  if (form.value.id) await axios.put(`/api/buildings/${form.value.id}`, form.value);
  else await axios.post('/api/buildings', form.value);
  buildings.value = (await axios.get('/api/buildings')).data; showModal.value = false;
  form.value = { name: '', address: '', city: '', state: '', zip: '', description: '' };
};
const del = async (id) => { if (confirm('Delete?')) { await axios.delete(`/api/buildings/${id}`); buildings.value = buildings.value.filter(b => b.id !== id); } };
</script>

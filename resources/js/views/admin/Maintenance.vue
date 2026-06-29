<template>
  <div class="admin-page">
    <div class="page-header"><h1>Maintenance</h1><button @click="showModal = true" class="btn-primary">+ New Request</button></div>
    <table class="data-table">
      <thead><tr><th>Title</th><th>Unit</th><th>Priority</th><th>Status</th><th>Actions</th></tr></thead>
      <tbody>
        <tr v-for="m in maintenance" :key="m.id">
          <td>{{ m.title }}</td><td>{{ m.unit?.unit_number }}</td>
          <td><span class="badge" :class="m.priority">{{ m.priority }}</span></td>
          <td><span class="badge" :class="m.status">{{ m.status }}</span></td>
          <td><button @click="updateStatus(m, 'in_progress')">Start</button><button @click="updateStatus(m, 'completed')" class="btn-success">Complete</button></td>
        </tr>
      </tbody>
    </table>
    <div class="modal" v-if="showModal" @click.self="showModal = false">
      <div class="modal-content">
        <h2>New Maintenance Request</h2>
        <form @submit.prevent="save">
          <select v-model="form.unit_id" required><option v-for="u in units" :key="u.id" :value="u.id">{{ u.unit_number }}</option></select>
          <input v-model="form.title" placeholder="Title" required>
          <textarea v-model="form.description" placeholder="Description" required></textarea>
          <select v-model="form.priority"><option>low</option><option>medium</option><option>high</option><option>urgent</option></select>
          <button type="submit" class="btn-primary">Create</button>
        </form>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import axios from 'axios';
const maintenance = ref([]); const units = ref([]); const showModal = ref(false);
const form = ref({ unit_id: '', title: '', description: '', priority: 'medium' });
onMounted(async () => { maintenance.value = (await axios.get('/api/maintenance')).data; units.value = (await axios.get('/api/units')).data; });
const save = async () => { await axios.post('/api/maintenance', form.value); maintenance.value = (await axios.get('/api/maintenance')).data; showModal.value = false; };
const updateStatus = async (m, status) => { await axios.put(`/api/maintenance/${m.id}`, { status }); m.status = status; };
</script>

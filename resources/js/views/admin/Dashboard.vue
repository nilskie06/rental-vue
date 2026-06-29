<template>
  <div class="dashboard">
    <h1>Dashboard</h1>
    <div class="stats-grid" v-if="stats">
      <div class="stat-card"><div class="stat-number">{{ stats.total_buildings }}</div><div class="stat-label">Buildings</div></div>
      <div class="stat-card"><div class="stat-number">{{ stats.total_units }}</div><div class="stat-label">Total Units</div></div>
      <div class="stat-card green"><div class="stat-number">{{ stats.occupied_units }}</div><div class="stat-label">Occupied</div></div>
      <div class="stat-card orange"><div class="stat-number">{{ stats.vacant_units }}</div><div class="stat-label">Vacant</div></div>
      <div class="stat-card"><div class="stat-number">{{ stats.total_tenants }}</div><div class="stat-label">Tenants</div></div>
      <div class="stat-card"><div class="stat-number">{{ stats.active_leases }}</div><div class="stat-label">Active Leases</div></div>
      <div class="stat-card green"><div class="stat-number">₱{{ stats.total_revenue?.toLocaleString() }}</div><div class="stat-label">Revenue</div></div>
      <div class="stat-card red"><div class="stat-number">{{ stats.overdue_invoices }}</div><div class="stat-label">Overdue</div></div>
    </div>
    <div class="dashboard-grid">
      <div class="dashboard-card">
        <h3>Recent Payments</h3>
        <div class="list" v-for="p in payments" :key="p.id">
          <span>{{ p.tenant?.first_name }} {{ p.tenant?.last_name }}</span>
          <span>₱{{ p.amount?.toLocaleString() }}</span>
          <span>{{ p.payment_date }}</span>
        </div>
      </div>
      <div class="dashboard-card">
        <h3>Maintenance Requests</h3>
        <div class="list" v-for="m in maintenance" :key="m.id">
          <span>{{ m.title }}</span>
          <span class="badge" :class="m.priority">{{ m.priority }}</span>
          <span class="badge" :class="m.status">{{ m.status }}</span>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import axios from 'axios';
const stats = ref(null); const payments = ref([]); const maintenance = ref([]);
onMounted(async () => {
  const { data } = await axios.get('/api/dashboard');
  stats.value = data.stats; payments.value = data.recent_payments; maintenance.value = data.recent_maintenance;
});
</script>

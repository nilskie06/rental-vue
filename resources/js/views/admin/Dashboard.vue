<template>
  <div class="max-w-7xl mx-auto px-4 lg:px-8 py-10">
    <h1 class="text-2xl font-extrabold text-slate-900 mb-8">Dashboard</h1>
    <div v-if="stats" class="grid grid-cols-2 sm:grid-cols-4 gap-4 mb-8">
      <div class="bg-white rounded-2xl border border-slate-200 p-5">
        <div class="text-3xl font-extrabold text-indigo-600">{{ stats.total_buildings }}</div>
        <div class="text-sm text-slate-500 mt-1">Buildings</div>
      </div>
      <div class="bg-white rounded-2xl border border-slate-200 p-5">
        <div class="text-3xl font-extrabold text-slate-900">{{ stats.total_units }}</div>
        <div class="text-sm text-slate-500 mt-1">Total Units</div>
      </div>
      <div class="bg-white rounded-2xl border border-slate-200 p-5">
        <div class="text-3xl font-extrabold text-emerald-600">{{ stats.occupied_units }}</div>
        <div class="text-sm text-slate-500 mt-1">Occupied</div>
      </div>
      <div class="bg-white rounded-2xl border border-slate-200 p-5">
        <div class="text-3xl font-extrabold text-amber-600">{{ stats.vacant_units }}</div>
        <div class="text-sm text-slate-500 mt-1">Vacant</div>
      </div>
      <div class="bg-white rounded-2xl border border-slate-200 p-5">
        <div class="text-3xl font-extrabold text-slate-900">{{ stats.total_tenants }}</div>
        <div class="text-sm text-slate-500 mt-1">Tenants</div>
      </div>
      <div class="bg-white rounded-2xl border border-slate-200 p-5">
        <div class="text-3xl font-extrabold text-indigo-600">{{ stats.active_leases }}</div>
        <div class="text-sm text-slate-500 mt-1">Active Leases</div>
      </div>
      <div class="bg-white rounded-2xl border border-slate-200 p-5">
        <div class="text-3xl font-extrabold text-emerald-600">₱{{ stats.total_revenue?.toLocaleString() }}</div>
        <div class="text-sm text-slate-500 mt-1">Revenue</div>
      </div>
      <div class="bg-white rounded-2xl border border-slate-200 p-5">
        <div class="text-3xl font-extrabold text-red-600">{{ stats.overdue_invoices }}</div>
        <div class="text-sm text-slate-500 mt-1">Overdue</div>
      </div>
    </div>
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
      <div class="bg-white rounded-2xl border border-slate-200 p-6">
        <h3 class="font-bold text-slate-900 mb-4">Recent Payments</h3>
        <div v-for="p in payments" :key="p.id" class="flex items-center justify-between py-3 border-b border-slate-100 last:border-0">
          <div>
            <div class="text-sm font-medium text-slate-900">{{ p.tenant?.first_name }} {{ p.tenant?.last_name }}</div>
            <div class="text-xs text-slate-500">{{ p.payment_date }}</div>
          </div>
          <div class="text-sm font-bold text-emerald-600">₱{{ p.amount?.toLocaleString() }}</div>
        </div>
        <p v-if="!payments.length" class="text-sm text-slate-400 text-center py-4">No payments yet</p>
      </div>
      <div class="bg-white rounded-2xl border border-slate-200 p-6">
        <h3 class="font-bold text-slate-900 mb-4">Maintenance Requests</h3>
        <div v-for="m in maintenance" :key="m.id" class="flex items-center justify-between py-3 border-b border-slate-100 last:border-0">
          <div>
            <div class="text-sm font-medium text-slate-900">{{ m.title }}</div>
            <div class="text-xs text-slate-500">{{ m.unit?.unit_number }}</div>
          </div>
          <div class="flex gap-2">
            <span class="text-xs font-semibold px-2 py-0.5 rounded-full" :class="{'bg-red-50 text-red-700': m.priority==='urgent'||m.priority==='high', 'bg-amber-50 text-amber-700': m.priority==='medium', 'bg-slate-100 text-slate-600': m.priority==='low'}">{{ m.priority }}</span>
            <span class="text-xs font-semibold px-2 py-0.5 rounded-full" :class="{'bg-emerald-50 text-emerald-700': m.status==='completed', 'bg-amber-50 text-amber-700': m.status==='pending', 'bg-blue-50 text-blue-700': m.status==='in_progress'}">{{ m.status }}</span>
          </div>
        </div>
        <p v-if="!maintenance.length" class="text-sm text-slate-400 text-center py-4">No requests</p>
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

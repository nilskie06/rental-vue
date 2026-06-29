<template>
  <div class="browse">
    <h1>Browse Available Units</h1>
    <div class="filters">
      <select v-model="filterType"><option value="">All Types</option><option>apartment</option><option>studio</option><option>condo</option><option>house</option></select>
      <select v-model="filterStatus"><option value="">All Status</option><option>vacant</option><option>occupied</option></select>
      <input v-model="search" placeholder="Search units...">
    </div>
    <div class="unit-grid">
      <div class="unit-card" v-for="unit in filtered" :key="unit.id" @click="$router.push(`/browse/${unit.id}`)">
        <div class="unit-image">🏠</div>
        <div class="unit-info">
          <h3>{{ unit.unit_number }}</h3>
          <p>{{ unit.building?.name }} · {{ unit.type }}</p>
          <p>{{ unit.bedrooms }} bed · {{ unit.bathrooms }} bath · {{ unit.sqft }} sqft</p>
          <div class="unit-price">₱{{ unit.rent_amount?.toLocaleString() }}/mo</div>
          <span class="status" :class="unit.status">{{ unit.status }}</span>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, computed, onMounted } from 'vue';
import axios from 'axios';
const units = ref([]);
const search = ref('');
const filterType = ref('');
const filterStatus = ref('');
onMounted(async () => { units.value = (await axios.get('/api/public/units')).data; });
const filtered = computed(() => units.value.filter(u => {
  if (filterType.value && u.type !== filterType.value) return false;
  if (filterStatus.value && u.status !== filterStatus.value) return false;
  if (search.value && !u.unit_number.toLowerCase().includes(search.value.toLowerCase())) return false;
  return true;
}));
</script>

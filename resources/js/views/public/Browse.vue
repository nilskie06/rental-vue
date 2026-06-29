<template>
  <div class="max-w-7xl mx-auto px-4 lg:px-8 py-10">
    <div class="flex flex-wrap items-center gap-3 mb-8">
      <div class="relative flex-1 min-w-[200px]">
        <svg class="absolute left-3 top-1/2 -translate-y-1/2 h-4 w-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
        <input v-model="search" type="text" placeholder="Search by unit, building..." class="w-full pl-10 pr-4 py-2.5 rounded-xl border border-slate-200 bg-white text-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none">
      </div>
      <select v-model="filterType" class="px-3 py-2.5 rounded-xl border border-slate-200 bg-white text-sm text-slate-600 focus:ring-2 focus:ring-indigo-500 outline-none">
        <option value="">All Types</option>
        <option v-for="t in types" :key="t">{{ t }}</option>
      </select>
      <select v-model="filterStatus" class="px-3 py-2.5 rounded-xl border border-slate-200 bg-white text-sm text-slate-600 focus:ring-2 focus:ring-indigo-500 outline-none">
        <option value="">All Status</option>
        <option>vacant</option><option>occupied</option>
      </select>
    </div>
    <p class="text-sm text-slate-500 mb-4">{{ filtered.length }} units found</p>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
      <div v-for="unit in filtered" :key="unit.id" class="bg-white rounded-2xl border border-slate-200 overflow-hidden hover:shadow-lg transition group cursor-pointer" @click="$router.push(`/browse/${unit.id}`)">
        <div class="h-48 bg-gradient-to-br from-indigo-100 to-slate-100 flex items-center justify-center">
          <img v-if="unit.photos && unit.photos[0]" :src="'/storage/' + unit.photos[0]" class="h-full w-full object-cover" :alt="unit.unit_number">
          <span v-else class="text-4xl">🏠</span>
        </div>
        <div class="p-5">
          <div class="flex items-center justify-between mb-2">
            <h3 class="font-bold text-slate-900 group-hover:text-indigo-700 transition">{{ unit.unit_number }}</h3>
            <span class="text-xs font-semibold px-2 py-0.5 rounded-full" :class="unit.status === 'vacant' ? 'bg-emerald-50 text-emerald-700' : 'bg-amber-50 text-amber-700'">{{ unit.status }}</span>
          </div>
          <p class="text-sm text-slate-500 mb-1">{{ unit.building?.name }} · {{ unit.type }}</p>
          <p class="text-sm text-slate-500 mb-3">{{ unit.bedrooms }} bed · {{ unit.bathrooms }} bath</p>
          <div class="flex items-center justify-between">
            <span class="text-lg font-bold text-indigo-600">₱{{ Number(unit.monthly_rent_default).toLocaleString() }}<span class="text-sm font-normal text-slate-400">/mo</span></span>
            <button @click.stop="toggleSaved(unit.id)" class="p-2 rounded-lg hover:bg-rose-50 transition">
              <svg class="h-5 w-5" :class="isSaved(unit.id) ? 'text-rose-500 fill-rose-500' : 'text-slate-300'" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, computed, onMounted } from 'vue';
import axios from 'axios';
const units = ref([]); const search = ref(''); const filterType = ref(''); const filterStatus = ref('');
const favorites = ref(JSON.parse(localStorage.getItem('rental_favorites') || '[]'));
const types = ref([]);
onMounted(async () => {
  const { data } = await axios.get('/api/public/units');
  units.value = data;
  types.value = [...new Set(data.map(u => u.type))];
});
const filtered = computed(() => units.value.filter(u => {
  if (filterType.value && u.type !== filterType.value) return false;
  if (filterStatus.value && u.status !== filterStatus.value) return false;
  if (search.value) { const q = search.value.toLowerCase(); if (!(`${u.unit_number} ${u.building?.name} ${u.type}`).toLowerCase().includes(q)) return false; }
  return true;
}));
const isSaved = (id) => favorites.value.includes(id);
const toggleSaved = (id) => {
  if (isSaved(id)) favorites.value = favorites.value.filter(i => i !== id);
  else favorites.value.push(id);
  localStorage.setItem('rental_favorites', JSON.stringify(favorites.value));
};
</script>

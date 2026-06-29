<template>
  <div>
    <!-- Hero Section -->
    <section class="relative overflow-hidden bg-gradient-to-br from-indigo-600 via-violet-700 to-slate-900 text-white">
      <div class="absolute top-0 right-0 w-[32rem] h-[32rem] bg-gradient-to-br from-fuchsia-400/30 to-indigo-400/0 rounded-full blur-3xl -translate-y-1/3 translate-x-1/3 pointer-events-none"></div>
      <div class="absolute bottom-0 left-0 w-[28rem] h-[28rem] bg-gradient-to-tr from-sky-400/25 to-indigo-500/0 rounded-full blur-3xl translate-y-1/3 -translate-x-1/3 pointer-events-none"></div>
      <svg class="absolute inset-0 w-full h-full opacity-[0.04] pointer-events-none" xmlns="http://www.w3.org/2000/svg">
        <defs><pattern id="hm-grid" width="40" height="40" patternUnits="userSpaceOnUse"><path d="M 40 0 L 0 0 0 40" fill="none" stroke="white" stroke-width="1"/></pattern></defs>
        <rect width="100%" height="100%" fill="url(#hm-grid)"/>
      </svg>
      <div class="relative max-w-7xl mx-auto px-4 lg:px-8 py-20 lg:py-28">
        <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-white/10 border border-white/15 text-xs font-medium text-indigo-100 mb-6">
          <span class="inline-block h-2 w-2 rounded-full bg-emerald-400 animate-pulse"></span>
          {{ availableCount }} units available now
        </div>
        <h1 class="text-4xl lg:text-6xl font-extrabold leading-[1.05] tracking-tight max-w-3xl">
          Your perfect home,
          <span class="bg-gradient-to-r from-fuchsia-200 via-white to-sky-200 bg-clip-text text-transparent">just a click away.</span>
        </h1>
        <p class="text-indigo-100/80 mt-6 max-w-xl text-lg leading-relaxed">
          Browse curated rental properties, schedule visits, and manage your lease — all in one beautiful platform.
        </p>
        <div class="mt-9 flex flex-wrap gap-3">
          <router-link to="/browse" class="inline-flex items-center gap-2 px-6 py-3.5 rounded-xl bg-white text-indigo-700 text-sm font-bold shadow-xl shadow-indigo-950/30 hover:bg-indigo-50 transition">
            Browse Units
            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
          </router-link>
          <router-link to="/browse" class="inline-flex items-center gap-2 px-6 py-3.5 rounded-xl bg-white/10 backdrop-blur border border-white/20 text-white text-sm font-bold hover:bg-white/15 transition">
            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"/></svg>
            View on Map
          </router-link>
        </div>
      </div>
    </section>

    <!-- Features Section -->
    <section class="max-w-7xl mx-auto px-4 lg:px-8 py-16">
      <div class="text-center max-w-2xl mx-auto mb-12">
        <h2 class="text-3xl font-extrabold text-slate-900 tracking-tight">Renting made simple</h2>
        <p class="text-slate-500 mt-3">From browsing to move-in, every step is online.</p>
      </div>
      <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
        <div class="relative bg-white rounded-2xl border border-slate-200 p-7 hover:shadow-lg transition">
          <div class="absolute -top-3 -left-3 h-8 w-8 rounded-full bg-indigo-600 text-white text-sm font-bold flex items-center justify-center shadow-md">1</div>
          <span class="inline-flex h-11 w-11 items-center justify-center rounded-xl bg-indigo-50 text-indigo-600 mb-4">
            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
          </span>
          <h3 class="font-bold text-slate-900">Browse & shortlist</h3>
          <p class="text-sm text-slate-600 mt-1.5 leading-relaxed">Filter by location, budget, and bedrooms. Save your favorites for easy comparison.</p>
        </div>
        <div class="relative bg-white rounded-2xl border border-slate-200 p-7 hover:shadow-lg transition">
          <div class="absolute -top-3 -left-3 h-8 w-8 rounded-full bg-indigo-600 text-white text-sm font-bold flex items-center justify-center shadow-md">2</div>
          <span class="inline-flex h-11 w-11 items-center justify-center rounded-xl bg-indigo-50 text-indigo-600 mb-4">
            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
          </span>
          <h3 class="font-bold text-slate-900">Schedule a visit</h3>
          <p class="text-sm text-slate-600 mt-1.5 leading-relaxed">Pick a time that works for you. Our team will confirm and prepare the unit.</p>
        </div>
        <div class="relative bg-white rounded-2xl border border-slate-200 p-7 hover:shadow-lg transition">
          <div class="absolute -top-3 -left-3 h-8 w-8 rounded-full bg-indigo-600 text-white text-sm font-bold flex items-center justify-center shadow-md">3</div>
          <span class="inline-flex h-11 w-11 items-center justify-center rounded-xl bg-indigo-50 text-indigo-600 mb-4">
            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
          </span>
          <h3 class="font-bold text-slate-900">Move in & manage</h3>
          <p class="text-sm text-slate-600 mt-1.5 leading-relaxed">Sign your lease online, pay rent, and submit maintenance requests from your dashboard.</p>
        </div>
      </div>
    </section>

    <!-- Featured Units -->
    <section class="max-w-7xl mx-auto px-4 lg:px-8 pb-16">
      <div class="flex items-center justify-between mb-8">
        <h2 class="text-2xl font-extrabold text-slate-900 tracking-tight">Available Units</h2>
        <router-link to="/browse" class="text-sm font-semibold text-indigo-600 hover:text-indigo-700">View all →</router-link>
      </div>
      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        <div v-for="unit in units.slice(0, 6)" :key="unit.id" class="bg-white rounded-2xl border border-slate-200 overflow-hidden hover:shadow-lg transition group cursor-pointer" @click="$router.push(`/browse/${unit.id}`)">
          <div class="h-48 bg-gradient-to-br from-indigo-100 to-slate-100 flex items-center justify-center text-4xl">
            🏠
          </div>
          <div class="p-5">
            <div class="flex items-center justify-between mb-2">
              <h3 class="font-bold text-slate-900 group-hover:text-indigo-700 transition">{{ unit.unit_number }}</h3>
              <span class="text-xs font-semibold px-2 py-0.5 rounded-full" :class="unit.status === 'vacant' ? 'bg-emerald-50 text-emerald-700' : 'bg-amber-50 text-amber-700'">{{ unit.status }}</span>
            </div>
            <p class="text-sm text-slate-500 mb-1">{{ unit.building?.name }} · {{ unit.type }}</p>
            <p class="text-sm text-slate-500 mb-3">{{ unit.bedrooms }} bed · {{ unit.bathrooms }} bath · {{ unit.sqft }} sqft</p>
            <div class="flex items-center justify-between">
              <span class="text-lg font-bold text-indigo-600">₱{{ unit.rent_amount?.toLocaleString() }}<span class="text-sm font-normal text-slate-400">/mo</span></span>
              <span class="text-xs text-slate-400">per month</span>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import axios from 'axios';
const units = ref([]);
const availableCount = ref(0);
onMounted(async () => {
  const { data } = await axios.get('/api/public/units');
  units.value = data;
  availableCount.value = data.filter(u => u.status === 'vacant').length;
});
</script>

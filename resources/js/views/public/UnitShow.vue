<template>
  <div v-if="unit" class="max-w-7xl mx-auto px-4 lg:px-8 py-10">
    <button @click="$router.back()" class="inline-flex items-center gap-1 text-sm text-slate-500 hover:text-indigo-600 mb-6 transition">← Back to listings</button>
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
      <div class="lg:col-span-2">
        <div class="bg-white rounded-2xl border border-slate-200 overflow-hidden">
          <div class="h-72 bg-gradient-to-br from-indigo-100 to-slate-100 flex items-center justify-center">
            <img v-if="unit.photos && unit.photos[0]" :src="'/storage/' + unit.photos[0]" class="h-full w-full object-cover" :alt="unit.unit_number">
            <span v-else class="text-6xl">🏠</span>
          </div>
          <div class="p-6">
            <div class="flex items-center justify-between mb-3">
              <h1 class="text-2xl font-extrabold text-slate-900">{{ unit.unit_number }}</h1>
              <span class="text-xs font-semibold px-3 py-1 rounded-full" :class="unit.status === 'vacant' ? 'bg-emerald-50 text-emerald-700' : 'bg-amber-50 text-amber-700'">{{ unit.status }}</span>
            </div>
            <p class="text-slate-500 mb-4">{{ unit.building?.name }} · {{ unit.building?.address }}</p>
            <div class="flex flex-wrap gap-3 mb-6">
              <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-slate-50 border border-slate-200 text-sm text-slate-600">🛏️ {{ unit.bedrooms }} Bedrooms</span>
              <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-slate-50 border border-slate-200 text-sm text-slate-600">🚿 {{ unit.bathrooms }} Bathrooms</span>
              <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-slate-50 border border-slate-200 text-sm text-slate-600">🏠 {{ unit.type }}</span>
            </div>
            <div v-if="unit.amenities && unit.amenities.length" class="mb-4">
              <h4 class="font-semibold text-slate-900 text-sm mb-2">Amenities</h4>
              <div class="flex flex-wrap gap-2">
                <span v-for="a in unit.amenities" :key="a" class="text-xs px-2 py-1 bg-indigo-50 text-indigo-700 rounded-full">{{ a }}</span>
              </div>
            </div>
            <div v-if="unit.description" class="text-slate-600 leading-relaxed mt-4">{{ unit.description }}</div>
          </div>
        </div>
      </div>
      <div class="lg:col-span-1">
        <div class="bg-white rounded-2xl border border-slate-200 p-6 sticky top-24">
          <div class="text-3xl font-extrabold text-indigo-600 mb-1">₱{{ Number(unit.monthly_rent_default).toLocaleString() }}<span class="text-base font-normal text-slate-400">/mo</span></div>
          <p class="text-sm text-slate-500 mb-6">Security deposit: ₱{{ Number(unit.security_deposit_default).toLocaleString() || 'TBD' }}</p>
          <button class="w-full py-3 rounded-xl bg-indigo-600 hover:bg-indigo-700 text-white font-semibold text-sm shadow-sm transition mb-3">Schedule a Visit</button>
          <button class="w-full py-3 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 font-semibold text-sm transition">Contact Us</button>
          <div class="mt-6 pt-6 border-t border-slate-200">
            <h4 class="font-semibold text-slate-900 text-sm mb-3">Property Details</h4>
            <div class="space-y-2 text-sm">
              <div class="flex justify-between"><span class="text-slate-500">Type</span><span class="font-medium">{{ unit.type }}</span></div>
              <div class="flex justify-between"><span class="text-slate-500">Floor</span><span class="font-medium">{{ unit.floor || 'N/A' }}</span></div>
              <div class="flex justify-between"><span class="text-slate-500">Building</span><span class="font-medium">{{ unit.building?.name }}</span></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import { useRoute } from 'vue-router';
import axios from 'axios';
const route = useRoute();
const unit = ref(null);
onMounted(async () => { unit.value = (await axios.get(`/api/public/units/${route.params.id}`)).data; });
</script>

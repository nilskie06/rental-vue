<template>
  <div>
    <!-- Header -->
    <header class="bg-white border-b border-slate-200 sticky top-0 z-30 backdrop-blur-md bg-white/80">
      <div class="max-w-7xl mx-auto px-4 lg:px-8 h-16 flex items-center justify-between">
        <a href="/" class="flex items-center gap-3 group">
          <div class="h-9 w-9 rounded-xl flex items-center justify-center bg-gradient-to-br from-indigo-500 to-indigo-700 text-white shadow-sm shadow-indigo-600/30 text-sm font-bold">E</div>
          <div>
            <div class="text-base font-bold leading-tight text-slate-900 group-hover:text-indigo-700 transition">EMY</div>
            <div class="text-[10px] text-slate-500 uppercase tracking-[0.18em]">Available units</div>
          </div>
        </a>
        <nav class="flex items-center gap-1 sm:gap-3">
          <router-link to="/browse" class="hidden sm:inline px-2 text-sm font-medium text-slate-600 hover:text-indigo-700 transition">Browse</router-link>
          <router-link to="/saved" class="relative inline-flex items-center gap-1.5 px-2.5 py-2 rounded-lg text-sm font-medium text-slate-600 hover:text-rose-600 transition">
            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
            <span class="hidden sm:inline">Saved</span>
            <span v-if="savedCount > 0" class="inline-flex items-center justify-center min-w-[1.1rem] h-[1.1rem] px-1 rounded-full bg-rose-500 text-white text-[10px] font-bold">{{ savedCount }}</span>
          </router-link>
          <router-link v-if="!auth.isAuthenticated" to="/login" class="inline-flex items-center gap-1.5 px-3.5 py-2 rounded-lg bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-semibold shadow-sm transition">Sign in</router-link>
          <div v-else class="flex items-center gap-2">
            <router-link to="/dashboard" class="text-sm font-medium text-slate-600 hover:text-indigo-700">Dashboard</router-link>
            <button @click="logout" class="text-sm text-slate-500 hover:text-red-600">Logout</button>
          </div>
        </nav>
      </div>
    </header>
    <main class="flex-1"><router-view /></main>
  </div>
</template>

<script setup>
import { computed } from 'vue';
import { useAuthStore } from './stores/auth';
import { useRouter } from 'vue-router';
const auth = useAuthStore();
const router = useRouter();
const savedCount = computed(() => JSON.parse(localStorage.getItem('rental_favorites') || '[]').length);
const logout = async () => { await auth.logout(); router.push('/'); };
</script>

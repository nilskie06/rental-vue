<template>
  <div class="min-h-[80vh] flex items-center justify-center px-4">
    <div class="w-full max-w-md">
      <div class="text-center mb-8">
        <div class="h-12 w-12 rounded-2xl flex items-center justify-center bg-gradient-to-br from-indigo-500 to-indigo-700 text-white shadow-lg shadow-indigo-600/30 text-xl font-bold mx-auto mb-4">E</div>
        <h1 class="text-2xl font-extrabold text-slate-900">Create account</h1>
        <p class="text-slate-500 mt-1">Join EMY to find your perfect home</p>
      </div>
      <div class="bg-white rounded-2xl border border-slate-200 p-8 shadow-sm">
        <form @submit.prevent="handleRegister">
          <div class="mb-4">
            <label class="block text-sm font-medium text-slate-700 mb-1.5">Full Name</label>
            <input v-model="name" type="text" required class="w-full px-4 py-2.5 rounded-xl border border-slate-200 bg-slate-50 text-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition" placeholder="Juan Dela Cruz">
          </div>
          <div class="mb-4">
            <label class="block text-sm font-medium text-slate-700 mb-1.5">Email</label>
            <input v-model="email" type="email" required class="w-full px-4 py-2.5 rounded-xl border border-slate-200 bg-slate-50 text-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition" placeholder="you@example.com">
          </div>
          <div class="mb-4">
            <label class="block text-sm font-medium text-slate-700 mb-1.5">Password</label>
            <input v-model="password" type="password" required class="w-full px-4 py-2.5 rounded-xl border border-slate-200 bg-slate-50 text-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition" placeholder="Min 8 characters">
          </div>
          <div class="mb-6">
            <label class="block text-sm font-medium text-slate-700 mb-1.5">Confirm Password</label>
            <input v-model="password_confirmation" type="password" required class="w-full px-4 py-2.5 rounded-xl border border-slate-200 bg-slate-50 text-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition" placeholder="••••••••">
          </div>
          <p v-if="error" class="text-sm text-red-600 mb-4">{{ error }}</p>
          <button type="submit" class="w-full py-3 rounded-xl bg-indigo-600 hover:bg-indigo-700 text-white font-semibold text-sm shadow-sm transition" :disabled="loading">
            {{ loading ? 'Creating...' : 'Create account' }}
          </button>
        </form>
        <div class="mt-6 text-center text-sm text-slate-500">
          Already have an account? <router-link to="/login" class="font-semibold text-indigo-600 hover:text-indigo-700">Sign in</router-link>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue';
import { useRouter } from 'vue-router';
import { useAuthStore } from '../../stores/auth';
const name = ref(''); const email = ref(''); const password = ref(''); const password_confirmation = ref('');
const error = ref(''); const loading = ref(false);
const auth = useAuthStore(); const router = useRouter();
const handleRegister = async () => {
  loading.value = true; error.value = '';
  try { await auth.register(name.value, email.value, password.value); router.push('/dashboard'); }
  catch (e) { error.value = e.response?.data?.message || 'Registration failed'; }
  finally { loading.value = false; }
};
</script>

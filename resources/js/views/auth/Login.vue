<template>
  <div class="auth-page">
    <div class="auth-card">
      <h1>Login</h1>
      <form @submit.prevent="handleLogin">
        <input v-model="email" type="email" placeholder="Email" required>
        <input v-model="password" type="password" placeholder="Password" required>
        <button type="submit" class="btn-primary">Login</button>
        <p v-if="error" class="error">{{ error }}</p>
      </form>
      <p>Don't have an account? <router-link to="/register">Register</router-link></p>
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue';
import { useRouter } from 'vue-router';
import { useAuthStore } from '../../stores/auth';
const email = ref(''); const password = ref(''); const error = ref('');
const auth = useAuthStore(); const router = useRouter();
const handleLogin = async () => {
  try { const user = await auth.login(email.value, password.value); router.push(user.role === 'tenant' ? '/dashboard' : '/dashboard'); }
  catch (e) { error.value = e.response?.data?.message || 'Login failed'; }
};
</script>

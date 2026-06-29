<template>
  <div class="auth-page">
    <div class="auth-card">
      <h1>Register</h1>
      <form @submit.prevent="handleRegister">
        <input v-model="name" type="text" placeholder="Full Name" required>
        <input v-model="email" type="email" placeholder="Email" required>
        <input v-model="password" type="password" placeholder="Password" required>
        <input v-model="password_confirmation" type="password" placeholder="Confirm Password" required>
        <button type="submit" class="btn-primary">Register</button>
        <p v-if="error" class="error">{{ error }}</p>
      </form>
      <p>Already have an account? <router-link to="/login">Login</router-link></p>
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue';
import { useRouter } from 'vue-router';
import { useAuthStore } from '../../stores/auth';
const name = ref(''); const email = ref(''); const password = ref(''); const password_confirmation = ref(''); const error = ref('');
const auth = useAuthStore(); const router = useRouter();
const handleRegister = async () => {
  try { await auth.register(name.value, email.value, password.value); router.push('/dashboard'); }
  catch (e) { error.value = e.response?.data?.message || 'Registration failed'; }
};
</script>

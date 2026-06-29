<template>
  <div id="rental-app">
    <nav class="navbar" v-if="auth.isAuthenticated">
      <div class="nav-brand">🏠 Rental Manager</div>
      <div class="nav-links">
        <router-link to="/dashboard">Dashboard</router-link>
        <router-link to="/admin/buildings">Buildings</router-link>
        <router-link to="/admin/units">Units</router-link>
        <router-link to="/admin/tenants">Tenants</router-link>
        <router-link to="/admin/leases">Leases</router-link>
        <router-link to="/admin/invoices">Invoices</router-link>
        <router-link to="/admin/payments">Payments</router-link>
        <router-link to="/admin/maintenance">Maintenance</router-link>
        <router-link to="/admin/expenses">Expenses</router-link>
      </div>
      <div class="nav-user">
        <span>{{ auth.user?.name }}</span>
        <button @click="handleLogout">Logout</button>
      </div>
    </nav>
    <nav class="navbar" v-else>
      <div class="nav-brand">🏠 Rental Manager</div>
      <div class="nav-links">
        <router-link to="/">Home</router-link>
        <router-link to="/browse">Browse Units</router-link>
      </div>
      <div class="nav-user">
        <router-link to="/login" class="btn-login">Login</router-link>
        <router-link to="/register" class="btn-register">Register</router-link>
      </div>
    </nav>
    <main class="main-content">
      <router-view />
    </main>
  </div>
</template>

<script setup>
import { useAuthStore } from './stores/auth';
import { useRouter } from 'vue-router';
const auth = useAuthStore();
const router = useRouter();
const handleLogout = async () => { await auth.logout(); router.push('/login'); };
</script>

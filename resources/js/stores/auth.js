import { defineStore } from 'pinia';
import { ref, computed } from 'vue';
import axios from 'axios';

export const useAuthStore = defineStore('auth', () => {
  const user = ref(JSON.parse(localStorage.getItem('user') || 'null'));
  const token = ref(localStorage.getItem('token') || '');

  const isAuthenticated = computed(() => !!token.value);
  const isAdmin = computed(() => user.value?.role === 'owner' || user.value?.role === 'staff');

  axios.defaults.headers.common['Authorization'] = token.value ? `Bearer ${token.value}` : '';

  async function login(email, password) {
    const { data } = await axios.post('/api/login', { email, password });
    user.value = data.user;
    token.value = data.token;
    localStorage.setItem('user', JSON.stringify(data.user));
    localStorage.setItem('token', data.token);
    axios.defaults.headers.common['Authorization'] = `Bearer ${data.token}`;
    return data.user;
  }

  async function register(name, email, password) {
    const { data } = await axios.post('/api/register', { name, email, password, password_confirmation: password });
    user.value = data.user;
    token.value = data.token;
    localStorage.setItem('user', JSON.stringify(data.user));
    localStorage.setItem('token', data.token);
    axios.defaults.headers.common['Authorization'] = `Bearer ${data.token}`;
    return data.user;
  }

  async function logout() {
    await axios.post('/api/logout').catch(() => {});
    user.value = null;
    token.value = '';
    localStorage.removeItem('user');
    localStorage.removeItem('token');
    delete axios.defaults.headers.common['Authorization'];
  }

  return { user, token, isAuthenticated, isAdmin, login, register, logout };
});

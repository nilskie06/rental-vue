import { createRouter, createWebHistory } from 'vue-router';
import { useAuthStore } from '../stores/auth';

const routes = [
  // Public
  { path: '/', name: 'home', component: () => import('../views/public/Home.vue') },
  { path: '/browse', name: 'browse', component: () => import('../views/public/Browse.vue') },
  { path: '/browse/:id', name: 'unit.show', component: () => import('../views/public/UnitShow.vue') },
  { path: '/login', name: 'login', component: () => import('../views/auth/Login.vue') },
  { path: '/register', name: 'register', component: () => import('../views/auth/Register.vue') },

  // Admin
  { path: '/dashboard', name: 'dashboard', component: () => import('../views/admin/Dashboard.vue'), meta: { requiresAuth: true, role: 'admin' } },
  { path: '/admin/buildings', name: 'admin.buildings', component: () => import('../views/admin/Buildings.vue'), meta: { requiresAuth: true, role: 'admin' } },
  { path: '/admin/units', name: 'admin.units', component: () => import('../views/admin/Units.vue'), meta: { requiresAuth: true, role: 'admin' } },
  { path: '/admin/tenants', name: 'admin.tenants', component: () => import('../views/admin/Tenants.vue'), meta: { requiresAuth: true, role: 'admin' } },
  { path: '/admin/leases', name: 'admin.leases', component: () => import('../views/admin/Leases.vue'), meta: { requiresAuth: true, role: 'admin' } },
  { path: '/admin/invoices', name: 'admin.invoices', component: () => import('../views/admin/Invoices.vue'), meta: { requiresAuth: true, role: 'admin' } },
  { path: '/admin/payments', name: 'admin.payments', component: () => import('../views/admin/Payments.vue'), meta: { requiresAuth: true, role: 'admin' } },
  { path: '/admin/maintenance', name: 'admin.maintenance', component: () => import('../views/admin/Maintenance.vue'), meta: { requiresAuth: true, role: 'admin' } },
  { path: '/admin/expenses', name: 'admin.expenses', component: () => import('../views/admin/Expenses.vue'), meta: { requiresAuth: true, role: 'admin' } },
];

const router = createRouter({ history: createWebHistory(), routes });

router.beforeEach((to, from, next) => {
  const auth = useAuthStore();
  if (to.meta.requiresAuth && !auth.isAuthenticated) return next('/login');
  next();
});

export default router;

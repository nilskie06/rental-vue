<template>
  <div class="unit-show" v-if="unit">
    <button @click="$router.back()">← Back</button>
    <div class="unit-detail">
      <div class="unit-main">
        <h1>{{ unit.unit_number }}</h1>
        <p class="building-name">{{ unit.building?.name }} · {{ unit.building?.address }}</p>
        <div class="unit-specs">
          <span>🛏️ {{ unit.bedrooms }} Bedrooms</span>
          <span>🚿 {{ unit.bathrooms }} Bathrooms</span>
          <span>📐 {{ unit.sqft }} sqft</span>
          <span>🏠 {{ unit.type }}</span>
        </div>
        <div class="unit-price">₱{{ unit.rent_amount?.toLocaleString() }}/month</div>
        <p v-if="unit.description">{{ unit.description }}</p>
      </div>
      <div class="unit-sidebar">
        <div class="contact-card">
          <h3>Interested?</h3>
          <p>Schedule a visit or contact us</p>
          <button class="btn-primary">Schedule Visit</button>
          <button class="btn-secondary">Contact Us</button>
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

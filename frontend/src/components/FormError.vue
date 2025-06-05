<template>
  <div v-if="errors && errors.length > 0" class="error-container">
    <div 
      v-for="error in errors" 
      :key="error" 
      class="error-text"
    >
      {{ error }}
    </div>
  </div>
</template>

<script setup>
defineProps({
  errors: {
    type: Array,
    default: () => []
  }
})
</script>

<style scoped>
.error-container {
  margin-top: 0.375rem;
}

.error-text {
  color: #ef4444;
  font-size: 0.875rem;
  font-weight: 500;
  line-height: 1.4;
  margin-bottom: 0.125rem;
  opacity: 0;
  animation: fadeIn 0.2s ease-out forwards;
}

.error-text:last-child {
  margin-bottom: 0;
}

@keyframes fadeIn {
  from {
    opacity: 0;
    transform: translateY(-4px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}
</style>
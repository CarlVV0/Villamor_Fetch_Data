<template>
  <div class="bg-white p-4 rounded-lg shadow-md">
    <img :src="product.image" :alt="product.name" class="w-full h-48 object-cover mb-4">
    <h3 class="text-lg font-semibold">{{ product.name }}</h3>
    <p class="text-gray-600 text-lg font-bold mt-2" >{{ product.description }}</p>
    <p class="text-lg font-bold mt-2">{{ product.price }}</p>
  </div>
</template>

<script setup>
defineProps({
  product: {
    type: Object,
    required: true
  }
});
</script>
<script setup>
import { ref, onMounted } from 'vue';
import { router, usePage } from '@inertiajs/vue3';
import MainLayout from './MainLayout.vue';
import ProductCard from './ProductCard.vue';

const message = ref("This is a Products list.");
const products = ref(usePage().props.products || []);

// Form Data
const newProduct = ref({
  name: '',
  price: '',
  image: '',
  description: ''
});

const errorMessage = ref('');

// Function to validate form
const validateForm = () => {
  const { name, price, image, description } = newProduct.value;
  if (!name || !price || !image || !description) {
    errorMessage.value = "All fields are required!";
    return false;
  }
  if (!/^\₱?\d+(\.\d{1,2})?$/.test(price)) {
    errorMessage.value = "Price must be a valid number (e.g., ₱100 or 100.00)";
    return false;
  }
  if (!image.match(/\.(jpeg|jpg|png|gif)$/)) {
    errorMessage.value = "Image URL must be a valid image file (jpg, png, gif)";
    return false;
  }
  errorMessage.value = "";
  return true;
};

// Function to fetch products using Inertia
const fetchProducts = async () => {
  try {
    router.visit('/products', {
      method: 'get',
      only: ['products'],
      preserveState: true,
      onSuccess: (page) => {
        products.value = page.props.products;
      }
    });
  } catch (error) {
    console.error("Failed to load products.", error);
  }
};

// Function to add a new product
const addProduct = async () => {
  if (!validateForm()) return;

  try {
    router.post('/products', newProduct.value, {
      onSuccess: () => {
        fetchProducts(); // Refresh product list
        newProduct.value = { name: '', price: '', image: '', description: '' }; // Clear form
      },
      onError: (errors) => {
        errorMessage.value = errors.message || "Failed to add product.";
      }
    });
  } catch (error) {
    errorMessage.value = "An unexpected error occurred.";
  }
};

// Fetch products on component mount
onMounted(fetchProducts);
</script>

<template>
  <MainLayout>
    <div class="p-6">
      <!-- Header Section -->
      <h2 class="text-xl mb-6">Products</h2>

      <!-- Product Submission Form -->
      <form @submit.prevent="addProduct" class="mb-6 p-4 bg-white shadow-md rounded">
        <h3 class="text-lg mb-3">Add a New Product</h3>

        <input v-model="newProduct.name" type="text" placeholder="Product Name" class="w-full p-2 border rounded mb-2">
        <input v-model="newProduct.price" type="text" placeholder="Price (₱100)" class="w-full p-2 border rounded mb-2">
        <input v-model="newProduct.image" type="text" placeholder="Image URL" class="w-full p-2 border rounded mb-2">
        <textarea v-model="newProduct.description" placeholder="Description" class="w-full p-2 border rounded mb-2"></textarea>

        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Add Product</button>

        <p v-if="errorMessage" class="text-red-500 mt-2">{{ errorMessage }}</p>
      </form>

      <!-- Grid Layout for Products -->
      <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <ProductCard v-for="product in products" :key="product.id" :product="product" />
      </div>

      <!-- Message Section -->
      <div class="mt-6 text-center">
        <p class="text-lg">{{ message }}</p>
      </div>
    </div>
  </MainLayout>
</template>

<style scoped>
.p-6 {
  background-image: url('/images/background.jpg');
  background-size: cover;
  background-position: center;
}
</style>

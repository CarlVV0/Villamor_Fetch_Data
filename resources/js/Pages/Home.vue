<script setup>
import {ref} from 'vue'
import MainLayout from './MainLayout.vue';

const message = ref("Tap below to change color and Message.");
const colors = ref(['#FF5733', '#33FF57', '#3357FF', '#FF33A1', '#A133FF']);
const currentColor = ref(colors.value[0]);

const changeMessage = () => {
  const messages = [
    "Welcome to the Future!",
    "Inertia is Awesome!",
    "Vue.js Rocks!",
    "Interactive Web Apps!",
    "Creativity at its Best!"
  ];
  message.value = messages[Math.floor(Math.random() * messages.length)];
  currentColor.value = colors.value[Math.floor(Math.random() * colors.value.length)];
};
</script>

<template>
  <MainLayout>
    <div class="container">
      <h1 :style="{ color: currentColor }">Hello World!</h1>
      <div class="message" :style="{ backgroundColor: currentColor }">
        {{ message }}
      </div>
      <button @click="changeMessage" class="change-button">Change Message</button>
    </div>
  </MainLayout>
</template>

<style scoped>
.container {
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  height: 100vh;
  background-color: #f0f0f0;
  font-family: 'Arial', sans-serif;
}

h1 {
  font-size: 3rem;
  margin-bottom: 20px;
  transition: color 0.5s ease;
}

.message {
  padding: 20px;
  border-radius: 10px;
  color: white;
  font-size: 1.5rem;
  margin-bottom: 20px;
  transition: background-color 0.5s ease;
}

.change-button {
  padding: 10px 20px;
  font-size: 1rem;
  color: white;
  background-color: #333;
  border: none;
  border-radius: 5px;
  cursor: pointer;
  transition: background-color 0.3s ease;
}

.change-button:hover {
  background-color: #555;
}
</style>

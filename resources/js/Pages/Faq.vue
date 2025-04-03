<script setup>
import { ref } from 'vue';
import MainLayout from './MainLayout.vue';

const message = ref("This is an Inertia App.");

// FAQ data
const faqs = ref([
  {
    question: 'What is Inertia.js?',
    answer: 'Inertia.js is a framework for building single-page apps using classic server-side routing and controllers. It allows you to create modern, dynamic web applications without the complexity of SPAs.',
    isOpen: false,
  },
  {
    question: 'How does Inertia.js work?',
    answer: 'Inertia.js works by intercepting links and form submissions, making AJAX requests to the server, and dynamically updating the page without a full reload. It uses your existing server-side routing and controllers.',
    isOpen: false,
  },
  {
    question: 'What are the benefits of using Inertia.js?',
    answer: 'Inertia.js allows you to build modern web apps without the complexity of SPAs. It leverages your existing backend and provides a smooth, fast user experience.',
    isOpen: false,
  },
  {
    question: 'Can I use Inertia.js with Vue.js?',
    answer: 'Yes, Inertia.js works seamlessly with Vue.js, React, and Svelte. You can use your preferred frontend framework to build your app.',
    isOpen: false,
  },
]);

// Function to toggle FAQ answer visibility
const toggleFAQ = (index) => {
  faqs.value[index].isOpen = !faqs.value[index].isOpen;
};
</script>

<template>
  <MainLayout>
    <div class="container">
      <h1>Hello Faq</h1>
      <div class="message">{{ message }}</div>

      <!-- FAQ Section -->
      <div class="faq-section">
        <h2>Frequently Asked Questions</h2>
        <div v-for="(faq, index) in faqs" :key="index" class="faq-item">
          <div class="faq-question" @click="toggleFAQ(index)">
            {{ faq.question }}
            <span class="arrow">{{ faq.isOpen ? '▲' : '▼' }}</span>
          </div>
          <div v-if="faq.isOpen" class="faq-answer">
            {{ faq.answer }}
          </div>
        </div>
      </div>
    </div>
  </MainLayout>
</template>

<style scoped>
.container {
  max-width: 800px;
  margin: 0 auto;
  padding: 20px;
  font-family: 'Arial', sans-serif;
}

h1 {
  font-size: 2.5rem;
  margin-bottom: 20px;
  text-align: center;
}

.message {
  font-size: 1.2rem;
  margin-bottom: 20px;
  text-align: center;
}

.faq-section {
  margin-top: 20px;
}

.faq-section h2 {
  font-size: 1.8rem;
  margin-bottom: 20px;
  text-align: center;
}

.faq-item {
  margin-bottom: 10px;
  border: 1px solid #ddd;
  border-radius: 5px;
  overflow: hidden;
}

.faq-question {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 15px;
  background-color: #f9f9f9;
  cursor: pointer;
  font-weight: bold;
}

.faq-question:hover {
  background-color: #f0f0f0;
}

.faq-question .arrow {
  font-size: 1.2rem;
}

.faq-answer {
  padding: 15px;
  background-color: #fff;
  border-top: 1px solid #ddd;
}
</style>
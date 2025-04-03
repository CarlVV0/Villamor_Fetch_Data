<script setup>
import { ref } from 'vue';
import MainLayout from './MainLayout.vue';

// Reactive data
const message = ref("This is an List of Transactions.");
const transactions = ref([
  { id: 1, description: 'Groceries', amount: -50 },
  { id: 2, description: 'Salary', amount: 2000 },
  { id: 3, description: 'Coffee', amount: -5 },
  { id: 4, description: 'Freelance Work', amount: 500 },
]);
const newTransaction = ref({ description: '', amount: 0 });

// Function to add a new transaction
const addTransaction = () => {
  if (newTransaction.value.description && newTransaction.value.amount !== 0) {
    transactions.value.push({
      id: transactions.value.length + 1,
      description: newTransaction.value.description,
      amount: parseFloat(newTransaction.value.amount),
    });
    newTransaction.value.description = '';
    newTransaction.value.amount = 0;
  }
};

// Function to calculate the total balance
const totalBalance = () => {
  return transactions.value.reduce((total, transaction) => total + transaction.amount, 0);
};
</script>

<template>
  <MainLayout>
    <div class="container">
      <h1>Hello Transaction</h1>
      <div class="message">{{ message }}</div>

      <!-- Transaction List -->
      <div class="transaction-list">
        <h2>Transactions</h2>
        <ul>
          <li v-for="transaction in transactions" :key="transaction.id" :class="{ income: transaction.amount > 0, expense: transaction.amount < 0 }">
            <span>{{ transaction.description }}</span>
            <span>{{ transaction.amount > 0 ? `+${transaction.amount}` : transaction.amount }}</span>
          </li>
        </ul>
      </div>

      <!-- Total Balance -->
      <div class="total-balance">
        <h2>Total Balance</h2>
        <p :class="{ positive: totalBalance() >= 0, negative: totalBalance() < 0 }">
          {{ totalBalance() }}
        </p>
      </div>

      <!-- Add Transaction Form -->
      <div class="add-transaction">
        <h2>Add Transaction</h2>
        <form @submit.prevent="addTransaction">
          <input
            v-model="newTransaction.description"
            type="text"
            placeholder="Description"
            required
          />
          <input
            v-model="newTransaction.amount"
            type="number"
            placeholder="Amount"
            required
          />
          <button type="submit">Add</button>
        </form>
      </div>
    </div>
  </MainLayout>
</template>

<style scoped>
.container {
  max-width: 600px;
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

.transaction-list {
  margin-bottom: 20px;
}

.transaction-list h2,
.total-balance h2,
.add-transaction h2 {
  font-size: 1.5rem;
  margin-bottom: 10px;
}

.transaction-list ul {
  list-style: none;
  padding: 0;
}

.transaction-list li {
  display: flex;
  justify-content: space-between;
  padding: 10px;
  margin-bottom: 10px;
  border-radius: 5px;
  background-color: #f9f9f9;
}

.transaction-list .income {
  border-left: 5px solid #4caf50;
}

.transaction-list .expense {
  border-left: 5px solid #f44336;
}

.total-balance p {
  font-size: 1.5rem;
  text-align: center;
  padding: 10px;
  border-radius: 5px;
  background-color: #f9f9f9;
}

.total-balance .positive {
  color: #4caf50;
}

.total-balance .negative {
  color: #f44336;
}

.add-transaction form {
  display: flex;
  flex-direction: column;
  gap: 10px;
}

.add-transaction input {
  padding: 10px;
  border: 1px solid #ccc;
  border-radius: 5px;
}

.add-transaction button {
  padding: 10px;
  background-color: #333;
  color: white;
  border: none;
  border-radius: 5px;
  cursor: pointer;
}

.add-transaction button:hover {
  background-color: #555;
}
</style>
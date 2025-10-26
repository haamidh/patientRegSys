<template>
  <div class="min-h-screen flex items-center justify-center">
    <div class="p-8 rounded-2xl shadow-md w-full max-w-md">
      <h1 class="text-2xl font-semibold text-center mb-6 dark:text-gray-100 text-gray-800">
        Patient Registration
      </h1>

      <form @submit.prevent="submit">
        <!-- Full Name -->
        <div class="mb-4">
          <label class="block dark:text-gray-300 text-gray-700 text-sm font-medium mb-2">Full Name</label>
          <input v-model="form.name" type="text" class="w-full dark:bg-gray-600 border-gray-300 rounded-md shadow-sm" required />
          <p v-if="form.errors.name" class="text-red-500 text-sm mt-1">{{ form.errors.name }}</p>
        </div>

        <!-- Email -->
        <div class="mb-4">
          <label class="block dark:text-gray-300 text-gray-700 text-sm font-medium mb-2">Email</label>
          <input v-model="form.email" type="email" class="w-full dark:bg-gray-600 border-gray-300 rounded-md shadow-sm" required />
          <p v-if="form.errors.email" class="text-red-500 text-sm mt-1">{{ form.errors.email }}</p>
        </div>

        <!-- Phone -->
        <div class="mb-4">
          <label class="block dark:text-gray-300 text-gray-700 text-sm font-medium mb-2">Phone</label>
          <input v-model="form.phone" type="text" class="w-full dark:bg-gray-600 border-gray-300 rounded-md shadow-sm" required />
          <p v-if="form.errors.phone" class="text-red-500 text-sm mt-1">{{ form.errors.phone }}</p>
        </div>

        <!-- DOB -->
        <div class="mb-4">
          <label class="block dark:text-gray-300 text-gray-700 text-sm font-medium mb-2">Date of Birth</label>
          <input v-model="form.dob" type="date" class="w-full dark:bg-gray-600 border-gray-300 rounded-md shadow-sm" required />
          <p v-if="form.errors.dob" class="text-red-500 text-sm mt-1">{{ form.errors.dob }}</p>
        </div>

        <!-- Address -->
        <div class="mb-4">
          <label class="block dark:text-gray-300 text-gray-700 text-sm font-medium mb-2">Address</label>
          <textarea v-model="form.address" rows="3" class="w-full dark:bg-gray-600 border-gray-300 rounded-md shadow-sm"></textarea>
          <p v-if="form.errors.address" class="text-red-500 text-sm mt-1">{{ form.errors.address }}</p>
        </div>

        <!-- Submit Button -->
        <div class="mt-6">
          <button
            type="submit"
            class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-md"
            :disabled="form.processing"
          >
            <span v-if="!form.processing">Register</span>
            <span v-else>Processing...</span>
          </button>
        </div>
      </form>
    </div>
  </div>
</template>

<script setup>
import { useForm } from '@inertiajs/vue3'

const form = useForm({
  name: '',
  email: '',
  phone: '',
  dob: '',
  address: ''
})

function submit() {
  form.post('/register-patient', {
    onSuccess: () => {
      form.reset()
      alert('Registration successful!')
    }
  })
}
</script>


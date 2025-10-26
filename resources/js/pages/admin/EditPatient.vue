<template>
  <div class="max-w-lg mx-auto mt-10">
    <h2 class="text-2xl font-semibold mb-4">Edit Patient</h2>

    <form @submit.prevent="updatePatient">
      <div class="mb-4">
        <label class="block font-medium mb-1">Name</label>
        <input v-model="form.name" type="text" class="w-full border p-2 rounded" />
      </div>

      <div class="mb-4">
        <label class="block font-medium mb-1">Email</label>
        <input v-model="form.email" type="email" class="w-full border p-2 rounded" />
      </div>

      <div class="mb-4">
        <label class="block font-medium mb-1">Phone</label>
        <input v-model="form.phone" type="text" class="w-full border p-2 rounded" />
      </div>

      <div class="mb-4">
        <label class="block font-medium mb-1">DOB</label>
        <input v-model="form.dob" type="date" class="w-full border p-2 rounded" />
      </div>

      <div class="mb-4">
        <label class="block font-medium mb-1">Address</label>
        <textarea v-model="form.address" class="w-full border p-2 rounded" rows="3"></textarea>
      </div>

      <button
        type="submit"
        class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700"
      >
        Update Patient
      </button>
    </form>
  </div>
</template>

<script setup>
import { useForm } from '@inertiajs/vue3'

const props = defineProps({
  patient: Object,
})

const form = useForm({
  name: props.patient.name || '',
  email: props.patient.email || '',
  phone: props.patient.phone || '',
  dob: props.patient.dob ? props.patient.dob.split(' ')[0] : '',
  address: props.patient.address || '',
})

const updatePatient = () => {
  const url = typeof route !== 'undefined' ? route('patients.update', props.patient.id) : `/admin/patients/${props.patient.id}`
  form.put(url)
}
</script>

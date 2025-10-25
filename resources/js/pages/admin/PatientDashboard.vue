<template>
  <div class="p-8">
    <h1 class="text-3xl font-bold mb-6">Registered Patients</h1>

    <table class="min-w-full bg-white border rounded-lg shadow-md">
      <thead class="bg-gray-100 text-gray-700">
        <tr>
          <th class="py-2 px-4 border">#</th>
          <th class="py-2 px-4 border">Name</th>
          <th class="py-2 px-4 border">Email</th>
          <th class="py-2 px-4 border">Phone</th>
          <th class="py-2 px-4 border">DOB</th>
          <th class="py-2 px-4 border">Address</th>
          <th class="py-2 px-4 border text-center">Actions</th>
        </tr>
      </thead>

      <tbody>
        <tr v-for="(patient, index) in patients" :key="patient.id" class="hover:bg-gray-50">
          <td class="py-2 px-4 border">{{ index + 1 }}</td>
          <td class="py-2 px-4 border">{{ patient.name }}</td>
          <td class="py-2 px-4 border">{{ patient.email }}</td>
          <td class="py-2 px-4 border">{{ patient.phone }}</td>
          <td class="py-2 px-4 border">{{ patient.dob }}</td>
          <td class="py-2 px-4 border">{{ patient.address }}</td>
          <td class="py-2 px-4 border text-center">
            <button type="button" @click="editPatient(patient.id)" class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded mr-2">
              Edit
            </button>
            <button type="button" @click="deletePatient(patient.id)" class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded">
              Delete
            </button>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script setup>
import { router } from '@inertiajs/vue3';
defineProps({patients: Array})

function editPatient(id){
    router.visit(`/admin/patients/${id}/edit`)
}

function deletePatient(id){
    if(!confirm('Are you sure to you want to delete ')) return
        router.delete(`/admin/patients/${id}`);  
}

</script>
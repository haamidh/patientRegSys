<template>
  <div class="p-8">


    <!-- Top Bar -->
    <div class="flex justify-between items-center mb-6 border-b pb-3">
      <h1 class="text-3xl font-semibold">Registered Patients</h1>
      <LogoutButton />
    </div>

    <!--  Search box -->
    <div class="mb-4 flex justify-end">
      <input v-model="search" @input="performSearch" type="text" placeholder="Search by name, email, or phone..."
        class="border rounded-lg p-2 w-1/3 focus:ring-2 focus:ring-blue-400" />
    </div>



    <table class="min-w-full bg-white border rounded-lg shadow-md">
      <thead class="bg-gray-100 text-gray-700">
        <tr>
          <th class="py-2 px-4 border">#</th>
          <th class="py-2 px-4 border">Name</th>
          <th class="py-2 px-4 border">Email</th>
          <th class="py-2 px-4 border">Phone</th>
          <th class="py-2 px-4 border">Age</th>
          <th class="py-2 px-4 border">DOB</th>
          <th class="py-2 px-4 border">Address</th>
          <th class="py-2 px-4 border text-center">Actions</th>
        </tr>
      </thead>

      <tbody>
        <tr v-for="(patient, index) in patientData" :key="patient.id" class="hover:bg-gray-50">
          <td class="py-2 dark:bg-gray-800 px-4 border">{{ index + 1 }}</td>
          <td class="py-2 dark:bg-gray-800 px-4 border">{{ patient.name }}</td>
          <td class="py-2 dark:bg-gray-800 px-4 border">{{ patient.email }}</td>
          <td class="py-2 dark:bg-gray-800 px-4 border">{{ patient.phone }}</td>
          <td class="py-2 dark:bg-gray-800 px-4 border">{{ calculateAge(patient.dob) }}</td>
          <td class="py-2 dark:bg-gray-800 px-4 border">{{ formatDate(patient.dob) }}</td>
          <td class="py-2 dark:bg-gray-800 px-4 border">{{ patient.address }}</td>
          <td class="py-2 dark:bg-gray-800 px-4 border text-center">
            <button type="button" @click="editPatient(patient.id)"
              class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded mr-2">
              <UserPen />
            </button>
            <button type="button" @click="deletePatient(patient.id)"
              class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded">
              <Trash />
            </button>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script setup>
import { ref, computed } from 'vue';
import { router } from '@inertiajs/vue3';
import { UserPen } from 'lucide-vue-next';
import { Trash } from 'lucide-vue-next';
import LogoutButton from '@/components/LogoutButton.vue';

const props = defineProps({
  patients: {
    type: Object,
    required: true
  },
  filters: {
    type: Object,
    default: () => ({})
  }
})


const patientData = computed(() => props.patients.data || props.patients)
const search = ref(props.filters.q || '')

function editPatient(id) {
  router.visit(`/admin/patients/${id}/edit`)
}

function deletePatient(id) {
  if (!confirm('Are you sure you want to delete this patient?')) return
  router.delete(`/admin/patients/${id}`);
}

function formatDate(dateString) {
  if (!dateString) return ''
  return dateString.split(' ')[0]
}

function calculateAge(dob) {
  if (!dob) return ''
  const datePart = dob.split(' ')[0]
  const birth = new Date(datePart)
  if (isNaN(birth.getTime())) return ''
  const today = new Date()
  let age = today.getFullYear() - birth.getFullYear()
  const m = today.getMonth() - birth.getMonth()
  if (m < 0 || (m === 0 && today.getDate() < birth.getDate())) {
    age--
  }
  return age
}

function performSearch() {

  const indexUrl = typeof route !== 'undefined' ? route('patients.index') : '/admin/patients'

  router.get(
    indexUrl,
    { q: search.value },
    { preserveState: true, replace: true }
  )
}

</script>
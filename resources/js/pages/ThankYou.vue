<template>
    <div class="text-center mt-10">
        <Check class="w-16 h-16 text-green-600 mx-auto" />
        <h2 class="text-2xl font-bold mt-4">Thank You For Registering</h2>
        <p>Your registration was successful</p>
        <Link href="/" class="inline-block mt-6 bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700 transition">
      Home
    </Link>
    </div>

</template>

<script setup>
import { Check } from 'lucide-vue-next';
import { Link } from '@inertiajs/vue3';
</script>
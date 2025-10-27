<script setup lang="ts">
import { Head, Link, usePage } from '@inertiajs/vue3';
import { onMounted } from 'vue';

const page = usePage();

onMounted(() => {
    if (page.props && page.props.auth && page.props.auth.user) {
        window.location.href = '/admin/patients';
    }
});
</script>

<template>

    <Head title="Welcome" />

    <div class="min-h-screen bg-[#FDFDFC] dark:bg-[#0a0a0a] text-[#1b1b18] p-6">
        <header class="flex justify-end mb-8">
            <Link href="/login"
                class="inline-block rounded-sm border border-transparent px-4 py-2 text-sm leading-normal text-[#1b1b18] hover:border-[#19140035] dark:text-[#EDEDEC]">
            Log in
            </Link>
        </header>

        <main class="flex items-center justify-center">
            <div class="max-w-xl text-center bg-white dark:bg-[#161615] rounded-lg p-10 shadow">
                <h1 class="text-2xl dark:text-amber-100 font-medium mb-3">Patient Registration System</h1>
                <p class="mb-6 text-sm text-[#706f6c] dark:text-[#A1A09A]">Register patients quickly and manage them
                    from the admin dashboard.</p>

                <div class="flex justify-center">
                    <Link href="/register-patient"
                        class="inline-block rounded-md bg-[#f53003] hover:opacity-90 text-white px-6 py-3">Register
                    Patient</Link>
                </div>
            </div>
        </main>
    </div>
</template>

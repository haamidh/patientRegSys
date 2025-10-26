<template>
    <form>
        <TextLink :href="logout()" as="button" class="mx-auto block text-sm">
            Log out
        </TextLink>
    </form>
</template>

<script setup>
import { logout } from '@/routes';
import TextLink from '@/components/TextLink.vue';
</script>

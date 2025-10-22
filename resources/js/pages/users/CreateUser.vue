<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { dashboard } from '@/routes';
import { type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/vue3';


const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Dashboard',
        href: dashboard().url,
    },
    {
        title: 'Create User',
        href: '#'
    }
];
</script>

<template>
    <Head title="Create User" />
    <AppLayout :breadcrumbs="breadcrumbs">
    <div class="p-4" >
        <h1> Create New User </h1>
    </div>
    </AppLayout>
</template>


<style lang="scss" scoped>

</style>

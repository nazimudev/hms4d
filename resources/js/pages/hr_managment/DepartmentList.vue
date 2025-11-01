<script setup>
  // logic here
  import AppLayout from '@/layouts/AppLayout.vue';
  import { dashboard } from '@/routes';
  import { Head } from '@inertiajs/vue3';


  const breadcrumbs = [
    { title: 'Dashboard', href: dashboard().url},
    { title: 'Department List', href: '#' },
  ]
</script>

<template>
  <div>
    <!-- content -->
    <Head title="Department List" />
    <AppLayout :breadcrumbs="breadcrumbs">

    </AppLayout>
  </div>
</template>

<style scoped>
  /* styles */
</style>

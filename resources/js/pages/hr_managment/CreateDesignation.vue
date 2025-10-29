<script lang="ts" setup>
import { Head, useForm, usePage } from '@inertiajs/vue3'
import AppLayout from '@/layouts/AppLayout.vue'
import { dashboard } from '@/routes'
import { toast } from 'vue-sonner';
import axios from 'axios';
import { toTypedSchema } from '@vee-validate/zod';
import { z } from 'zod';


// UI Components
import { Button } from '@/components/ui/button'
import {
  FormControl,
  FormField,
  FormItem,
  FormLabel,
  FormMessage,
  FormDescription,
} from '@/components/ui/form'
import { Input } from '@/components/ui/input'
import { Textarea } from '@/components/ui/textarea'
import { ref } from 'vue'


const breadcrumbs = [
  { title: 'Dashboard', href: dashboard().url },
  { title: 'Add Designation', href: '#' },
]

const form = useForm({
  name: '',
  description: ''
})

const submitForm = () => {
  form.post('/store/designation', {
    onSuccess: () => {
        const flash = (usePage().props as any).flash as { success?: string } | undefined;
        const message = flash?.success || 'Designation created successfully';

        toast.success(message, {
            description: `${form.name} has been added.`,
            action: {
                label: 'Ok',
                onClick: () => toast.dismiss(),
            },
        });
        form.reset();
    },
    onError: () => {
        const flash = (usePage().props as any).flash as { error?: string } | undefined;
        const errorMessage = flash?.error || 'Failed to create designation';

        toast.error(errorMessage, {
            action: {
                label: 'Retry',
                onClick: () => toast.dismiss(),
            },
        });
    },
  })

  // তুমি এখানে axios / inertia.post ব্যবহার করে ব্যাকএন্ডে পাঠাতে পারো
}
</script>

<template>
  <Head title="Create Designation" />
  <AppLayout :breadcrumbs="breadcrumbs">
    <div class="flex justify-center items-center min-h-[70vh]">
      <div class="w-full max-w-md bg-white rounded-2xl p-6">
        <h2 class="text-xl font-semibold text-center mb-5">Add Designation</h2>

        <form @submit.prevent="submitForm" class="space-y-5">
          <!-- Name -->
          <FormField name="name">
            <FormItem>
              <FormLabel>Designation Name</FormLabel>
              <FormControl>
                <Input v-model="form.name" placeholder="Enter designation name" />
              </FormControl>
              <FormMessage v-if="form.errors.name">{{ form.errors.name }}</FormMessage>
            </FormItem>
          </FormField>

          <!-- Description -->
          <FormField name="description">
            <FormItem>
              <FormLabel>Description</FormLabel>
              <FormControl>
                <Textarea
                  v-model="form.description"
                  placeholder="Enter description"
                  rows="4"
                />
              </FormControl>
              <FormMessage />
              <FormDescription>
                Description of the designation. max length 255 character
              </FormDescription>
            </FormItem>
          </FormField>

          <div class="flex justify-center">
            <Button type="submit">Save Designation</Button>
          </div>
        </form>
      </div>
    </div>
  </AppLayout>
</template>

<style scoped>
/* Optional custom styles */
</style>

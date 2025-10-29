<script lang="ts" setup>
import { Label } from '@/components/ui/label';
import { RadioGroup, RadioGroupItem } from '@/components/ui/radio-group';
import AppLayout from '@/layouts/AppLayout.vue';
import { dashboard } from '@/routes';
import { Head, useForm, usePage } from '@inertiajs/vue3';
import { toast } from 'vue-sonner';

// UI Components
import { Button } from '@/components/ui/button';
import {
    FormControl,
    FormDescription,
    FormField,
    FormItem,
    FormLabel,
    FormMessage,
} from '@/components/ui/form';
import { Input } from '@/components/ui/input';
import { Textarea } from '@/components/ui/textarea';

const breadcrumbs = [
    { title: 'Dashboard', href: dashboard().url },
    { title: 'Add Department', href: '#' },
];

const form = useForm({
    name: '',
    floor: '',
    room_number: '',
    description: '',
    status: '',
});

const submitForm = () => {
    form.post('/store/department', {
        onSuccess: () => {
            const flash = (usePage().props as any).flash as
                | { success?: string }
                | undefined;
            const message =
                flash?.success || 'Department created successfully';

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
            const flash = (usePage().props as any).flash as
                | { error?: string }
                | undefined;
            const errorMessage = flash?.error || 'Failed to create department';

            toast.error(errorMessage, {
                action: {
                    label: 'Retry',
                    onClick: () => toast.dismiss(),
                },
            });
        },
    });
    // তুমি এখানে axios / inertia.post ব্যবহার করে ব্যাকএন্ডে পাঠাতে পারো
};
</script>

<template>
    <Head title="Create Department" />
    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex min-h-[70vh] items-center justify-center">
            <div class="w-full max-w-md rounded-2xl bg-white p-6">
                <h2 class="mb-5 text-center text-xl font-semibold">
                    Add Department
                </h2>

                <form @submit.prevent="submitForm" class="space-y-5">
                    <!-- Name -->
                    <FormField name="name">
                        <FormItem>
                            <FormLabel>Department Name</FormLabel>
                            <FormControl>
                                <Input
                                    v-model="form.name"
                                    placeholder="Enter department name"
                                />
                            </FormControl>
                            <FormMessage v-if="form.errors.name">{{
                                form.errors.name
                            }}</FormMessage>
                        </FormItem>
                    </FormField>

                    <!-- Floor/Location -->
                    <FormField name="floor">
                        <FormItem>
                            <FormLabel>Floor/Location</FormLabel>
                            <FormControl>
                                <Input
                                    v-model="form.floor"
                                    placeholder="Enter floor/location"
                                />
                            </FormControl>
                            <FormMessage v-if="form.errors.floor">{{
                                form.errors.floor
                            }}</FormMessage>
                        </FormItem>
                    </FormField>

                    <!-- Room Number -->
                    <FormField name="room_number">
                        <FormItem>
                            <FormLabel>Room Number</FormLabel>
                            <FormControl>
                                <Input
                                    v-model="form.room_number"
                                    placeholder="Enter room number"
                                />
                            </FormControl>
                            <FormMessage v-if="form.errors.room_number">{{
                                form.errors.room_number
                            }}</FormMessage>
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
                                Description of the department. max length 255
                                character
                            </FormDescription>
                        </FormItem>
                    </FormField>

                    <!-- is_active or inactive Radio -->
                    <FormField name="status">
                        <FormLabel>Status</FormLabel>
                        <FormControl>
                            <RadioGroup
                                v-model="form.status"
                                class="flex items-center space-x-4"
                            >
                                <FormItem class="flex items-center space-x-2">
                                    <RadioGroupItem
                                        value="active"
                                        id="status-active"
                                    />
                                    <Label class="mb-2" for="status-active">Active</Label>
                                </FormItem>

                                <FormItem class="flex items-center space-x-2">
                                    <RadioGroupItem
                                        value="inactive"
                                        id="status-inactive"
                                    />
                                    <Label class="mb-2" for="status-inactive"
                                        >Inactive</Label
                                    >
                                </FormItem>
                            </RadioGroup>
                        </FormControl>
                    </FormField>

                    <div class="flex justify-center">
                        <Button type="submit">Save Department</Button>
                    </div>
                </form>
            </div>
        </div>
    </AppLayout>
</template>

<style scoped>
/* Optional custom styles */
</style>

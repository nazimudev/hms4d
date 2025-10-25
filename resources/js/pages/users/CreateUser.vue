<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { dashboard } from '@/routes';
import { Head } from '@inertiajs/vue3';
import { toTypedSchema } from '@vee-validate/zod';
import { useForm } from 'vee-validate';
import { computed, ref } from 'vue';
import { z } from 'zod';

// 🗓️ Date Picker utilities
import { Calendar } from '@/components/ui/calendar';
import {
    CalendarDate,
    DateFormatter,
    getLocalTimeZone,
    parseDate,
    today,
} from '@internationalized/date';
import { CalendarIcon } from 'lucide-vue-next';
import { toDate } from 'reka-ui/date';

// 🧩 UI Components
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
import {
    Popover,
    PopoverContent,
    PopoverTrigger,
} from '@/components/ui/popover';
import {
    Select,
    SelectContent,
    SelectItem,
    SelectTrigger,
    SelectValue,
} from '@/components/ui/select';

// 💡 Utility & Toast (optional)
import { cn } from '@/utils';

// 🧭 Breadcrumb
const breadcrumbs = [
    { title: 'Dashboard', href: dashboard().url },
    { title: 'Create User', href: '#' },
];

// ✅ Date Formatter
const df = new DateFormatter('en-US', { dateStyle: 'long' });

// ✅ Validation schema (Zod)
const formSchema = toTypedSchema(
    z.object({
        name: z.string().min(2, 'Name is required'),
        username: z.string().min(2, 'Username is required'),
        email: z.string().email('Invalid email address'),
        password: z.string().min(6, 'Password must be at least 6 characters'),
        phone: z.string().min(10, 'Phone number is too short'),
        status: z.enum(['active', 'inactive']),
        dob: z
            .string()
            .refine((v) => v, { message: 'Date of birth is required' }), // 👈 DOB added
    }),
);

// ✅ Initialize form
const { handleSubmit, values, setFieldValue } = useForm({
    validationSchema: formSchema,
});

// ✅ Date picker state
const placeholder = ref();
const value = computed({
    get: () => (values.dob ? parseDate(values.dob) : undefined),
    set: (val) => val,
});

// ✅ Submit function
const onSubmit = handleSubmit((data: any) => {
    console.log(data);
});
</script>

<template>
    <Head title="Create User" />
    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="p-6">
            <h1 class="mt-5 mb-5 text-2xl font-bold">Create New User</h1>

            <form @submit="onSubmit">
                <div class="grid grid-cols-4 gap-6">
                    <!-- Name -->
                    <FormField name="name">
                        <FormItem>
                            <FormLabel>Name</FormLabel>
                            <FormControl>
                                <Input placeholder="John Doe" />
                            </FormControl>
                            <FormMessage />
                        </FormItem>
                    </FormField>

                    <!-- Username -->
                    <FormField name="username">
                        <FormItem>
                            <FormLabel>Username</FormLabel>
                            <FormControl>
                                <Input placeholder="johndoe" />
                            </FormControl>
                            <FormMessage />
                        </FormItem>
                    </FormField>

                    <!-- Email -->
                    <FormField name="email">
                        <FormItem>
                            <FormLabel>Email</FormLabel>
                            <FormControl>
                                <Input
                                    placeholder="name@example.com"
                                    type="email"
                                />
                            </FormControl>
                            <FormMessage />
                        </FormItem>
                    </FormField>

                    <!-- Password -->
                    <FormField name="password">
                        <FormItem>
                            <FormLabel>Password</FormLabel>
                            <FormControl>
                                <Input placeholder="********" type="password" />
                            </FormControl>
                            <FormMessage />
                        </FormItem>
                    </FormField>

                    <!-- Phone -->
                    <FormField name="phone">
                        <FormItem>
                            <FormLabel>Phone</FormLabel>
                            <FormControl>
                                <Input placeholder="+8801XXXXXXXXX" />
                            </FormControl>
                            <FormMessage />
                        </FormItem>
                    </FormField>

                    <!-- Status -->
                    <FormField name="status">
                        <FormItem>
                            <FormLabel>Status</FormLabel>
                            <Select
                                :model-value="values.status"
                                @update:model-value="
                                    (val: any) => setFieldValue('status', val)
                                "
                            >
                                <FormControl>
                                    <SelectTrigger>
                                        <SelectValue
                                            placeholder="Select status"
                                        />
                                    </SelectTrigger>
                                </FormControl>
                                <SelectContent>
                                    <SelectItem value="active"
                                        >Active</SelectItem
                                    >
                                    <SelectItem value="inactive"
                                        >Inactive</SelectItem
                                    >
                                </SelectContent>
                            </Select>
                            <FormDescription
                                >Select user account status</FormDescription
                            >
                            <FormMessage />
                        </FormItem>
                    </FormField>
                </div>

                <h1 class="mt-5 mb-5 text-2xl font-bold">User Information</h1>

                <div class="grid grid-cols-4 gap-6">
                    <!-- First Name -->
                    <FormField name="relative_name">
                        <FormItem>
                            <FormLabel>Relative Name</FormLabel>
                            <FormControl>
                                <Input placeholder="John" />
                            </FormControl>
                            <FormMessage />
                        </FormItem>
                    </FormField>

                    <!-- Last Name -->
                    <FormField name="relative_phone">
                        <FormItem>
                            <FormLabel>Relative Phone</FormLabel>
                            <FormControl>
                                <Input placeholder="+8801XXXXXXXXX" />
                            </FormControl>
                            <FormMessage />
                        </FormItem>
                    </FormField>

                    <!-- Gender -->
                    <FormField name="gender">
                        <FormItem>
                            <FormLabel>Gender</FormLabel>
                            <Select
                                :model-value="values.gender"
                                @update:model-value="
                                    (val: any) => setFieldValue('gender', val)
                                "
                            >
                                <FormControl>
                                    <SelectTrigger>
                                        <SelectValue
                                            placeholder="Select gender"
                                        />
                                    </SelectTrigger>
                                </FormControl>
                                <SelectContent>
                                    <SelectItem value="male">Male</SelectItem>
                                    <SelectItem value="female"
                                        >Female</SelectItem
                                    >
                                </SelectContent>
                            </Select>
                            <FormDescription
                                >Select user gender</FormDescription
                            >
                            <FormMessage />
                        </FormItem>
                    </FormField>

                    <!-- Marital Status -->
                    <FormField name="marital_status">
                        <FormItem>
                            <FormLabel>Marital Status</FormLabel>
                            <Select
                                :model-value="values.marital_status"
                                @update:model-value="
                                    (val: any) =>
                                        setFieldValue('marital_status', val)
                                "
                            >
                                <FormControl>
                                    <SelectTrigger>
                                        <SelectValue
                                            placeholder="Select Status"
                                        />
                                    </SelectTrigger>
                                </FormControl>
                                <SelectContent>
                                    <SelectItem value="maried"
                                        >Maried</SelectItem
                                    >
                                    <SelectItem value="single"
                                        >Single</SelectItem
                                    >
                                </SelectContent>
                            </Select>
                            <FormDescription
                                >Select user status</FormDescription
                            >
                            <FormMessage />
                        </FormItem>
                    </FormField>

                    <!-- Blood Group -->
                    <FormField name="marital_status">
                        <FormItem>
                            <FormLabel>Marital Status</FormLabel>
                            <Select
                                :model-value="values.marital_status"
                                @update:model-value="
                                    (val: any) =>
                                        setFieldValue('marital_status', val)
                                "
                            >
                                <FormControl>
                                    <SelectTrigger>
                                        <SelectValue
                                            placeholder="Select Status"
                                        />
                                    </SelectTrigger>
                                </FormControl>
                                <SelectContent>
                                    <SelectItem value="a_positive"
                                        >A Positive (+ve)</SelectItem
                                    >
                                    <SelectItem value="b_positive"
                                        >B Positive (+ve)</SelectItem
                                    >
                                    <SelectItem value="ab_positive"
                                        >AB Positive (+ve)</SelectItem
                                    >
                                    <SelectItem value="o_positive"
                                        >O Positive (+ve)</SelectItem
                                    >
                                    <SelectItem value="a_negative"
                                        >A Negative (-ve)</SelectItem
                                    >
                                    <SelectItem value="b_negative"
                                        >B Negative (-ve)</SelectItem
                                    >
                                    <SelectItem value="ab_negative"
                                        >AB Negative (-ve)</SelectItem
                                    >
                                    <SelectItem value="o_negative"
                                        >O Negative (-ve)</SelectItem
                                    >
                                </SelectContent>
                            </Select>
                            <FormDescription
                                >Select user status</FormDescription
                            >
                            <FormMessage />
                        </FormItem>
                    </FormField>

                    <!-- Religion -->
                    <FormField name="relative_phone">
                        <FormItem>
                            <FormLabel>Religion</FormLabel>
                            <FormControl>
                                <Input placeholder="Islam" />
                            </FormControl>
                            <FormMessage />
                        </FormItem>
                    </FormField>

                    <!-- Nationality -->
                    <FormField name="relative_phone">
                        <FormItem>
                            <FormLabel>Nationality</FormLabel>
                            <FormControl>
                                <Input placeholder="Bangladesh" />
                            </FormControl>
                            <FormMessage />
                        </FormItem>
                    </FormField>

                    <!-- Nid -->
                    <FormField name="relative_phone">
                        <FormItem>
                            <FormLabel>Nid</FormLabel>
                            <FormControl>
                                <Input placeholder="123456789" />
                            </FormControl>
                            <FormMessage />
                        </FormItem>
                    </FormField>

                    <!-- Joining Date -->
                    <FormField name="dob">
                        <FormItem class="flex flex-col w-full">
                            <FormLabel>Joining Date</FormLabel>
                            <Popover>
                                <PopoverTrigger as-child>
                                    <FormControl>
                                        <Button
                                            variant="outline"
                                            :class="
                                                cn(
                                                    'w-[240px] ps-3 text-start font-normal',
                                                    !value &&
                                                        'text-muted-foreground',
                                                )
                                            "
                                        >
                                            <span>{{
                                                value
                                                    ? df.format(toDate(value))
                                                    : 'Pick a date'
                                            }}</span>
                                            <CalendarIcon
                                                class="ms-auto h-4 w-4 opacity-50"
                                            />
                                        </Button>
                                        <input hidden />
                                    </FormControl>
                                </PopoverTrigger>
                                <PopoverContent class="w-auto p-0">
                                    <Calendar
                                        v-model:placeholder="placeholder"
                                        :model-value="value"
                                        calendar-label="Date of birth"
                                        initial-focus
                                        :min-value="
                                            new CalendarDate(1900, 1, 1)
                                        "
                                        :max-value="today(getLocalTimeZone())"
                                        @update:model-value="
                                            (v) => {
                                                if (v) {
                                                    setFieldValue(
                                                        'dob',
                                                        v.toString(),
                                                    );
                                                } else {
                                                    setFieldValue(
                                                        'dob',
                                                        undefined,
                                                    );
                                                }
                                            }
                                        "
                                    />
                                </PopoverContent>
                            </Popover>
                            <FormDescription>
                                Select user joining date.
                            </FormDescription>
                            <FormMessage />
                        </FormItem>
                    </FormField>
                </div>
            </form>
        </div>
    </AppLayout>
</template>

<style lang="scss" scoped></style>

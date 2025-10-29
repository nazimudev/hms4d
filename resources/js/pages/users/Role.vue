<script setup>
import AppLayout from '@/layouts/AppLayout.vue';
// import { type BreadcrumbItem } from '@/types';
import { Head, router, useForm } from '@inertiajs/vue3';
import axios from 'axios';
import { Pencil, Trash2 } from 'lucide-vue-next';
import { computed, onMounted, ref } from 'vue';
import { toast } from 'vue-sonner';
import { usePage } from '@inertiajs/vue3'

// তারপর
const breadcrumbs = [
    { title: 'Dashboard', href: '/dashboard' },
    { title: 'Role', href: '#' },
];


// ✅ Props from Inertia
const props = defineProps({
    roles: Object,
    permissions: Array,
});


// ✅ Local states
const users = ref([])
const userRoles = ref([])     // ✅ নির্দিষ্ট user এর roles
const allRoles = ref([])      // ✅ backend থেকে roles list (যদি API call লাগে)
const selectedUser = ref(null)
const assignedRoles = ref([])
const loading = ref(false)

// ✅ get all users
const getUsers = async () => {
  try {
    const res = await axios.get('/users/select')
    users.value = res.data
  } catch (err) {
    toast.error('Failed to load users')
  }
}

// ✅ get roles for a selected user
const getUserRoles = async (userId) => {
  if (!userId) return
  loading.value = true
  try {
    const res = await axios.get(`/users/${userId}/roles`)
    userRoles.value = res.data.roles || []
    assignedRoles.value = res.data.assigned || []
  } catch (err) {
    toast.error('Failed to load user roles')
  } finally {
    loading.value = false
  }
}

// ✅ toggle role
const toggleRole = (roleId) => {
  if (assignedRoles.value.includes(roleId)) {
    assignedRoles.value = assignedRoles.value.filter(r => r !== roleId)
  } else {
    assignedRoles.value.push(roleId)
  }
}

// ✅ save roles
const saveRoles = async () => {
  try {
    await axios.post(`/users/${selectedUser.value}/roles`, {
      roles: assignedRoles.value,
    })
    toast.success('User roles updated successfully!')
  } catch (err) {
    toast.error('Failed to update roles')
  }
}

// ✅ on mount
onMounted(() => {
  getUsers()
})

// ✅ Role creation form
const form = useForm({
  name: '',
  display_name: '',
  description: '',
})

// ✅ create new role
const createRole = () => {
    form.post('/users/role/store', {
        onSuccess: () => {
            const { flash } = usePage().props;
            const message = flash?.success || 'Role created successfully';

            toast.success(message, {
                description: `${form.display_name} has been added.`,
                action: {
                    label: 'Ok',
                    onClick: () => toast.dismiss(),
                },
            });
            form.reset();
        },
        onError: () => {
            const { flash } = usePage().props;
            const errorMessage = flash?.error || 'Failed to create role';

            toast.error(errorMessage, {
                action: {
                    label: 'Retry',
                    onClick: () => toast.dismiss(),
                },
            });
        },
    });
};

// ✅ delete role
const deleteRole = (id) => {
  toast.info('Are you sure you want to delete this role?', {
    description: 'This action cannot be undone.',
    action: {
      label: 'Confirm',
      onClick: () => {
        router.delete(`/users/roles/${id}`, {
          onSuccess: () => toast.success('Role deleted successfully!'),
          onError: () => toast.error('Failed to delete role.'),
        })
      },
    },
  })
}

// ✅ Group permissions by category
const groupedPermissions = computed(() => {
  return (props.permissions || []).reduce((groups, perm) => {
    (groups[perm.category] = groups[perm.category] || []).push(perm)
    return groups
  }, {})
})




function goToPage(page) {
    router.get(`/users/role?page=${page}`, {}, { preserveState: true });
}

function editRole(role) {
    // এখানে তোমার edit modal বা form open করার লজিক দাও
    console.log('Editing:', role);
}

</script>

<template>
    <Head title="Role & Permissions" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex flex-col gap-6 overflow-x-auto p-6">
            <!-- 🔹 Top Section: Role Form & Role List -->
            <div class="grid grid-cols-1 gap-6 md:grid-cols-3">
                <!-- 🧩 Left: Create Role Form (1/3 width) -->
                <div
                    class="col-span-1 rounded-xl border bg-white p-5 dark:border-sidebar-border dark:bg-gray-900"
                >
                    <h2 class="mb-4 text-lg font-semibold">Create New Role</h2>
                    <form @submit.prevent="createRole">
                        <div class="space-y-4">
                            <div>
                                <label class="text-sm text-gray-600"
                                    >Role Name</label
                                >
                                <input
                                    v-model="form.name"
                                    type="text"
                                    class="form-input mt-1 block w-full rounded-md border-gray-300 p-2 text-sm ring-1 focus:border-indigo-500 focus:ring-indigo-500"
                                    placeholder="Role name"
                                />
                            </div>

                            <div>
                                <label class="text-sm text-gray-600"
                                    >Display Name</label
                                >
                                <input
                                    v-model="form.display_name"
                                    type="text"
                                    class="form-input mt-1 block w-full rounded-md border-gray-300 p-2 text-sm ring-1 focus:border-indigo-500 focus:ring-indigo-500"
                                    placeholder="Display name"
                                />
                            </div>

                            <div>
                                <label class="text-sm text-gray-600"
                                    >Description</label
                                >
                                <textarea
                                    v-model="form.description"
                                    rows="2"
                                    class="form-input mt-1 block w-full rounded-md border-gray-300 p-2 text-sm ring-1 focus:border-indigo-500 focus:ring-indigo-500"
                                    placeholder="Short description"
                                ></textarea>
                            </div>

                            <button
                                type="submit"
                                class="rounded-md bg-indigo-600 px-4 py-2 font-medium text-white transition hover:bg-indigo-700"
                            >
                                Create Role
                            </button>
                        </div>
                    </form>
                </div>

                <!-- 📋 Right: Role List (2/3 width) -->
                <div
                    class="col-span-2 rounded-xl border bg-white p-5 dark:border-sidebar-border dark:bg-gray-900"
                >
                    <h2 class="mb-4 text-lg font-semibold">All Roles</h2>

                    <!-- যদি roles ফাঁকা থাকে -->
                    <div
                        v-if="!roles.data || roles.data.length === 0"
                        class="py-8 text-center text-gray-500"
                    >
                        <i
                            class="mdi mdi-information-outline mb-2 text-3xl"
                        ></i>
                        <p>Role Data Empty...</p>
                    </div>

                    <!-- যদি roles থাকে -->
                    <div v-else class="overflow-x-auto">
                        <table
                            class="min-w-full rounded-lg border border-gray-200 text-sm"
                        >
                            <thead class="bg-gray-100 dark:bg-gray-800">
                                <tr>
                                    <th class="px-4 py-2 text-left">#</th>
                                    <th class="px-4 py-2 text-left">
                                        Display Name
                                    </th>
                                    <th class="px-4 py-2 text-left">
                                        Role Name
                                    </th>
                                    <th class="px-4 py-2 text-left">
                                        Description
                                    </th>
                                    <th class="px-4 py-2 text-center">
                                        Actions
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr
                                    v-for="(r, i) in roles.data"
                                    :key="r.id"
                                    class="border-t transition hover:bg-gray-50 dark:hover:bg-gray-800"
                                >
                                    <td class="px-4 py-2">
                                        {{
                                            (roles.current_page - 1) *
                                                roles.per_page +
                                            i +
                                            1
                                        }}
                                    </td>
                                    <td class="px-4 py-2">
                                        {{ r.display_name }}
                                    </td>
                                    <td class="px-4 py-2 text-gray-600">
                                        {{ r.name }}
                                    </td>
                                    <td class="px-4 py-2 text-gray-500">
                                        {{ r.description }}
                                    </td>
                                    <td class="px-4 py-2 text-center">
                                        <button
                                            @click="editRole(r)"
                                            class="mx-1 rounded-sm bg-gray-700 p-1 text-blue-600 hover:text-blue-800"
                                            title="Edit"
                                        >
                                            <Pencil
                                                class="h-5 w-5 text-white"
                                            />
                                        </button>
                                        <button
                                            @click="deleteRole(r.id)"
                                            class="mx-1 rounded-sm bg-red-500 p-1 text-red-600 hover:text-red-800"
                                            title="Delete"
                                        >
                                            <Trash2
                                                class="h-5 w-5 text-white"
                                            />
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <!-- 📄 Pagination -->
                    <div
                        v-if="roles.data && roles.data.length"
                        class="mt-4 flex items-center justify-between"
                    >
                        <span class="text-sm text-gray-500">
                            Showing {{ roles.from }} - {{ roles.to }} of
                            {{ roles.total }}
                        </span>
                        <div class="flex gap-2">
                            <button
                                :disabled="!roles.prev_page_url"
                                @click="goToPage(roles.current_page - 1)"
                                class="rounded bg-gray-200 px-3 py-1 text-sm hover:bg-gray-300 disabled:opacity-50"
                            >
                                Prev
                            </button>
                            <button
                                :disabled="!roles.next_page_url"
                                @click="goToPage(roles.current_page + 1)"
                                class="rounded bg-gray-200 px-3 py-1 text-sm hover:bg-gray-300 disabled:opacity-50"
                            >
                                Next
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- 🔸 Bottom Section: Permissions -->
            <div
                class="rounded-xl border bg-white p-5 dark:border-sidebar-border dark:bg-gray-900"
            >
                <h2 class="mb-4 border-b pb-2 text-lg font-semibold">
                    Assign Role To Users
                </h2>

                <!-- User Dropdown -->

                <form class="max-w-sm mx-auto">
                <label for="countries" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Select an Users</label>
                <select v-model="selectedUser"
                    @change="getUserRoles(selectedUser)" id="countries" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option disabled selected>Choose a users</option>
                    <option
                        v-for="user in users"
                        :key="user.id"
                        :value="user.id"
                    >
                        {{ user.name }}
                    </option>
                </select>
                </form>

                <!-- Loading Text -->
                <div v-if="loading">Loading roles...</div>

                <!-- Role List -->
                <div v-else class="mt-3 grid grid-cols-3 gap-3">
                    <div
                        v-for="r in userRoles"
                        :key="r.id"
                        class="flex items-center gap-2"
                    >
                        <input
                            type="checkbox"
                            :checked="assignedRoles.includes(r.id)"
                            @change="toggleRole(r.id)"
                        />
                        <label>{{ r.name }}</label>
                    </div>
                </div>

                <!-- Save Button -->
                <button
                    v-if="selectedUser"
                    @click="saveRoles"
                    class="rounded-lg bg-gray-700 px-4 py-2 mt-5 text-white hover:bg-gray-800"
                >
                    Assign Roles
                </button>
            </div>
        </div>
    </AppLayout>
</template>

<style lang="scss" scoped></style>

<script setup>
import AppLayout from '@/layouts/AppLayout.vue';
import { dashboard } from '@/routes';
import { Head } from '@inertiajs/vue3';

import { ref, onMounted } from 'vue'
import axios from 'axios'
import { toast } from 'vue-sonner'

const roles = ref([])
const permissions = ref([])
const selectedRole = ref(null)
const assignedPermissions = ref([])
const loading = ref(false)

const getRoles = async () => {
  const res = await axios.get('/roles')
  roles.value = res.data
}

const getRolePermissions = async (roleId) => {
  loading.value = true
  const res = await axios.get(`/roles/${roleId}/permissions`)
  permissions.value = res.data.permissions
  assignedPermissions.value = res.data.assigned
  loading.value = false
}

const togglePermission = (id) => {
  if (assignedPermissions.value.includes(id)) {
    assignedPermissions.value = assignedPermissions.value.filter(p => p !== id)
  } else {
    assignedPermissions.value.push(id)
  }
}

const now = new Date()
const formatted = now.toLocaleString('en-US', {
  weekday: 'long',
  month: 'long',
  day: '2-digit',
  year: 'numeric',
  hour: '2-digit',
  minute: '2-digit',
  hour12: true,
})

const savePermissions = async () => {
  await axios.post(`/roles/${selectedRole.value}/permissions`, {
    permissions: assignedPermissions.value
  })
//   alert('Permissions updated!')
    toast('Permission Assigne Successfully', {
        description: formatted,
        action: {
          label: 'Ok',
          onClick: () => toast.dismiss,
        },
      })
}

onMounted(() => {
  getRoles()
})



</script>

<template>
    <Head title="Create User" />
    <AppLayout>
        <div class="flex flex-col gap-6 overflow-x-auto p-6">

            <div class="rounded-xl border bg-white p-5 dark:border-sidebar-border dark:bg-gray-900">
                <h2 class="text-xl font-bold border-b pb-2">Assign Role Permission</h2>

            <form class="max-w-sm mx-auto">
                <label for="countries" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Select an Roles</label>
                <select v-model="selectedRole"
                    @change="getRolePermissions(selectedRole)" id="countries" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option disabled selected>Choose a users</option>
                    <option
                        v-for="role in roles"
                        :key="role.id"
                        :value="role.id">
                        {{ role.name }}
                    </option>
                </select>
            </form>
            <!-- Permissions -->
            <div v-if="permissions.length && !loading" class="grid grid-cols-4 mt-5 gap-2">
            <div v-for="p in permissions" :key="p.id" class="flex items-center gap-2">
                <input
                type="checkbox"
                :value="p.id"
                :checked="assignedPermissions.includes(p.id)"
                @change="togglePermission(p.id)"
                />
                <label>{{ p.name }}</label>
            </div>
            </div>

            <div v-if="loading">Loading permissions...</div>

            <button
            v-if="selectedRole"
            @click="savePermissions"
            class="bg-green-500 text-white px-4 py-2 mt-5 rounded hover:bg-green-600"
            >
            Assign Permissions
            </button>
            </div>
        </div>
    </AppLayout>
</template>


<style lang="scss" scoped>

</style>

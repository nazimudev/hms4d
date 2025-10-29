// useAuth.ts
import { computed } from 'vue'
import { usePage } from '@inertiajs/vue3'

interface PageProps {
  name: string
  quote: { message: string; author: string }
  sidebarOpen: boolean
  auth: {
    user: any
    permissions: string[]
    roles: string[]
  }
  flash?: Record<string, any>
  errors?: Record<string, any>
}

export function useAuth() {
  const page = usePage<PageProps>() // ✅ সঠিক type

  const user = computed(() => page.props.auth.user)
  const permissions = computed(() => page.props.auth.permissions || [])
  const roles = computed(() => page.props.auth.roles || [])

  const can = (permission: string) => permissions.value.includes(permission)
  const hasRole = (role: string) => roles.value.includes(role)

  return { user, permissions, roles, can, hasRole }
}

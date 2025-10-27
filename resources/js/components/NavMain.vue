<script setup lang="ts">
/**
 * NavMain.vue
 * Permission-aware recursive sidebar menu
 */

import {
  SidebarGroup,
  SidebarGroupLabel,
  SidebarMenu,
  SidebarMenuButton,
  SidebarMenuItem,
  SidebarSubMenu,
} from '@/components/ui/sidebar'
import { urlIsActive } from '@/lib/utils'
import { type NavItem } from '@/types'
import { Link, usePage } from '@inertiajs/vue3'
import { ChevronDown } from 'lucide-vue-next'
import { computed, ref } from 'vue'
import { useAuth } from '@/utils/useAuth'

// 🔹 Get current user permissions
const { can } = useAuth()

// Props
const props = defineProps<{ items: NavItem[] }>()

// Page & state
const page = usePage()
const openSubMenus = ref<string[]>([])

// Toggle submenu open/close
const toggleSubMenu = (title: string) => {
  if (openSubMenus.value.includes(title)) {
    openSubMenus.value = openSubMenus.value.filter((t) => t !== title)
  } else {
    openSubMenus.value.push(title)
  }
}

// Detect active route recursively
const isCurrentRoute = (item: NavItem): boolean => {
  if (item.href && urlIsActive(item.href, page.url)) return true
  if (item.children) {
    return item.children.some((child) => isCurrentRoute(child))
  }
  return false
}

// Filter items based on permission (without overwriting original array)
const filteredItems = computed(() =>
  props.items
    .map((item) => {
      if (item.children) {
        const filteredChildren = item.children.filter(
          (child) => !child.permission || can(child.permission)
        )
        if (filteredChildren.length) {
          return { ...item, children: filteredChildren }
        }
        return null
      }

      if (!item.permission || can(item.permission)) return item
      return null
    })
    .filter(Boolean) as NavItem[]
)
</script>

<template>
  <SidebarGroup class="px-2 py-0">
    <SidebarGroupLabel>Platform</SidebarGroupLabel>

    <SidebarMenu>
      <template v-for="item in filteredItems" :key="item.title">
        <SidebarMenuItem>
          <!-- If item has children -->
          <template v-if="item.children && item.children.length">
            <SidebarMenuButton
              :is-active="isCurrentRoute(item)"
              @click="toggleSubMenu(item.title)"
              class="flex items-center justify-between"
            >
              <div class="flex items-center space-x-2">
                <component :is="item.icon" class="w-4 h-4" />
                <span>{{ item.title }}</span>
              </div>
              <ChevronDown
                class="transition-transform duration-200"
                :class="{ 'rotate-180': openSubMenus.includes(item.title) }"
              />
            </SidebarMenuButton>

            <transition name="fade">
              <SidebarSubMenu
                v-if="openSubMenus.includes(item.title)"
                class="ml-4 border-l pl-3"
              >
                <template v-for="subItem in item.children" :key="subItem.title">
                  <SidebarMenuItem>
                    <!-- Recursive children -->
                    <template v-if="subItem.children && subItem.children.length">
                      <SidebarMenuButton
                        :is-active="isCurrentRoute(subItem)"
                        @click="toggleSubMenu(subItem.title)"
                        class="flex items-center justify-between"
                      >
                        <div class="flex items-center space-x-2">
                          <component v-if="subItem.icon" :is="subItem.icon" class="w-4 h-4" />
                          <span>{{ subItem.title }}</span>
                        </div>
                        <ChevronDown
                          class="transition-transform duration-200"
                          :class="{ 'rotate-180': openSubMenus.includes(subItem.title) }"
                        />
                      </SidebarMenuButton>

                      <transition name="fade">
                        <SidebarSubMenu
                          v-if="openSubMenus.includes(subItem.title)"
                          class="ml-4 border-l pl-3"
                        >
                          <SidebarMenuItem
                            v-for="child in subItem.children"
                            :key="child.title"
                          >
                            <SidebarMenuButton
                              as-child
                              :is-active="urlIsActive(child.href, page.url)"
                              :tooltip="child.title"
                            >
                              <Link :href="child.href">
                                <component v-if="child.icon" :is="child.icon" class="w-4 h-4" />
                                <span>{{ child.title }}</span>
                              </Link>
                            </SidebarMenuButton>
                          </SidebarMenuItem>
                        </SidebarSubMenu>
                      </transition>
                    </template>

                    <!-- Leaf menu -->
                    <template v-else>
                      <SidebarMenuButton
                        as-child
                        :is-active="urlIsActive(subItem.href, page.url)"
                        :tooltip="subItem.title"
                      >
                        <Link :href="subItem.href">
                          <component v-if="subItem.icon" :is="subItem.icon" class="w-4 h-4" />
                          <span>{{ subItem.title }}</span>
                        </Link>
                      </SidebarMenuButton>
                    </template>
                  </SidebarMenuItem>
                </template>
              </SidebarSubMenu>
            </transition>
          </template>

          <!-- Single-level item -->
          <template v-else>
            <SidebarMenuButton
              as-child
              :is-active="urlIsActive(item.href, page.url)"
              :tooltip="item.title"
            >
              <Link :href="item.href">
                <component v-if="item.icon" :is="item.icon" class="w-4 h-4" />
                <span>{{ item.title }}</span>
              </Link>
            </SidebarMenuButton>
          </template>
        </SidebarMenuItem>
      </template>
    </SidebarMenu>
  </SidebarGroup>
</template>

<style scoped>
.fade-enter-active,
.fade-leave-active {
  transition: all 0.2s ease;
}
.fade-enter-from,
.fade-leave-to {
  opacity: 0;
  max-height: 0;
}
.fade-enter-to,
.fade-leave-from {
  opacity: 1;
  max-height: 500px;
}

.border-l {
  border-left: 1px solid rgba(255, 255, 255, 0.1);
}
</style>

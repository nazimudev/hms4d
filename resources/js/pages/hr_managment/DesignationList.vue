<script setup>
import { Button } from '@/components/ui/button';
import { Table, TableBody, TableCell, TableHead, TableHeader, TableRow, TableEmpty } from '@/components/ui/table';
import { Dialog, DialogContent, DialogDescription, DialogFooter, DialogHeader, DialogTitle, DialogTrigger, DialogClose } from '@/components/ui/dialog'
import AppLayout from '@/layouts/AppLayout.vue';
import { dashboard } from '@/routes';
import { Head, Link, router, usePage } from '@inertiajs/vue3';
import { Edit, Trash2 } from 'lucide-vue-next';
import { toast } from 'vue-sonner';
import { computed } from "vue";

const breadcrumbs = [
    { title: 'Dashboard', href: dashboard().url },
    { title: 'Designation List', href: '#' },
];

// const { props } = usePage();
// const designations = props.designations.data || [];
// const pagination = props.designations;

const designations = computed(() => usePage().props.designations.data || []);
const pagination = computed(() => usePage().props.designations);

function goToPage(page) {
    router.get(`/designation/list?page=${page}`, {}, { preserveScroll: true });
}




const handleEdit = (id) => {
    router.visit(`/designations/${id}/edit`);
};

const handleDelete = (id) => {
    router.delete(`/designation/${id}`, {
        preserveScroll: true,
        preserveState: true,
        onSuccess: () => {
            toast.success('Designation deleted successfully!');
            router.reload({ only: ['designations'] }); // রিফ্রেশ শুধু designations প্রপ
        },
        onError: () => {
            toast.error('Failed to delete designation.');
        },
        onFinish: () => {
            console.log("Delete request finished.");
        }
    });
};


</script>

<template>
  <div>
    <Head title="Designation List" />
    <AppLayout :breadcrumbs="breadcrumbs">
      <div class="p-10">
        <div class="mb-4 flex items-center justify-between">
          <h2 class="mb-4 text-xl font-semibold">Designation List</h2>

          <Link href="/create/designation" class="mb-4">
            <Button>Add Designation</Button>
          </Link>
        </div>

        <div class="p-5 shadow rounded-2xl">
          <Table>
            <TableHeader>
              <TableRow>
                <TableHead>ID</TableHead>
                <TableHead>Name</TableHead>
                <TableHead>Description</TableHead>
                <TableHead>Created At</TableHead>
                <TableHead>Actions</TableHead>
              </TableRow>
            </TableHeader>

            <TableBody>
              <TableRow v-for="(item, index) in designations" :key="item.id">
                <TableCell>{{ (pagination.current_page - 1) * pagination.per_page + (index + 1) }}</TableCell>
                <TableCell>{{ item.name || '—' }}</TableCell>
                <TableCell>{{ item.description || '—' }}</TableCell>
                <TableCell>
                  {{ new Date(item.created_at).toLocaleDateString() }}
                </TableCell>
                <TableCell>
                  <div class="flex space-x-2">
                    <Button
                      size="icon"
                      variant="outline"
                      @click="handleEdit(item.id)"
                    >
                      <Edit class="h-4 w-4 text-blue-600" />
                    </Button>

                    <Dialog>
                      <!-- 🟡 Dialog Trigger শুধু ওপেন করার জন্য -->
                      <DialogTrigger as-child>
                        <Button size="icon" variant="destructive">
                          <Trash2 class="h-4 w-4 text-white" />
                        </Button>
                      </DialogTrigger>

                      <!-- 🟢 Dialog Content -->
                      <DialogContent class="sm:max-w-md dialog-center">
                        <DialogHeader>
                          <DialogTitle>Delete Designation</DialogTitle>
                          <DialogDescription>
                            Are you sure you want to delete this item?
                          </DialogDescription>
                        </DialogHeader>

                        <DialogFooter class="sm:justify-end space-x-2">
                          <!-- ❌ Delete Confirm Button -->
                           <DialogClose as-child>
                            <Button
                            type="button"
                            variant="destructive"
                            @click="handleDelete(item.id)"
                            >
                                Yes, Delete
                            </Button>
                           </DialogClose>
                          <!-- ✅ Close Button -->
                          <DialogClose as-child>
                            <Button type="button" variant="secondary">
                              Close
                            </Button>
                          </DialogClose>
                        </DialogFooter>
                      </DialogContent>
                    </Dialog>
                  </div>
                </TableCell>
              </TableRow>
            </TableBody>
            <!-- item is empty show this table cell-->
            <TableEmpty v-if="designations.length === 0" :colspan="5">
                <Link href="/create/designation" class="mb-4">
                    No Designation Found! <span class="text-red-400 underline">Create New</span>
                </Link>
            </TableEmpty>

          </Table>
            <!-- 📄 Pagination -->
            <div
                v-if="pagination.data && pagination.data.length"
                class="mt-4 flex items-center justify-between"
            >
                <span class="text-sm text-gray-500">
                    Showing {{ pagination.from }} - {{ pagination.to }} of
                    {{ pagination.total }}
                </span>
                <div class="flex gap-2">
                    <button
                        :disabled="!pagination.prev_page_url"
                        @click="goToPage(pagination.current_page - 1)"
                        class="rounded bg-gray-200 px-3 py-1 text-sm hover:bg-gray-300 disabled:opacity-50"
                    >
                        Prev
                    </button>
                    <button
                        :disabled="!pagination.next_page_url"
                        @click="goToPage(pagination.current_page + 1)"
                        class="rounded bg-gray-200 px-3 py-1 text-sm hover:bg-gray-300 disabled:opacity-50"
                    >
                        Next
                    </button>
                </div>
            </div>
        </div>
      </div>
    </AppLayout>
  </div>
</template>

<style scoped>
/* optional custom style */

</style>

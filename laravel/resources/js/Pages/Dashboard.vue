<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout> 
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <fileViewer></fileViewer>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script>
import fileViewer from '@/Components/FileViewer.vue'

export default {
  components: {
    fileViewer
  }
}
</script>

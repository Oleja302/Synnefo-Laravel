<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout> 
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg w-50 h-50 d-flex mx-auto">
                    <upload></upload>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script>
import upload from '@/Components/Uploader.vue'

export default {
  components: {
    upload
  }
}
</script>

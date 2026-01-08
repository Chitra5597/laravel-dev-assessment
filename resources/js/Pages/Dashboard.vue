<script setup lang="ts">
import { reactive, watch } from 'vue';
import { router, Head, usePage } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import Hero from '@/Components/Dashboard/Hero.vue';
import JobCard from '@/Components/JobCard.vue';

const page = usePage();

const filters = reactive({
  search: page.props.filters?.search ?? '',
  location: page.props.filters?.location ?? '',
  skill: page.props.filters?.skill ?? '',
});

// Auto-search when filters change

function applyFilters() {
  router.get(route('dashboard'), {
    search: filters.search || undefined,
    location: filters.location || undefined,
    skill: filters.skill || undefined,
  }, {
    preserveState: true,
    replace: true,
  });
}
</script>

<template>
  <Head title="Dashboard" />

  <AuthenticatedLayout>
    <Hero
    v-model:search="filters.search"
    v-model:location="filters.location"
    @search="applyFilters"
    />


    <div class="bg-white">
      <div class="container py-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
          <JobCard
            v-for="job in page.props.jobs.data"
            :key="job.id"
            :job="job"
          />

          <div v-if="page.props.jobs.data.length === 0"
               class="col-span-full text-center py-12 text-slate-500">
            No jobs found.
          </div>
        </div>

        <!-- Pagination -->
        <div class="mt-8 flex justify-center">
          <button
            v-for="link in page.props.jobs.links"
            :key="link.label"
            :disabled="!link.url"
            v-html="link.label"
            @click="router.visit(link.url)"
            class="px-3 py-1 border rounded mx-1"
            :class="{
              'bg-slate-100 font-semibold': link.active,
              'text-gray-400': !link.url
            }"
          />
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>

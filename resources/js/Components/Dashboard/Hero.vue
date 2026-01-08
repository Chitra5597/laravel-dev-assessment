

<script setup lang="ts">
import Icon from '@/Components/Icon.vue';

defineProps({
  search: String,
  location: String,
});

const emit = defineEmits(['update:search', 'update:location', 'search']);

function submit() {
  emit('search');
}
</script>

<template>
    <div class="bg-slate-100 relative">
        <div class="container py-32 text-center flex flex-col gap-8 relative">
            <div class="space-y-4">
                <h1 class="text-3xl lg:text-6xl font-bold">Find your dream job</h1>
                <p class="text-sm lg:text-base text-slate-600">
                    Looking for jobs? Browse our latest job openings to view & apply to the best jobs today!
                </p>
            </div>

            <!-- Search -->
            <div>
                <div
                    class="bg-white w-full border rounded-full overflow-hidden border-gray-200 max-w-3xl mx-auto flex items-center justify-center">

                    <!-- Search -->
                    <div class="flex-1 flex items-center border-r">
                        <span class="pl-5">
                            <Icon name="search" class="w-4 h-4 text-slate-400" />
                        </span>
                        <input
                            :value="search"
                            @input="$emit('update:search', $event.target.value)"
                            placeholder="Job title or keyword"
                            class="py-4 w-full shadow-none border-none focus:outline-none"
                            type="text"
                        >
                    </div>

                    <!-- Location -->
                    <div class="flex-1 flex items-center">
                        <span class="pl-5">
                            <Icon name="location" class="w-4 h-4 text-slate-400" />
                        </span>
                        <input
                            :value="location"
                            @input="$emit('update:location', $event.target.value)"
                            placeholder="Location"
                            class="py-4 w-full shadow-none border-none focus:outline-none"
                            type="text"
                        >
                    </div>

                    <!-- Button (optional) -->
                    <div class="pr-3">
                        <button
                            @click="submit"
                            class="bg-brand px-6 text-sm font-medium py-2 rounded-full text-white mr-3"
                            >
                            Find jobs
                            </button>
                    </div>

                </div>
            </div>
        </div>
    </div>
</template>

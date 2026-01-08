<script setup lang="ts">
import { defineProps, computed } from 'vue';
import Icon from '@/Components/Icon.vue';

const props = defineProps({
  job: {
    type: Object,
    required: true,
  },
});

const job = computed(() => props.job || {});

function shortDesc(text: string | null | undefined, max = 220) {
  if (!text) return '';
  if (text.length <= max) return text;
  return text.substring(0, max).trim() + '...';
}

function timeAgo(date: string | null | undefined) {
    if (!date) return '';

    const seconds = Math.floor((Date.now() - new Date(date).getTime()) / 1000);

    if (seconds < 60) return 'less than a minute';
    if (seconds < 3600) return `${Math.floor(seconds / 60)} min ago`;
    if (seconds < 86400) return `${Math.floor(seconds / 3600)} hours ago`;
    if (seconds < 2592000) return `${Math.floor(seconds / 86400)} days ago`;

    return `${Math.floor(seconds / 2592000)} month ago`;
}
</script>

<template>
    <div class="border rounded-xl p-6 shadow-sm hover:shadow-md transition bg-white h-full flex flex-col">

        <div class="flex gap-4 items-start flex-1">
        <!-- Logo -->
        <div class="w-20 h-20 flex-shrink-0 flex items-center justify-center bg-white rounded-lg">
            <img v-if="job.logo" :src="job.logo" alt="logo" class="w-16 h-16 object-contain" />
            <div v-else class="w-16 h-16 bg-slate-100 rounded" />
            </div>

            <div class="flex-1">
                <!-- Title and badges row -->
                <div class="flex items-start justify-between">
                    <div>
                        <h3 class="font-bold text-xl text-slate-800">{{ job.job_title || job.title }}</h3>
                        <p class="text-sm text-slate-500 mt-1">{{ job.company_name || job.company }}</p>
                    </div>

                    <div class="flex items-center gap-2">
                        <template v-for="(b, idx) in (job.extra_info || [])" :key="idx">
                        <span class="px-3 py-1 text-sm bg-slate-100 text-slate-700 rounded-full">{{ b }}</span>
                        </template>
                    </div>
                </div>

                <!-- Meta icons -->
                <div class="mt-4 flex items-center gap-6 text-sm text-slate-500">
                    <div class="flex items-center gap-2">
                            <Icon name="briefcase" class="w-4 h-4 text-slate-400" />
                            <span>{{ job.experience || '' }}</span>
                    </div>

                    <div class="flex items-center gap-2">
                            <Icon name="rupee" class="w-4 h-4 text-slate-500" />
                            <span>{{ job.salary || '' }}</span>
                    </div>

                    <div class="flex items-center gap-2">
                            <Icon name="location" class="w-4 h-4 text-slate-400" />
                            <span>{{ job.location || '' }}</span>
                    </div>
                </div>

                <!-- Description -->
                <div class="mt-4 flex items-start gap-3 text-slate-700">
                    <div class="pt-1">
                        <Icon name="file" class="w-5 h-5 text-slate-400" />
                    </div>
                    <p class="text-sm leading-relaxed flex-1">{{ shortDesc(job.description, 220) }}</p>
                </div>

                <!-- Skills tags -->
                <div class="mt-4 flex flex-wrap items-center gap-2">
                    <template v-if="job.skills && job.skills.length">
                        <span v-for="(s, idx) in job.skills" :key="idx" class="text-xs px-3 py-1 bg-slate-100 rounded-full text-slate-700">{{ s }}</span>
                    </template>
                </div>

                <!-- Footer: timestamp -->
                <div class="mt-4 flex justify-end text-xs text-slate-400">
                    <div class="mt-auto flex justify-end text-xs text-slate-400">
                        {{ timeAgo(job.created_at) }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>

import AppLayout from "@/Layouts/AppLayout.vue";

    defineProps({
        event: []
    });
</script>

<template>
    <AppLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ event.title }}
            </h2>
        </template>
        <section>
            <div class="container px-16 mx-auto">
                <div class="grid grid-cols-4">

                </div>
            </div>
        </section>
    </AppLayout>
</template>

<script setup lang="ts">

</script>

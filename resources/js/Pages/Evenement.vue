<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import Welcome from "@/Components/Welcome.vue";

import { Head, Link } from '@inertiajs/vue3';

defineProps({
    events: [],
});

</script>

<template>
    <AppLayout title="Evenement">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Evenements
            </h2>
        </template>

        <div class="flex pl-16 pr-16 mt-16 flex-wrap gap-8 justify-center">
            <div v-for="event in events">
                <div class="relative flex w-96 flex-col rounded-xl min-h-[500px] bg-white bg-clip-border text-gray-700 shadow-md mt-10">
                    <div class="relative mx-4 -mt-6 h-56 overflow-hidden rounded-xl bg-blue-gray-500 bg-clip-border text-white shadow-lg shadow-blue-gray-500/40">
                        <img
                            src="https://images.unsplash.com/photo-1540553016722-983e48a2cd10?ixlib=rb-1.2.1&amp;ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&amp;auto=format&amp;fit=crop&amp;w=800&amp;q=80"
                            alt="img-blur-shadow"
                            layout="fill"
                        />
                    </div>
                    <div class="p-6">
                        <h5 class="mb-2 block font-sans text-xl font-semibold leading-snug tracking-normal text-blue-gray-900 antialiased">
                            <p v-text="event.title"></p>
                        </h5>
                        <p class="block font-sans text-base font-light leading-relaxed text-inherit antialiased" v-text="event.content"></p>
                    </div>
                    <div class="p-6 pt-0 mt-auto">
                        <a :href="route('getEvent', {'id': event.id})">
                            <button
                                class="select-none rounded-lg bg-[#818CF8] py-3 px-6 text-center align-middle font-sans text-xs font-bold uppercase text-white shadow-md shadow-pink-500/20 transition-all hover:shadow-lg hover:shadow-pink-500/40 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                                type="button"
                                data-ripple-light="true"
                            >
                                Lire plus..
                            </button>
                        </a>
                    </div>
                </div>
            </div>
        </div>

    </AppLayout>
</template>

<style scoped>

</style>

<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import { router } from '@inertiajs/vue3'
import FilterEvent from "@/Components/FilterEvent.vue";

defineProps({
    events: [],
    storagePath: '',
    flash: Object,
    links: Object
});

function participate(eventId) {
    router.post('/event/participate', {'eventId': eventId});
}

</script>

<template>
    <AppLayout title="Evenement">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Evenements
            </h2>
        </template>

        <FilterEvent></FilterEvent>

        <div class="flex pl-16 pr-16 mt-16 flex-wrap gap-8 justify-center">
            <div v-for="event in events">
                <div class="relative flex w-96 flex-col rounded-xl min-h-[500px] bg-white bg-clip-border text-gray-700 shadow-md mt-10">
                    <div class="relative mx-4 -mt-6 h-56 overflow-hidden rounded-xl bg-blue-gray-500 bg-clip-border text-white shadow-lg shadow-blue-gray-500/40">
                        <img
                            :src="storagePath + event.thumbnail"
                            layout="fill"
                            @click="console.log($page.props.flash.success)"
                        />
<!--                        <img :src="storagePath" alt="">-->
                    </div>
                    <div class="p-6">
                        <h5 class="mb-2 block font-sans text-xl font-semibold leading-snug tracking-normal text-blue-gray-900 antialiased">
                            <p v-text="event.title"></p>
                        </h5>
                        <p class="block font-sans text-base font-light leading-relaxed text-inherit antialiased" v-text="event.content"></p>
                    </div>
                    <div class="p-6 pt-0 mt-auto gap-x-4 flex">
                        <a :href="route('getEvent', event)">
                            <button
                                class="select-none rounded-lg bg-[#818CF8] py-3 px-6 text-center align-middle font-sans text-xs font-bold uppercase text-white shadow-md transition-all hover:bg-[#6d77d7] focus:shadow-none active:opacity-[0.85] active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                                type="button"
                                data-ripple-light="true"
                            >
                                Lire plus..
                            </button>
                        </a>
                        <form @submit.prevent="participate(event.id)">
                            <button
                                type="submit"
                                class="select-none rounded-lg bg-[#818CF8] py-3 px-6 text-center align-middle font-sans text-xs font-bold uppercase text-white shadow-md transition-all hover:bg-[#6d77d7] focus:shadow-none active:opacity-[0.85] active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                                data-ripple-light="true"
                                @click="console.log(event)"
                            >
                                Participer
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            <inertia-link v-if="$page.props.events.prev_page_url" :href="$page.props.events.prev_page_url">
                Précédent
            </inertia-link>

            <inertia-link v-if="$page.props.events.next_page_url" :href="$page.props.events.next_page_url">
                Suivant
            </inertia-link>
        </div>
    </AppLayout>
</template>

<style scoped>

</style>

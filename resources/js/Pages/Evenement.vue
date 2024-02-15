<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import { router } from '@inertiajs/vue3'
import FilterEvent from "@/Components/FilterEvent.vue";
import PaginationEvent from "@/Components/PaginationEvent.vue";

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
            <div v-for="event in events.data">
                <div class="relative flex w-96 flex-col rounded-xl min-h-[500px] bg-white bg-clip-border text-gray-700 shadow-md mt-10">
                    <div class="relative mx-4 -mt-6 h-56 overflow-hidden rounded-xl bg-blue-gray-500 bg-clip-border text-white shadow-lg shadow-blue-gray-500/40">
                        <img
                            :src="storagePath + event.thumbnail"
                            layout="fill"
                            @click="console.log($page.props.flash.success)"
                        />
                    </div>
                    <div class="p-6">
                        <h5 class="mb-2 block font-sans text-xl font-semibold leading-snug tracking-normal text-blue-gray-900 antialiased">
                            <p v-text="event.title"></p>
                        </h5>
                        <p class="block font-sans text-base font-light leading-relaxed text-inherit antialiased" v-text="event.content"></p>
                        <div>
                            <p class="text-gray-400" v-text=" 'Prix d\'entrée : ' +  event.price + ' €'"></p>
                            <p class="text-gray-400" v-text=" 'Nombre de participant(s) : ' +  event.price"></p>
                        </div>
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

            <div v-if="$page.props.flash.success" class=" fixed bottom-8 right-8 rounded-lg p-4 bg-green-300 text-green-700 cursor-pointer shadow-md z-50" @click="$page.props.flash.success = null">
                {{ $page.props.flash.success }}
            </div>

            <div v-if="$page.props.flash.error" class=" fixed bottom-8 right-8 rounded-lg p-4 bg-red-300 text-red-700 cursor-pointer shadow-md z-50" @click="$page.props.flash.error = null">
                {{ $page.props.flash.error }}
            </div>
        </div>

        <PaginationEvent :events="events"></PaginationEvent>

    </AppLayout>
</template>

<style scoped>

</style>

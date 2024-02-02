<script setup>
import { Head, Link } from '@inertiajs/vue3';

defineProps({
    canLogin: Boolean,
    canRegister: Boolean,
    laravelVersion: String,
    phpVersion: String,
    nextEvents: Object,
    storagePath: ''
});
</script>

<template>

    <div v-if="canLogin" class="sm:fixed sm:top-0 sm:end-0 p-6 text-end z-10">
        <Link v-if="$page.props.auth.user" :href="route('dashboard')" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Dashboard</Link>

        <template v-else>
            <Link :href="route('login')" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Log in</Link>

            <Link v-if="canRegister" :href="route('register')" class="ms-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Register</Link>
        </template>
    </div>

    <div class="mt-16 container px-16 mx-auto">
        <h1 class="text-4xl font-bold">
            Les prochains évènements
        </h1>
        <div class="grid grid-cols-3 gap-12">
            <div v-for="event in nextEvents" class="self-stretch">
                <div class="relative flex w-96 flex-col rounded-xl min-h-[500px] bg-white bg-clip-border text-gray-700 shadow-md mt-10 h-full">
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
                        <p class="my-2 text-gray-400 font-bold text-sm">
                            Le {{ event.starting_date }}
                        </p>
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
        </div>
    </div>
    <!-- component -->
</template>

<style>
.bg-dots-darker {
    background-image: url("data:image/svg+xml,%3Csvg width='30' height='30' viewBox='0 0 30 30' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z' fill='rgba(0,0,0,0.07)'/%3E%3C/svg%3E");
}
@media (prefers-color-scheme: dark) {
    .dark\:bg-dots-lighter {
        background-image: url("data:image/svg+xml,%3Csvg width='30' height='30' viewBox='0 0 30 30' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z' fill='rgba(255,255,255,0.07)'/%3E%3C/svg%3E");
    }
}
</style>

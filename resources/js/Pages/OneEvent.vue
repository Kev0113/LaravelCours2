<script setup>

    import AppLayout from "@/Layouts/AppLayout.vue";
    import {onMounted} from "vue";
    import {router, useForm} from "@inertiajs/vue3";
    import Comments from "@/Components/Comments.vue";
    import Opinion from "@/Components/Opinion.vue";

    defineProps({
        event: [],
        category: [],
        comments: []
    });

    const form = useForm({
        message : null,
    })

</script>

<template>
    <AppLayout>
        <template #header>
            <h2 @click="console.log(event)" class="font-semibold text-xl text-gray-800 leading-tight">
                {{ event.title }}
            </h2>
        </template>

        <section class="relative pt-12 bg-blueGray-50 mt-16">
            <div class="flex flex-wrap">
                <div class="w-[450px] h-[450px] ml-auto">
                    <img alt="..." class="w-full h-full object-cover rounded-lg shadow-lg" src="https://images.unsplash.com/photo-1555212697-194d092e3b8f?ixlib=rb-1.2.1&amp;ixid=eyJhcHBfaWQiOjEyMDd9&amp;auto=format&amp;fit=crop&amp;w=634&amp;q=80">
                </div>
                <div class="w-full md:w-5/12 ml-auto mr-auto px-4">
                    <div class="md:pr-12">
                        <div class="flex items-center gap-x-5">
                            <div class="text-[#6875F5] p-3 text-center inline-flex items-center justify-center w-16 h-16 mb-6 shadow-lg rounded-full bg-[#6875F5] mt-8">
                                <i class='bx bxs-calendar-event text-white text-xl' ></i>
                            </div>
                            <div class="text-white">
                                <p class="bg-[#6875F5] w-max px-2 rounded-full">{{ event.category.name }}</p>
                            </div>
                        </div>

                        <h3 class="text-3xl font-semibold">{{ event.title }}</h3>
                        <p class="text-gray-400">Crée par {{ event.user.name }}</p>
                        <p class="mt-4 text-lg leading-relaxed text-blueGray-500">
                            {{ event.content }}
                        </p>
                        <ul class="list-none mt-6">
                            <li class="py-2">
                                <div class="flex items-center">
                                    <div>
                                        <span class="text-xs font-semibold inline-block py-1 px-2 uppercase rounded-full text-pink-600 bg-[#6875F5] mr-3"><link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'><i class='bx bxs-purchase-tag-alt text-white'></i></span>
                                    </div>
                                    <div>
                                        <h4 v-if="event.price !== 0" class="text-blueGray-500">
                                            {{ event.price }} €
                                        </h4>
                                        <h4 v-else class="text-blueGray-500">
                                            Entrée gratuit
                                        </h4>
                                    </div>
                                </div>
                            </li>
                            <li class="py-2">
                                <div class="flex items-center">
                                    <div>
                                        <span class="text-xs font-semibold inline-block py-1 px-2 uppercase rounded-full text-pink-600 bg-[#6875F5] mr-3"><i class='bx bxs-time text-white' ></i></span>
                                    </div>
                                    <div>
                                        <h4 class="text-blueGray-500">{{ event.starting_date }}</h4>
                                    </div>
                                </div>
                            </li>
                            <li class="py-2">
                                <div class="flex items-center">
                                    <div>
                                        <span class="text-xs font-semibold inline-block py-1 px-2 uppercase rounded-full text-pink-600 bg-[#6875F5] mr-3"><i class='bx bxs-group text-white' ></i></span>
                                    </div>
                                    <div>
                                        <h4 class="text-blueGray-500"> 5 participants</h4>
                                    </div>
                                </div>
                            </li>

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
                        </ul>
                    </div>
                </div>
            </div>
        </section>

        <Comments :comments="comments" :event="event"></Comments>
        <Opinion :event="event"></Opinion>

        <br><br><br><br><br>

    </AppLayout>
</template>

<script setup lang="ts">

</script>

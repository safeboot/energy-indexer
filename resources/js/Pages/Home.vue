<template>
    <div class="h-full my-auto grid grid-cols-1 md:grid-cols-3 gap-6">

        <div class="w-full p-12 border-2 border-dashed border-neutral-600 flex flex-col justify-center items-center gap-6 rounded-2xl">

            <i class="fa-solid fa-bottle-droplet fa-4x text-emerald-400"></i>

            <div class="text-center flex flex-col gap-2">

                <h1 class="text-sm text-neutral-500">Total Drink Count</h1>

                <p class="text-3xl font-semibold" v-text="stats.total"></p>

            </div>

        </div>

        <div class="w-full p-12 border-2 border-dashed border-neutral-600 flex flex-col justify-center items-center gap-6 rounded-2xl">

            <i class="fa-solid fa-ranking-star fa-4x text-blue-400"></i>

            <div class="text-center flex flex-col gap-2">

                <h1 class="text-sm text-neutral-500">Average Rank</h1>

                <p class="text-3xl font-semibold" v-text="stats.rank"></p>

            </div>

        </div>

        <div class="w-full p-12 border-2 border-dashed border-neutral-600 flex flex-col justify-center items-center gap-6 rounded-2xl">

            <i class="fa-solid fa-money-bill-wave fa-4x text-purple-400"></i>

            <div class="text-center flex flex-col gap-2">

                <h1 class="text-sm text-neutral-500">Average Price</h1>

                <p class="text-3xl font-semibold" v-text="stats.price"></p>

            </div>

        </div>

    </div>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout.vue";

export default {
    props: ['stats'],

    layout: AppLayout
}
</script>

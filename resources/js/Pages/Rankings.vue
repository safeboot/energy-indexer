<template>
    <div class="w-full flex flex-col gap-2">

        <div v-for="(tier, index) in tiers"
             :key="tier"
             class="w-full bg-neutral-800 flex items-center flex-wrap"
        >

            <div class="size-20 flex justify-center items-center flex-shrink-0" :style="{ 'background-color': tier.color }">

                <p class="text-white text-lg" v-text="tier.symbol"></p>

            </div>

            <draggable :list="rankings.filter((group, key) => key === index)[0]"
                       :item-key="index"
                       class="flex items-center flex-wrap"
                       :group="tier.symbol"
            >

                <template #item="{ element }">

                    <div class="size-20 flex-shrink-0">

                        <img :src="element.image" class="size-20 object-cover">

                    </div>

                </template>

            </draggable>

        </div>

    </div>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout.vue";
import draggable from 'vuedraggable';

export default {
    props: ['rankings'],

    layout: AppLayout,

    components: { draggable },

    data() {
        return {
            tiers: [
                { symbol: 'S', color: '#ef4444' },
                { symbol: 'A', color: '#f59e0b' },
                { symbol: 'B', color: '#10b981' },
                { symbol: 'C', color: '#3b82f6' },
                { symbol: 'D', color: '#6366f1' },
                { symbol: 'F', color: '#64748b' },
            ]
        }
    }
}
</script>

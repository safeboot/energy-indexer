<template>
    <div class="create-record grid grid-cols-1 lg:grid-cols-7 gap-6">

        <div class="lg:col-span-2 order-2 lg:order-1 flex flex-col gap-6 lg:gap-2">

            <div class="brand flex flex-col gap-2"
                 v-for="brand in brands"
                 :key="brand.id"
            >

                <h1 class="tracking-wider text-neutral-500" v-text="brand.name"></h1>

                <div class="border border-neutral-800 p-4 flex justify-between items-center gap-6"
                     v-for="flavor in flavors.filter(f => f.brand.id === brand.id)"
                     :key="flavor.id"
                >

                    <div class="flex items-center gap-3">

                        <img :src="flavor.image" class="size-12 object-cover">

                        <h1 class="text-lg" v-text="flavor.name"></h1>

                    </div>

                    <input type="radio" v-model="form.flavor_id" :value="flavor.id">

                </div>

            </div>

        </div>

        <div class="map order-1 lg:order-2 lg:col-span-5 h-max flex flex-col gap-6">

            <GMapMap :center="{ lat: 43.343607228415266, lng: 17.807616617236036 }"
                     :zoom="16"
                     class="aspect-square lg:aspect-video"
            >

                <GMapMarker @dragend="form.position = $event.latLng.toJSON()"
                    :position="form.position"
                    :draggable="true"
                />

            </GMapMap>

            <div class="grid grid-cols-2 gap-6">

                <input type="number" v-model="form.price" placeholder="Price (KM)" class="bg-transparent">

                <select v-model="form.availability" class="bg-transparent">

                    <option value="common">Common</option>

                    <option value="uncommon">Uncommon</option>

                    <option value="rare">Rare</option>

                </select>

            </div>

            <button @click="submit" class="bg-purple-500 px-2 py-4 flex justify-center items-center gap-2 hover:bg-purple-600 transition-all duration-300">

                <i class="fa-solid fa-plus"></i>

                Save

            </button>

        </div>

    </div>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout.vue";
import { useForm } from "@inertiajs/vue3";

export default {
    props: ['brands', 'flavors'],

    layout: AppLayout,

    setup() {
        const form = useForm({
            price: 0,
            availability: null,
            position: {
                lat: 43.343607228415266,
                lng: 17.807616617236036
            },
            flavor_id: null,
        });

        return { form };
    },

    methods: {
        submit() {
            this.form.post(route('locations.store'));
        }
    }
}
</script>

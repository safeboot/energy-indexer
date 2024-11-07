<template>
    <div class="locations flex flex-col gap-6">

        <div class="tabs flex items-center gap-6 overflow-x-auto">

            <button @click="tab = 'pricing'"
                    class="border-b-2 px-2 py-1 transition-all duration-300"
                    :class="tab === 'pricing' ? 'border-emerald-400' : 'border-transparent'"
            >

                Pricing List

            </button>

            <button @click="tab = 'brands'"
                    class="border-b-2 px-2 py-1 transition-all duration-300"
                    :class="tab === 'brands' ? 'border-emerald-400' : 'border-transparent'"
            >

                Brands

            </button>

            <button @click="tab = 'flavors'"
                    class="border-b-2 px-2 py-1 transition-all duration-300"
                    :class="tab === 'flavors' ? 'border-emerald-400' : 'border-transparent'"
            >

                Flavors

            </button>

        </div>

        <div class="pricing-list grid grid-cols-1 lg:grid-cols-7 gap-6" v-if="tab === 'pricing'">

            <div class="lg:col-span-2 order-2 lg:order-1 flex flex-col gap-6 lg:gap-2">

                <Link :href="route('locations.create')" class="bg-purple-500 px-2 py-4 flex justify-center items-center gap-2 hover:bg-purple-600 transition-all duration-300">

                    <i class="fa-solid fa-plus"></i>

                    Add Index

                </Link>

                <div class="marker border border-neutral-800 p-4 grid grid-cols-2 gap-6"
                     v-for="marker in markers"
                     :key="marker.id"
                >

                    <div class="col-span-2 flex items-center gap-4">

                        <img :src="marker.flavor.image" class="size-12 object-cover">

                        <div class="flex flex-col">

                            <p class="text-sm text-neutral-500" v-text="marker.flavor.brand.name"></p>

                            <h1 class="text-lg" v-text="marker.flavor.name"></h1>

                        </div>

                    </div>

                    <div class="flex items-center">

                        <h1 class="text-neutral-500" v-text="marker.price"></h1>

                    </div>

                    <div class="flex justify-end items-center">

                        <h1 class="capitalize text-neutral-500" v-text="marker.availability"></h1>

                    </div>

                </div>

            </div>

            <div class="map order-1 lg:order-2 lg:col-span-5 h-max">

                <GMapMap :center="{ lat: 43.343607228415266, lng: 17.807616617236036 }"
                         :zoom="16"
                         class="aspect-square lg:aspect-video"
                >

                    <GMapMarker
                        v-for="(marker, index) in markers"
                        :key="index"
                        :clickable="true"
                        :position="{ lat: marker.latitude, lng: marker.longitude }"
                        @click="activeMarker = marker.id"
                    />

                </GMapMap>

            </div>

        </div>

        <div class="brands flex flex-col gap-2" v-if="tab === 'brands'">

            <div class="brand border border-neutral-800 p-4 grid grid-cols-5 gap-6"
                 v-for="brand in brands"
                 :key="brand.id"
            >

                <div class="col-span-3 flex items-center gap-4">

                    <img :src="brand.logo" class="size-12 object-cover">

                    <h1 class="text-lg" v-text="brand.name"></h1>

                </div>

                <div class="flex justify-end items-center">

                    <h1 class="text-neutral-500" v-text="brand.flavors + ' Flavors'"></h1>

                </div>

                <div class="flex justify-end items-center">

                    <h1 class="text-neutral-500">Avg.: S Tier</h1>

                </div>

            </div>

            <div class="brand border border-neutral-800 border-dashed p-4 grid grid-cols-4 gap-6">

                <div class="col-span-3 flex items-center gap-4">

                    <label for="image" class="cursor-pointer">

                        <img :src="brandForm.logo.preview" class="size-12 bg-neutral-500 object-cover" v-if="brandForm.logo.preview">

                        <div class="size-12 bg-neutral-700 flex justify-center items-center" v-else>

                            <i class="fa-solid fa-image fa-lg text-white"></i>

                        </div>

                    </label>

                    <input type="file" id="image" @change="handleBrandLogo" hidden>

                    <input type="text" v-model="brandForm.name" placeholder="Brand name..." class="bg-transparent">

                </div>

                <div class="flex justify-end items-center">

                    <button @click="saveBrand" class="text-neutral-500 hover:text-purple-400 transition-all duration-300">Save</button>

                </div>

            </div>

        </div>

        <div class="flavors flex flex-col gap-2" v-if="tab === 'flavors'">

            <div class="flavor border border-neutral-800 p-4 grid grid-cols-5 gap-6"
                 v-for="flavor in flavors"
                 :key="flavor.id"
            >

                <div class="col-span-3 flex items-center gap-4">

                    <img :src="flavor.image" class="size-12 object-cover">

                    <h1 class="text-lg" v-text="flavor.name"></h1>

                </div>

                <div class="flex justify-end items-center">

                    <h1 class="text-neutral-500" v-text="flavor.price"></h1>

                </div>

                <div class="flex justify-end items-center">

                    <h1 class="text-neutral-500" v-text="flavor.rank"></h1>

                </div>

            </div>

            <div class="brand border border-neutral-800 border-dashed p-4 grid grid-cols-4 gap-6">

                <div class="col-span-3 flex items-center gap-4">

                    <label for="image" class="cursor-pointer">

                        <img :src="flavorForm.image.preview" class="size-12 bg-neutral-500 object-cover" v-if="flavorForm.image.preview">

                        <div class="size-12 bg-neutral-700 flex justify-center items-center" v-else>

                            <i class="fa-solid fa-image fa-lg text-white"></i>

                        </div>

                    </label>

                    <input type="file" id="image" @change="handleFlavorImage" hidden>

                    <input type="text" v-model="flavorForm.name" placeholder="Flavor name..." class="bg-transparent">

                </div>

                <div class="flex justify-end items-center gap-6">

                    <select v-model="flavorForm.brand_id" class="bg-transparent">

                        <option v-for="(brand, index) in brands" :key="index" :value="brand.id" v-text="brand.name"></option>

                    </select>

                    <button @click="saveFlavor" class="text-neutral-500 hover:text-purple-400 transition-all duration-300">Save</button>

                </div>

            </div>

        </div>

        <div class="marker-modal-container fixed top-0 left-0 w-full h-dvh p-6 bg-black/50 flex justify-center items-center transition-all duration-300"
             :class="activeMarker ? 'backdrop-blur-sm opacity-100' : 'backdrop-blur-none opacity-0 pointer-events-none'"
        >

            <div class="marker-modal w-full max-w-lg bg-neutral-800 border border-neutral-700 p-6 flex flex-col gap-6 transition-all duration-300"
                 :class="activeMarker ? '' : 'scale-90'"
            >

                <div class="flex justify-between items-center">

                    <h1 class="font-semibold">About this Index</h1>

                    <button @click="activeMarker = null">

                        <i class="fa-solid fa-xmark"></i>

                    </button>

                </div>

                <div class="flex items-center gap-2">

                    <i class="fa-solid fa-money-bill-wave text-sky-300 w-6"></i>

                    <p v-text="activeLocation?.price"></p>

                </div>

                <div class="flex items-center gap-2">

                    <i class="fa-solid fa-ranking-star text-emerald-300 w-6"></i>

                    <p class="capitalize" v-text="activeLocation?.availability"></p>

                </div>

                <div class="flex items-center gap-2">

                    <i class="fa-solid fa-bottle-droplet text-purple-300 w-6"></i>

                    <p class="capitalize" v-text="activeLocation?.flavor.brand.name + ': ' + activeLocation?.flavor.name"></p>

                </div>

            </div>

        </div>

    </div>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout.vue";
import { useForm } from "@inertiajs/vue3";

export default {
    props: ['markers', 'brands', 'flavors'],

    layout: AppLayout,

    data() {
        return {
            tab: 'pricing',
            activeMarker: null
        };
    },

    setup() {
        const brandForm = useForm({
            name: '',
            logo: {
                file: null,
                preview: null,
            }
        });

        const flavorForm = useForm({
            name: '',
            image: {
                file: null,
                preview: null,
            },
            brand_id: null,
        });

        return { brandForm, flavorForm };
    },

    computed: {
        activeLocation() {
            return this.activeMarker ? Object.values(this.markers).find(marker => marker.id === this.activeMarker) : null;
        }
    },

    methods: {
        handleBrandLogo(event) {
            this.brandForm.logo.file = event.target.files[0];
            this.brandForm.logo.preview = URL.createObjectURL(event.target.files[0]);
        },

        saveBrand() {
            this.brandForm.transform(data => ({
                ...data,
                logo: data.logo.file
            }));

            this.brandForm.post(route('brands.store'), {
                preserveScroll: true,
                only: ['brands'],
                onSuccess: () => {
                    this.brandForm.reset();
                }
            });
        },

        handleFlavorImage(event) {
            this.flavorForm.image.file = event.target.files[0];
            this.flavorForm.image.preview = URL.createObjectURL(event.target.files[0]);
        },

        saveFlavor() {
            this.flavorForm.transform(data => ({
                ...data,
                image: data.image.file
            }));

            this.flavorForm.post(route('flavors.store'), {
                preserveScroll: true,
                only: ['flavors'],
                onSuccess: () => {
                    this.flavorForm.reset();
                }
            });
        },
    }
}
</script>

<template>
    <div class="app-layout w-full min-h-dvh bg-neutral-900 text-white p-6 flex flex-col gap-6">

        <div class="header w-full flex flex-col md:flex-row justify-between items-center gap-6">

            <h1 class="bg-gradient-to-r from-emerald-300 via-white to-purple-300 bg-clip-text text-2xl text-center md:text-left font-semibold text-transparent">Safeboot's Energy Drink Index</h1>

            <div class="flex justify-end items-center gap-6">

                <Link :href="route('home')"
                      class="transition-all duration-300"
                      :class="route().current('home') ? 'text-purple-400' : 'hover:text-purple-300'"
                >Home</Link>

                <Link :href="route('locations.index')"
                      class="transition-all duration-300"
                      :class="route().current('locations.*') ? 'text-purple-400' : 'hover:text-purple-300'"
                >Index</Link>

                <Link :href="route('home')"
                      class="transition-all duration-300"
                      :class="route().current('rank-list') ? 'text-purple-400' : 'hover:text-purple-300'"
                >Rank List</Link>

            </div>

        </div>

        <div class="main w-full max-w-screen-lg h-fit flex-1 mx-auto flex flex-col gap-6">

            <slot />

        </div>

    </div>
</template>

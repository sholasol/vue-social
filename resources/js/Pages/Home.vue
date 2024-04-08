<script setup>
import { Head, Link } from "@inertiajs/vue3";
import GroupList from "@/Components/app/GroupList.vue";
import FollowingList from "@/Components/app/FollowingList.vue";
import CreatePost from "@/Components/app/CreatePost.vue";
import PostList from "@/Components/app/PostList.vue";

defineProps({
    // canLogin: {
    //     type: Boolean,
    // },
    // canRegister: {
    //     type: Boolean,
    // },
    // laravelVersion: {
    //     type: String,
    //     required: true,
    // },
    // phpVersion: {
    //     type: String,
    //     required: true,
    // },
});
</script>

<template>
    <Head title="LaraVue Social App" />

    <div class="grid lg:grid-cols-12 gap-3 p-4 h-full">
        <div class="lg:col-span-3 py-2 lg:order-1 h-full overflow-auto">
            <GroupList />
        </div>

        <div class="lg:col-span-3 py-2 lg:order-3 h-full overflow-auto">
            <FollowingList />
        </div>

        <div class="lg:col-span-6 py-2 lg:order-2 h-full overflow-auto">
            <CreatePost />
            <PostList />
        </div>
    </div>
</template>

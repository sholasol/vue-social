<script setup>
import { ref } from "vue";
import TextInput from "@/Components/TextInput.vue";
// import TextInput from "../TextInput.vue";
import FollowingItem from "@/Components/app/FollowingItem.vue";

const searchKeyword = ref("");
</script>

<template>
    <!-- <h2 class="text-xl font-bold px-3 mb-4">My Followings</h2> -->
    <TextInput
        :model-value="searchKeyword"
        placeholder="search group"
        class="w-full mt-3"
    />
    <div class="mt-3 px-3 h-[200px] lg:flex-1 overflow-auto">
        <div v-if="false" class="text-gray-600 text-center p-3">
            You don't have friends yet
        </div>
        <div v-else>
            <FollowingItem image="https://picsum.photos/100" title="John Doe" />

            <FollowingItem image="https://picsum.photos/90" title="Elon Musk" />
            <FollowingItem image="https://picsum.photos/80" title="John Doe" />

            <FollowingItem image="https://picsum.photos/50" title="Elon Musk" />
            <FollowingItem image="https://picsum.photos/80" title="John Doe" />

            <FollowingItem image="https://picsum.photos/50" title="Elon Musk" />
            <FollowingItem image="https://picsum.photos/80" title="John Doe" />

            <FollowingItem image="https://picsum.photos/50" title="Elon Musk" />
            <FollowingItem image="https://picsum.photos/70" title="John Doe" />

            <FollowingItem image="https://picsum.photos/60" title="Elon Musk" />
        </div>
    </div>
</template>

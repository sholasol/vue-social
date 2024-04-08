<script setup>
import TextInput from "@/Components/TextInput.vue";
import { ref } from "vue";
import FollowingItem from "@/Components/app/FollowingItem.vue";

const searchKeyword = ref("");
</script>

<template>
    <div class="px-3 bg-white rounded border py-3">
        <h2 class="text-xl font-bold px-3 mb-4">My Followings</h2>
        <TextInput
            :model-value="searchKeyword"
            placeholder="search group"
            class="w-full"
        />
        <div class="py-8 px-3">
            <div v-if="false" class="text-gray-600 flex text-center">
                You don't have friends yet
            </div>
            <div v-else>
                <FollowingItem
                    image="https://picsum.photos/100"
                    title="John Doe"
                />

                <FollowingItem
                    image="https://picsum.photos/100"
                    title="Elon Musk"
                />
            </div>
        </div>
    </div>
</template>

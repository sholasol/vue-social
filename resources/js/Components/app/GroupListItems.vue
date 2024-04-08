<script setup>
import { ref } from "vue";
import TextInput from "@/Components/TextInput.vue";
import GroupItem from "@/Components/app/GroupItem.vue";

const searchKeyword = ref("");
</script>

<template>
    <TextInput
        :model-value="searchKeyword"
        placeholder="search group"
        class="w-full mt-4"
    />
    <div class="mt-3 px-3 h-[200px] lg:flex-1 overflow-auto">
        <div v-if="false" class="text-gray-600 text-center p-3">
            You have not joined any group
        </div>
        <div v-else>
            <GroupItem
                image="https://picsum.photos/100"
                title="Laravel Developer"
                description="Lorem ipsum dolor sit amet consectetur
                                Voluptatibus, quas ipsa."
            />

            <GroupItem
                image="https://picsum.photos/100"
                title="Vue.js Developer"
                description="Lorem ipsum dolor sit amet consectetur
                                Voluptatibus, quas ipsa."
            />
            <GroupItem
                image="https://picsum.photos/100"
                title="Laravel Developer"
                description="Lorem ipsum dolor sit amet consectetur
                                Voluptatibus, quas ipsa."
            />

            <GroupItem
                image="https://picsum.photos/100"
                title="Vue.js Developer"
                description="Lorem ipsum dolor sit amet consectetur
                                Voluptatibus, quas ipsa."
            />
            <GroupItem
                image="https://picsum.photos/100"
                title="Laravel Developer"
                description="Lorem ipsum dolor sit amet consectetur
                                Voluptatibus, quas ipsa."
            />

            <GroupItem
                image="https://picsum.photos/100"
                title="Vue.js Developer"
                description="Lorem ipsum dolor sit amet consectetur
                                Voluptatibus, quas ipsa."
            />
            <GroupItem
                image="https://picsum.photos/100"
                title="Laravel Developer"
                description="Lorem ipsum dolor sit amet consectetur
                                Voluptatibus, quas ipsa."
            />

            <GroupItem
                image="https://picsum.photos/100"
                title="Vue.js Developer"
                description="Lorem ipsum dolor sit amet consectetur
                                Voluptatibus, quas ipsa."
            />
        </div>
    </div>
</template>

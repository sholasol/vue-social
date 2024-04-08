<script setup>
import PostItem from "@/Components/app/PostItem.vue";

const post1 = {
    user: {
        id: 1,
        avatar: "https://randomuser.me/api/portraits/men/49.jpg",
        name: "John Smith",
    },
    group: null,
    attachements: [
        {
            id: 1,
            name: "text.png",
            url: "https://picsum.photos/1000",
            mime: "image/png",
        },
        {
            id: 2,
            name: "text2.png",
            url: "https://picsum.photos/1000",
            mime: "image/png",
        },
        {
            id: 3,
            name: "myDoc.docx",
            url: "#",
            mime: "application/msword",
        },
    ],
    body: `<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsam,
        voluptatibus in. Obcaecati ratione quod impedit error culpa deserunt ut
        eius, placeat consequuntur, sit laudantium! Natus ad exercitationem
        autem eum quisquam, perferendis laboriosam sed illum fugit unde. Nisi
        natus rerum quo?</p>

        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsam,
        voluptatibus in. Obcaecati ratione quod impedit error culpa deserunt ut
        eius, placeat consequuntur, sit laudantium! Natus ad exercitationem
        autem eum quisquam, perferendis laboriosam sed illum fugit unde. Nisi
        natus rerum quo?</p>
        `,
    created_at: "2023-11-19 15:12",
};

const post2 = {
    user: {
        id: 1,
        avatar: "https://randomuser.me/api/portraits/men/50.jpg",
        name: "James Grey",
    },
    group: {
        id: 1,
        name: "Laravel Developers",
    },
    body: `<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsam,
        voluptatibus in. Obcaecati ratione quod impedit error culpa deserunt ut
        eius, placeat consequuntur, sit laudantium! Natus ad exercitationem
        autem eum quisquam, perferendis laboriosam sed illum fugit unde. Nisi
        natus rerum quo?</p>

        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsam,
        voluptatibus in. Obcaecati ratione quod impedit error culpa deserunt ut
        eius, placeat consequuntur, sit laudantium! Natus ad exercitationem
        autem eum quisquam, perferendis laboriosam sed illum fugit unde. Nisi
        natus rerum quo?</p>
        `,
    created_at: "2023-11-19 17:02",
};
</script>

<template>
    <div class="overflow-auto">
        <PostItem :post="post1" />
        <PostItem :post="post2" />
    </div>
</template>

<style scoped></style>

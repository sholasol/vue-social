<script setup>
import { usePage } from "@inertiajs/vue3";
const user = usePage().props.auth.user;

import { defineProps, ref } from "vue";
import { TabGroup, TabList, Tab, TabPanels, TabPanel } from "@headlessui/vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import TabItem from "@/Pages/Profile/Partials/TabItem.vue";
import Edit from "@/Pages/Profile/Edit.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import DangerButton from "@/Components/DangerButton.vue";
import { computed } from "vue";
import {
    XMarkIcon,
    CameraIcon,
    CheckCircleIcon,
} from "@heroicons/vue/24/solid";

// import { reactive } from "vue";
// import { router } from "@inertiajs/vue3";
import { useForm } from "@inertiajs/vue3";

const ImagesForm = useForm({
    cover: null,
    avatar: null,
});

const authUser = usePage().props.auth.user;

const coverImageSrc = ref("");
const avatarImageSrc = ref("");
const showNotification = ref(true);
//let imagesForm = null;

const isMyProfile = computed(() => authUser && authUser.id === user.id);

defineProps({
    errors: Object,

    mustVerifyEmail: {
        type: Boolean,
    },
    status: {
        type: String,
    },
    success: {
        type: String,
    },
    user: {
        type: Object,
    },
});

function onCoverChange(event) {
    ImagesForm.cover = event.target.files[0];

    if (ImagesForm.cover) {
        const reader = new FileReader();

        reader.onload = () => {
            coverImageSrc.value = reader.result;
        };
        reader.readAsDataURL(ImagesForm.cover);
    }
}

function onAvatarChange(event) {
    ImagesForm.avatar = event.target.files[0];

    if (ImagesForm.avatar) {
        const reader = new FileReader();

        reader.onload = () => {
            avatarImageSrc.value = reader.result;
        };
        reader.readAsDataURL(ImagesForm.avatar);
    }
}

function cancelCoverImage() {
    ImagesForm.cover = null;
    coverImageSrc.value = null;
}

function cancelAvatarImage() {
    ImagesForm.avatar = null;
    avatarImageSrc.value = null;
}

function submitCoverImage() {
    console.log(ImagesForm.cover);
    ImagesForm.post(route("profile.updateCover"), {
        onSuccess: (user) => {
            cancelCoverImage();

            setTimeout(() => {
                showNotification.value = false;

                // Reload the page after 3 seconds
                setTimeout(() => {
                    window.location.reload();
                }, 2000);
            }, 3000);

            //window.location.reload();
        },
    });
}

function submitAvatarImage() {
    console.log(ImagesForm.avatar);
    ImagesForm.post(route("profile.updateCover"), {
        onSuccess: (user) => {
            cancelAvatarImage();

            setTimeout(() => {
                showNotification.value = false;

                // Reload the page after 3 seconds
                setTimeout(() => {
                    window.location.reload();
                }, 2000);
            }, 3000);

            //window.location.reload();
        },
    });
}

// function submitCoverImage() {
//     console.log(ImagesForm.cover);
//     ImagesForm.post(route("profile.updateCover"), {
//         onSuccess: (user) => {
//             console.log(user);

//             cancelCoverImage();

//             setTimeout(() => {
//                 showNotification.value = false;
//             }, 3000);
//         },
//     });
// }
</script>

<template>
    <AuthenticatedLayout>
        <div class="container mx-auto h-full overflow-auto">
            <div
                v-show="showNotification && success === 'cover-image-updated'"
                class="my-2 py-2 px-3 font-medium text-sm bg-emerald-500 text-white"
            >
                {{ success }}
            </div>
            <div
                v-if="errors.cover"
                class="my-2 py-2 px-3 font-medium text-sm bg-red-500 text-white"
            >
                {{ errors.cover }}
            </div>
            <div class="group relative bg-white">
                <img
                    :src="
                        coverImageSrc ||
                        '/storage/' + user.cover_path ||
                        '/img/cover.jpg'
                    "
                    alt=""
                    class="w-full h-[300px] object-cover"
                />
                <div class="absolute top-2 right-2">
                    <button
                        v-if="!coverImageSrc"
                        class="bg-gray-50 hover:bg-gray-100 text-gray-800 py-1 px-2 text-xs flex items-center opacity-0 group-hover:opacity-100"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke-width="1.5"
                            stroke="currentColor"
                            class="w-3 h-3 mr-1"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M6.827 6.175A2.31 2.31 0 0 1 5.186 7.23c-.38.054-.757.112-1.134.175C2.999 7.58 2.25 8.507 2.25 9.574V18a2.25 2.25 0 0 0 2.25 2.25h15A2.25 2.25 0 0 0 21.75 18V9.574c0-1.067-.75-1.994-1.802-2.169a47.865 47.865 0 0 0-1.134-.175 2.31 2.31 0 0 1-1.64-1.055l-.822-1.316a2.192 2.192 0 0 0-1.736-1.039 48.774 48.774 0 0 0-5.232 0 2.192 2.192 0 0 0-1.736 1.039l-.821 1.316Z"
                            />
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M16.5 12.75a4.5 4.5 0 1 1-9 0 4.5 4.5 0 0 1 9 0ZM18.75 10.5h.008v.008h-.008V10.5Z"
                            />
                        </svg>

                        Update
                        <input
                            type="file"
                            class="absolute left-0 top-0 bottom-0 right-0 opacity-0"
                            @change="onCoverChange"
                        />
                    </button>
                    <div
                        v-else
                        class="flex gap-2 bg-white p-2 group-hover:opacity-100 opacity-0"
                    >
                        <button
                            @click="cancelCoverImage"
                            class="bg-gray-50 hover:bg-gray-100 text-gray-800 py-1 px-2 text-xs flex items-center"
                        >
                            <XMarkIcon class="h-3 w-3 mr-2 text-red-800" />
                            Cancel
                        </button>
                        <button
                            @click="submitCoverImage"
                            class="bg-gray-800 hover:bg-gray-900 text-gray-100 py-1 px-2 text-xs flex items-center"
                        >
                            <CheckCircleIcon class="h-3 w-3 mr-2" /> Submit
                        </button>
                    </div>
                </div>

                <div class="flex">
                    <div
                        class="flex items-center justify-center relative group/avatar -mt-[64px] ml-[48px] w-[128px] h-[128px] rounded-full"
                    >
                        <img
                            :src="
                                avatarImageSrc ||
                                '/storage/' + user.avatar_path ||
                                '/img/avatar.png'
                            "
                            class="w-full h-full object-cover rounded-full"
                        />
                        <button
                            v-if="!avatarImageSrc"
                            class="absolute left-0 top-0 right-0 bottom-0 bg-black/50 text-gray-200 rounded-full opacity-0 flex items-center justify-center group-hover/avatar:opacity-100"
                        >
                            <CameraIcon class="w-8 h-8" />

                            <input
                                type="file"
                                class="absolute left-0 top-0 bottom-0 right-0 opacity-0"
                                @change="onAvatarChange"
                            />
                        </button>
                        <div
                            v-else
                            class="absolute top-1 right-0 flex flex-col gap-2"
                        >
                            <button
                                @click="cancelAvatarImage"
                                class="w-7 h-7 flex items-center justify-center bg-red-500/80 text-white rounded-full"
                            >
                                <XMarkIcon class="h-5 w-5" />
                            </button>
                            <button
                                @click="submitAvatarImage"
                                class="w-7 h-7 flex items-center justify-center bg-emerald-500/80 text-white rounded-full"
                            >
                                <CheckCircleIcon class="h-5 w-5" />
                            </button>
                        </div>
                    </div>
                    <div
                        class="flex flex-1 justify-between items-center py-3 p-4"
                    >
                        <h2 class="font-bold text-lg">
                            {{ user.name }}
                        </h2>
                        <PrimaryButton v-if="isMyProfile">
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke-width="1.5"
                                stroke="currentColor"
                                class="w-6 h-6 mr-2"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10"
                                />
                            </svg>

                            Edit Profile
                        </PrimaryButton>
                    </div>
                </div>
            </div>
            <div class="border-t">
                <TabGroup>
                    <TabList class="flex bg-white">
                        <Tab
                            v-if="isMyProfile"
                            v-slot="{ selected }"
                            as="template"
                        >
                            <TabItem text="About" :selected="selected" />
                        </Tab>
                        <Tab v-slot="{ selected }" as="template">
                            <TabItem text="Posts" :selected="selected" />
                        </Tab>
                        <Tab v-slot="{ selected }" as="template">
                            <TabItem text="Followers" :selected="selected" />
                        </Tab>
                        <Tab v-slot="{ selected }" as="template">
                            <TabItem text="Followings" :selected="selected" />
                        </Tab>
                        <Tab v-slot="{ selected }" as="template">
                            <TabItem text="Photos" :selected="selected" />
                        </Tab>
                    </TabList>

                    <TabPanels class="mt-2">
                        <TabPanel
                            v-if="isMyProfile"
                            class="bg-white p-3 shadow"
                        >
                            <Edit
                                :must-verify-email="mustVerifyEmail"
                                :status="status"
                            />
                        </TabPanel>
                        <TabPanel class="bg-white p-3 shadow">
                            Post Content
                        </TabPanel>
                        <TabPanel class="bg-white p-3 shadow">
                            Followers Content
                        </TabPanel>
                        <TabPanel class="bg-white p-3 shadow">
                            Following Content
                        </TabPanel>
                        <TabPanel class="bg-white p-3 shadow">
                            Photos Content
                        </TabPanel>
                    </TabPanels>
                </TabGroup>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

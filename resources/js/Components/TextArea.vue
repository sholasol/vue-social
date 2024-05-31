<script setup>
import { onMounted, ref } from "vue";

const model = defineModel(
    {
        type: String,
        required: true,
        placeholder: String,
    },
    {
        placeholder: String,
        autoResize: {
            type: Boolean,
            default: false,
        },
    }
);

const emit = defineEmits(["update:model"]);

const input = ref(null);

onMounted(() => {
    if (input.value.hasAttribute("autofocus")) {
        input.value.focus();
    }
});

function onInputChange($event) {
    emit("update:model", $event.target.value);

    input.value.style.height = "auto";
    input.value.style.height = input.value.scrollHeight + "px";
}

defineExpose({ focus: () => input.value.focus() });
</script>

<template>
    <textarea
        class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
        v-model="model"
        @input="onInputChange"
        ref="input"
        :placeholder="placeholder"
    ></textarea>
</template>

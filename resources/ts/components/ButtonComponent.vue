<script lang="ts" setup>
import IconCart from './IconCart.vue';
const props = withDefaults(defineProps<{ disabled: boolean }>(), {disabled: false })

</script>
<template>
    <button :disabled="props.disabled" @click="$emit('onClick')"
    class="flex w-full justify-center rounded transition-colors duration-150 bg-purple-700
        hover:bg-purple-800 font-semibold text-white py-2 px-4 space-x-2 cursor-pointer button-disabled">
        <IconCart :color="props.disabled ? '#6B7290' : '#FFFFFF'"></IconCart>
        <slot/>
    </button>
</template>
<style lang="postcss" >
.button-disabled:disabled {
    @apply border border-gray-500 bg-transparent rounded text-gray-500;
}
</style>

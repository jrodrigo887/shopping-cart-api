<script lang="ts" setup>
import { Ref } from 'vue';
import Checkout from '../models/Checkout';
import ButtonComponent from './ButtonComponent.vue';

const { checkout } = defineProps<{ checkout: Ref<Checkout> }>()

</script>
<template>
    <div class="">
        <p>Resumo da compra</p>
        <ul class="space-y-2 mb-4">
            <li v-for="product of checkout.getProducts()" class="flex justify-between bg-white shadow-lg rounded-sm px-4 py-2">
                <div class="flex space-x-3">
                    <p>{{ checkout.quantityProductPerId(product.getId()) }}X</p>
                    <p>{{ product.getName() }}</p>
                </div>
                <button @click="checkout.removeProductPerId(product.getId())" class="p-2  transition-colors duration-150 bg-red-500 hover:bg-red-400 w-7 h-7 rounded-sm">
                    <img src="../../assets/delete_white_24dp.svg" alt="deletar produto" />
                </button>
            </li>
        </ul>
        <ButtonComponent @onClick="$emit('onClick')" :disabled="false">
            <span>Fechar Pedido</span>
        </ButtonComponent>
    </div>
</template>

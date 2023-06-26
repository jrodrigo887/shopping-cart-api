<script lang="ts" setup>
import { Ref, onMounted, watchEffect } from 'vue';
import CheckoutUsecase from '../usecase/Checkout.usecase';
import ButtonComponent from './ButtonComponent.vue';
import { useApiCheckout } from '../composables/apiCheckout';

const { checkout } = defineProps<{ checkout: Ref<CheckoutUsecase> }>()

const { getCheckout, isError, createCheckout } = useApiCheckout();

watchEffect(() => {
    if (isError.value) {
        createCheckout('Finalizar Compras 1');
    }
})

onMounted(async () => {
    await getCheckout();
});

</script>
<template>
    <div>
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
        <ButtonComponent @onClick="$emit('onClick')" :disabled="checkout.getProducts().length === 0">
            <span>Fechar Pedido</span>
        </ButtonComponent>
    </div>
</template>

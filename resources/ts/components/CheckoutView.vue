<script lang="ts" setup>
import { Ref, onMounted } from 'vue';
import CheckoutUsecase from '../usecase/Checkout.usecase';
import ButtonComponent from './ButtonComponent.vue';
import { useApiCheckout } from '../composables/apiCheckout';

const { checkout } = defineProps<{ checkout: Ref<CheckoutUsecase> }>()

const { getCheckout, isError, createCheckout, loading, saveMessage } = useApiCheckout();

const loadCheckout = async () => {
    try {
        const hasCheckout = await getCheckout();

        if (!hasCheckout) {
            createCheckout('Finalizar Compras 1');
        }
    } catch(e) {
        console.error(e)
    }
}

onMounted(() => {
    loadCheckout();
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
        <div>
            <small v-if="loading" class="text-blue-500 font-semibold">...</small>

            <small v-if="isError" class="text-red-500 font-semibold">
                Erro no servidor, tente mais tarde!
            </small>
            <small v-if="saveMessage.length > 0" class="text-green-500 font-semibold">
                {{  saveMessage }}
            </small>
        </div>
    </div>
</template>

<script lang="ts" setup>
import { reactive, toRaw, watchEffect } from 'vue';
import { useApiProducts } from '../composables/apiProducts';
import ProductRequestDto from '../types/ProductRequest.dto';
const { saveProduct, loading, isError, successMessage } = useApiProducts();
const INITIAL_STORE = {
    name: '',
    description: '',
    price: 0,
    quantity: 1
}

let state = reactive<ProductRequestDto>(INITIAL_STORE);

watchEffect(() => {
    if (successMessage.value.length > 0) {
        dispose();
    }
})

const dispose = () => {
    let timeout = setTimeout(() => {
        state = INITIAL_STORE;
        clearTimeout(timeout);
    }, 400)
}

const addProduct = (payload: Event) => {
    payload.preventDefault();
    saveProduct(toRaw(state));
}
</script>

<template>
    <div class="w-full">
        <form v-if="!loading" class="flex flex-col m-1 p-2 border border-gray-500 space-y-2" :onSubmit="addProduct">
            <label for="input-name">Nome*: </label>
            <input v-model="state.name" type="text" id="input-name" name="name" required/>
            <label for="input-price">Preço*: </label>
            <input v-model="state.price" type="number" id="input-price" name="price" required/>
            <input type="submit" value="Cadastrar" />
        </form>
        <div>
            <small v-if="loading" class="text-blue-500 font-semibold">Cadastrando Produto...</small>

            <small v-if="isError" class="text-red-500 font-semibold">
                Erro no servidor, tente mais tarde!
            </small>
            <small v-if="successMessage.length > 0" class="text-green-500 font-semibold">
                {{  successMessage }}
            </small>
        </div>
    </div>
</template>
<style >
input {
    @apply border border-gray-500 h-9;
}
</style>

<script setup lang="ts">
import { ref, onMounted } from 'vue';
import { useApiProducts } from './composables/apiProducts';
import Product from './types/Product';
import { ProductView, CheckoutView } from './components';

const { getProducts, result, loading } = useApiProducts();

onMounted(() => {
    getProducts()
})

</script>
<template>
    <main class="min-h-screen bg-purple-300">
        <div class="py-20 px-2">
            <div class="h-2/4 w-full sm:w-2/4 mx-auto shadow-lg bg-white rounded-lg p-4">
                <div>
                    <h1>Lista de Produtos</h1>
                    <p>Escolha uma das opções abaixo</p>
                    <ul v-if="!loading && result.length > 0">
                        <li v-for="product of result">
                            <p>{{ product.name }}</p>
                            <!-- <ProductView></ProductView> -->
                        </li>
                    </ul>
                    <h3 v-else-if="!loading && result.length == 0">
                        nenhum produto encontrado
                    </h3>
                    <h3 v-else class="text-2xl text-blue-800 tracking-wide">Loading</h3>
                    <div class="w-48 py-5 bg-purple-800">
                        <img src="../assets/add_white_24dp.svg" alt="ícone adicionar produto">
                    </div>
                    <CheckoutView></CheckoutView>
                </div>
            </div>
        </div>
    </main>
</template>

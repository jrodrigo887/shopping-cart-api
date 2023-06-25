<script setup lang="ts">
import { ref, onMounted } from 'vue';
import { useApiProducts } from './composables/apiProducts';
import { ProductView, CheckoutView } from './components';
import Checkout from './models/Checkout';
import Product from './models/Product';
import ProductDto from './types/Product.dto';

const { getProducts, result, loading } = useApiProducts();
const checkoutInstance = ref(new Checkout());

const addProductToCheckout = (product: ProductDto) => {
    checkoutInstance.value.setProduct(new Product(product.name, product.description, product.price, product.id))
}

const closedCheckout = () => {
    alert('fechar pedido?');
}

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

                    <ul v-if="!loading && result.length > 0" class="space-y-2">
                        <li v-for="product of result">
                            <ProductView>
                                <button @click="addProductToCheckout(product)"
                                class="w-6 h-6 rounded-sm transition-colors duration-150 bg-purple-700 hover:bg-purple-800">
                                    <img src="../assets/add_white_24dp.svg" alt="adicionar produto">
                                </button>
                                <p>{{ product.name }}</p>
                            </ProductView>
                        </li>
                    </ul>

                    <h3 v-else-if="!loading && result.length == 0">
                        nenhum produto encontrado
                    </h3>

                    <h3 v-else class="text-2xl text-blue-800 tracking-wide">Loading</h3>

                    <div class="my-2 divide-y divide-gray-400">
                    </div>

                    <div>
                        <h1>Checkout</h1>
                        <CheckoutView @onClick="closedCheckout()" :checkout="checkoutInstance" ></CheckoutView>
                    </div>
                </div>
            </div>
        </div>
    </main>
</template>

<script setup lang="ts">
import { ref, onMounted } from 'vue';
import { useApiProducts } from './composables/apiProducts';
import { ProductView, CheckoutView } from './components';
import CheckoutUsecase from './usecase/Checkout.usecase';
import Product from './models/Product';
import ProductDto from './types/Product.dto';
import SaveProductView from './components/SaveProductView.vue';

const { getProducts, result, loading } = useApiProducts();
const checkoutInstance = ref(new CheckoutUsecase());
const openDrawer = ref(false);

const addProductToCheckout = (product: ProductDto) => {
    checkoutInstance.value.setProduct(new Product(product.name, product.description, product.price, product.id))
}

const closedCheckout = () => {
   checkoutInstance.value.finishCheckout();
}

onMounted(() => {
    getProducts()
})

</script>
<template>
    <main class="min-h-screen bg-purple-300 p-2">
        <div>
            <button @click="openDrawer = !openDrawer"
                        class="flex py-2 px-4 text-white text-sm rounded-md space-x-1 transition-colors duration-150 bg-purple-700 hover:bg-purple-800">
                        <img src="../assets/add_white_24dp.svg" alt="adicionar produto">
                        <p>Adicione um produto</p>
            </button>
        </div>

        <div class="py-20 px-2 relative">
            <div class="h-2/4 w-full sm:w-2/4 mx-auto shadow-lg bg-white rounded-lg p-4">
                <div>
                    <h1 class="text-center">Lista de Produtos</h1>
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
                        <small class="text-gray-700 font-semibold">
                            nenhum produto encontrado, cadastre um agora.
                        </small>
                        <SaveProductView></SaveProductView>
                    </h3>

                    <h3 v-else class="text-2xl text-blue-800 tracking-wide">Loading</h3>

                    <div class="my-2 divide-y divide-gray-400"></div>

                    <div>
                        <h1 class="text-center">Checkout</h1>
                        <CheckoutView @onClick="closedCheckout()" :checkout="checkoutInstance"></CheckoutView>
                    </div>
                </div>
            </div>
        </div>



        <!-- drawer -->
        <div class="fixed top-0 left-0 z-30 h-screen p-4 overflow-y-auto transition-transform w-full bg-gray-800/60 dark:bg-gray-800"
            :class="[openDrawer ? '' : '-translate-x-full']">
        <div class="fixed top-0 left-0 z-40 h-screen p-4 overflow-y-auto transition-transform bg-white w-80 dark:bg-gray-800"
                :class="[openDrawer ? '' : '-translate-x-full']" tabindex="-1" aria-labelledby="drawer-label">
                <h5 class="inline-flex items-center mb-4 text-base font-semibold text-gray-500 dark:text-gray-400">Formulário</h5>
                <SaveProductView></SaveProductView>
            <div class="grid grid-cols-2 gap-4 mt-4">
                <div></div>
                <button @click="openDrawer = !openDrawer"
                    class="py-2 px-4 text-white text-sm rounded-md transition-colors duration-150 bg-purple-700 hover:bg-purple-800">
                    <p>Fechar</p>
                </button>
            </div>
        </div>
    </div>

</main>
</template>

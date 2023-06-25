import { ref, computed } from 'vue';
import axios, { AxiosResponse, AxiosError } from 'axios';
import Product from '../types/Product';

export function useApiProducts() {
    const products = ref<Product[]>([]);
    const loading = ref<boolean>(false);
    const isError = ref <boolean>(false);
    const messageError = ref <string>('');

    const getProducts = () => {
        loading.value = true;
        axios.get('http://127.0.0.1:8000/api/products')
            .then((res: AxiosResponse<Product[], any>) => {
                setTimeout(() => {
                    products.value = res.data;
                    loading.value = false;
                }, 5000)
             })
            .catch((e) => {
                isError.value = true;
                messageError.value = e;
                loading.value = false;
            });
    }

    return {
        getProducts,
        result: computed(() => products.value),
        loading,
        isError: computed(() => isError.value),
        messageError: computed(() => messageError.value),
    }
}

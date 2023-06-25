import { ref, computed } from 'vue';
import axios, { AxiosResponse, AxiosError } from 'axios';
import ProductDto from '../types/Product.dto';

export function useApiProducts() {
    const products = ref<ProductDto[]>([]);
    const loading = ref<boolean>(false);
    const isError = ref <boolean>(false);
    const messageError = ref <string>('');

    const getProducts = () => {
        loading.value = true;
        axios.get('http://127.0.0.1:8000/api/products')
            .then((res: AxiosResponse<ProductDto[], any>) => {
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

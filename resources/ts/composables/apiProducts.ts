import { ref, computed } from 'vue';
import axios, { AxiosResponse, AxiosError } from 'axios';
import ProductDto from '../types/Product.dto';
import ProductRequestDto from '../types/ProductRequest.dto';

const products = ref<ProductDto[]>([]);

export function useApiProducts() {
    const loading = ref<boolean>(false);
    const isError = ref <boolean>(false);
    const errorMessage = ref <string>('');
    const successMessage = ref('');

    const getProducts = () => {
        loading.value = true;
        axios.get('http://127.0.0.1:8000/api/products')
            .then((res: AxiosResponse<ProductDto[], any>) => {
                products.value = res.data;
                loading.value = false;
             })
            .catch((e) => {
                isError.value = true;
                errorMessage.value = e;
                loading.value = false;
            });
    }
    const saveProduct = (product: ProductRequestDto) => {
        loading.value = true;
        axios.post('http://127.0.0.1:8000/api/products', product)
        .then((res: AxiosResponse<any, any>) => {
                loading.value = false;
                successMessage.value = res.data.message ?? 'Produto salvo com sucesso.';
                if (res.data?.product) {
                    const product = res.data?.product as ProductDto;
                    products.value.push({ id: product.id, name: product.name, description: '', price: product.price, quantity: product.quantity });
                }

                setTimeout(() => {
                   successMessage.value = '';
                }, 2500)
             })
            .catch((e) => {
                isError.value = true;
                errorMessage.value = e;
                loading.value = false;
            });
    }

    return {
        getProducts,
        saveProduct,
        result: computed(() => products.value),
        loading,
        isError: computed(() => isError.value),
        messageError: computed(() => errorMessage.value),
        successMessage: computed(() => successMessage.value),
    }
}

import { ref, computed } from 'vue';
import { AxiosResponse } from 'axios';
import http from '../http';

import ProductDto from '../types/Product.dto';
import Checkout from '../models/Checkout';
import CheckoutDto from '../types/Checkout.dto';
import { CheckoutMapper } from '../mappers/CheckoutMapper';
import Product from '../models/Product';
type MessageCheckoutResponse = { message: string; checkout: CheckoutDto };

const checkout = ref<Checkout | null>(null);

export function useApiCheckout() {
    const loading = ref<boolean>(false);
    const isError = ref<boolean>(false);
    const errorMessage = ref<string>('');
    const successMessage = ref('');
    const saveMessage = ref('');

    const getCheckout = (): Promise<boolean> => {
        return new Promise((resolve, reject) => {
        loading.value = true;
        http.get('/api/checkouts')
            .then((res: AxiosResponse<CheckoutDto[] , any>) => {
                if (res.data) {
                    checkout.value = CheckoutMapper.checkoutFromDTO(res.data[0]);
                }
                loading.value = false;
                resolve(true);
            })
            .catch((e) => {
                isError.value = true;
                errorMessage.value = e;
                loading.value = false;
                reject(false);
            });
        });
    }

    const createCheckout = (name: string) => {
        loading.value = true;
        http.post('/api/checkouts', { name })
            .then((res: AxiosResponse<MessageCheckoutResponse, any>) => {
                if (res.data.checkout) {
                    const ckt = res.data.checkout;
                    checkout.value = new Checkout(ckt.name, ckt.id);
                }
                loading.value = false;
            })
            .catch((e) => {
                isError.value = true;
                errorMessage.value = e;
                loading.value = false;
            });
    }

    const save = (products:  Product[]) => {
        loading.value = true;
        const checkoutDto = CheckoutMapper.checkoutToDTO(new Checkout(checkout.value!.getName(), checkout.value!.getId(), products))
        http.post(`/api/checkouts/${checkoutDto.id}/products/`, { products: checkoutDto.products})
            .then((res: AxiosResponse<{ message: string }, ProductDto[]>) => {
                loading.value = false;
                saveMessage.value = res.data.message ?? 'Pedido concluído com sucesso!';
                setTimeout(() => {
                    saveMessage.value = '';
                }, 2500)
            })
            .catch((e) => {
                isError.value = true;
                errorMessage.value = e;
                loading.value = false;
            });
    }

    return {
        getCheckout,
        save,
        createCheckout,
        checkoutModel: computed(() => checkout.value),
        loading,
        isError: computed(() => isError.value),
        messageError: computed(() => errorMessage.value),
        successMessage: computed(() => successMessage.value),
        saveMessage: computed(() => saveMessage.value),
    }
}

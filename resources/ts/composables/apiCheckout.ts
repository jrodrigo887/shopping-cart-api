import { ref, computed } from 'vue';
import axios, { AxiosResponse, AxiosError } from 'axios';
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

    const getCheckout = (): Promise<void> => {
        return new Promise((resolve, reject) => {
        loading.value = true;
        axios.get('http://127.0.0.1:8000/api/checkouts/2')
            .then((res: AxiosResponse<CheckoutDto , any>) => {
                if (res.data) {
                    checkout.value = CheckoutMapper.checkoutFromDTO(res.data);
                }
                loading.value = false;
                resolve();
            })
            .catch((e) => {
                isError.value = true;
                errorMessage.value = e;
                loading.value = false;
                reject();
            });
        });
    }
    const createCheckout = (name: string) => {
        loading.value = true;
        axios.post('http://127.0.0.1:8000/api/checkouts', { name })
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
        axios.post(`http://127.0.0.1:8000/api/checkouts/${checkoutDto.id}/products/`, { products: checkoutDto.products})
            .then((res: AxiosResponse<{ message: string }, ProductDto[]>) => {
                loading.value = false;
                successMessage.value = res.data.message ?? 'Solicitação concluída';
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
        getCheckout,
        save,
        createCheckout,
        checkoutModel: computed(() => checkout.value),
        loading,
        isError: computed(() => isError.value),
        messageError: computed(() => errorMessage.value),
        successMessage: computed(() => successMessage.value),
    }
}
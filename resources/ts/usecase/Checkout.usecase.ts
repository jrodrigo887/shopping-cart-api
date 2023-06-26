import Product from '../models/Product';
import { useApiCheckout } from '../composables/apiCheckout';
const { save, checkoutModel } = useApiCheckout()

export default class CheckoutUsecase {
    private products: Product[];

    constructor() {
        this.products = []
        this.verifyCheckoutDatabase();

    }

    public getProducts() { return this.products; }

    public getTotal() {
        let total = 0;
        return this.products.forEach((prod) => {
            total += prod.getSubtotal();
        })
    }

    public setProduct(product: Product) {
        const item = this.products.find((prod) => prod.getId() === product.getId())
        if (item) {
            item.setQuantity(item.getQuantity() + 1);
            return;
        }
        product.setQuantity(1);
        this.products.push(product);
    }

    public quantityProductPerId(id: number): number {
        return this.products.find((prod: Product) => prod.getId() === id)?.getQuantity() ?? 1;
    }

    public removeProductPerId(id: number) {
        const index = this.products.findIndex((prod: Product) => prod.getId() === id);
        if (index < 0) return;
        // reescrver o array
        this.products = this.products.filter(p => p.getId() !== id);
    }

    public finishCheckout() {
        save(this.products);
    }

    public verifyCheckoutDatabase() {
        if (checkoutModel.value) {
            this.products.push(...checkoutModel.value.getProducts());
        }
    }
}

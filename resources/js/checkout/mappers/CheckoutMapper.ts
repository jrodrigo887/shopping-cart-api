import Checkout from "../models/Checkout";
import Product from "../models/Product";
import CheckoutDto from "../types/Checkout.dto";

export abstract class CheckoutMapper {
    static checkoutToDTO(checkout: Checkout): CheckoutDto {
        const prod = checkout.getProducts();
        return {
            id: checkout.getId(),
            name: checkout.getName(),
            products: prod.map(pd => ({
                id: pd.getId(),
                name: pd.getName(),
                description: '',
                price: pd.getPrice(),
                quantity: pd.getQuantity(),
            }))
        }
    }

    static checkoutFromDTO(checkout: CheckoutDto): Checkout {
        const products = checkout.products.map((pd) =>
            new Product(pd.name, pd.description, pd.price, pd.id, pd.quantity));

        return new Checkout(checkout.name, checkout.id, products);
    }
}

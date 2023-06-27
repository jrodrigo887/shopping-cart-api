import ProductDto from "./Product.dto";

export default interface CheckoutDto {
    id: number;
    name: string;
    products: ProductDto[]
}

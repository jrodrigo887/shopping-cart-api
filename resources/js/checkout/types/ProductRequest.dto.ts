import ProductDto from "./Product.dto";

export default interface ProductRequestDto extends Omit<ProductDto, 'id'> {}

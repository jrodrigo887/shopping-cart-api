import Product from "./Product";

export default class Checkout {
    // private products: Product[];

    constructor(
        private readonly name: string,
        private readonly id: number,
        private products: Product[] = [],
        ) {}

        public getName() { return this.name; }
        public getId() { return this.id; }
        public setProducts(prod: Product[]) {
            this.products = prod;
        }
        public getProducts() {
            return this.products;
        }
}

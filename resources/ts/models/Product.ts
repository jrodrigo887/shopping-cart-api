export default class Product {
    constructor(
        private readonly name: string,
        private readonly description: string,
        private readonly price: number,
        private readonly id: number,
        private quantity: number = 0,
        ) {}

        public getName() { return this.name; }
        public getId() { return this.id; }
        public getPrice() { return this.price; }
        public getQuantity() { return this.quantity; }
        public setQuantity(qtd: number) { return this.quantity = qtd; }
}

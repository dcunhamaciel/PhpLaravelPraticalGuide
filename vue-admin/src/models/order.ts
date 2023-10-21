export class Order {
    constructor(
        public id: number,
        public name: string,
        public email: string,
        public description: string,
        public total: number) {
    }
}
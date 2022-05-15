<template>
    <div>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Stock</h5>
                    </div>

                    <div class="card-body">
                        <table class="table table-responsive table-bordered text-center" >
                            <thead>
                                <tr>
                                    <th>Sl</th>
                                    <th>Item</th>
                                    <th>Quantity</th>
                                    <th>Price</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(stock,i) in stocks">
                                    <td>{{++i}}</td>
                                    <td>{{items[stock.item_id].name}}</td>
                                    <td>{{stock.qty}}</td>
                                    <td>{{stock.price}}</td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="2" align="right">Total</td>
                                    <td>{{totalQnt()}}</td>
                                    <td>{{totalPrice()}}</td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data(){
            return {
                stocks: [],
                items: []
            }
        },
        mounted() {
            this.loadStock();
            this.totalPrice();
            this.totalQnt();
            this.loadItem();
        },
         methods: {
            loadStock()
            {
                axios.get('/api/stock').then(response => {
                    this.stocks = response.data;
                    console.log(response.data);
                }).catch(error =>{
                    Toast.fire({
                        icon: 'error',
                        title: error
                    });
                });
            },
            
            totalQnt(){
                let total=0;
                this.stocks.forEach(element => {
                    total += Number(element.qty);
                });
                return total;
            },
            totalPrice(){
                let total=0;
                this.stocks.forEach(element => {
                    total += Number(element.price);
                });
                return total;
            },
            loadItem(){
                axios.get('/api/item').then(response => {
                    if(response.data)
                    {
                        this.items = response.data;
                    }
                }).catch(error =>{
                    Toast.fire({
                        icon: 'error',
                        title: error
                    });
                });
                
            }

        }

    }
</script>
<style scoped>
.table {
    width: 80%;
    margin: 0 auto !important;
}
</style>

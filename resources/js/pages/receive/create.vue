<template>
	   <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5>Receive</h5>
                        <router-link :to="{name: 'receive-list'}" class="btn btn-primary">Receive List</router-link>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-8 offset-3">
								<form @submit.prevent='addReceive'>
									<div class="form-group">
                                        
                                        <div class="row">
                                            <label class="col-md-4">Supplier</label>
                                            <select v-model="supplier" class="col-md-8 form-control" >
                                                <option v-for="(value, name, index) in suppliers" :selected="1 == name" :value="value.id">{{ value.name }}</option>
                                            </select>
                                            <small class="text-danger" v-if="errors.supplier"> {{ errors.supplier[0] }} </small>
                                        </div>
									</div>
                                    <table class="table table-responsive table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Item</th>
                                                <th>Qty</th>
                                                <th>Uint Price</th>
                                                <th>Amount</th>
                                                <th width="20%"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr class="form-group" v-for="(input,k) in inputs" :key="k">
                                                <td>
                                                    <select v-model="input.item" class="form-control" requred="1">
                                                        <option v-for="(value, name, index) in items" :selected="1 == name" :value="value.id">{{ value.name }}</option>
                                                    </select>
                                                    <small class="text-danger" v-if="errors.item"> {{ errors.item[k] }} </small>
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control" v-model="input.qty" requred="1">
                                                    <small class="text-danger" v-if="errors.qty"> {{ errors.qty[k] }} </small>
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control" v-model="input.price" requred="1">
                                                    <small class="text-danger" v-if="errors.price"> {{ errors.price[k] }} </small>
                                                </td>
                                                <td>
                                                    {{Number(input.qty*input.price)}}
                                                </td>

                                                <td width="20%">
                                                    <i class="btn btn-danger btn-sm fas fa-minus-circle" @click="remove(k)" v-show="k || ( !k && inputs.length > 1)">-</i>
                                                    <i class="btn btn-info btn-sm fas fa-plus-circle" @click="add(k)" v-show="k == inputs.length-1">+</i>
                                                </td>
                                            </tr>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td>Total</td>
                                                <td>{{totalQnty()}}</td>
                                                <td></td>
                                                <td>{{totalPrice()}}</td>
                                                <td></td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                   
                                   
									<div class="form-group">
										<button type="submit" class="btn btn-primary btn-block">Create</button>
									</div>
								</form>
							</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { Form } from 'vform'
export default {

	created(){
		if (!User.loggedIn()) {
			this.$router.push({name: '/'})
		}
	},

	data () {
		return {
			inputs: [{
                item: '',
                qty: '',
                price: ''

            }],
            supplier:'',
			errors: {},
            suppliers:[],
            items:[]
		}
	},
	mounted(){
        this.loadSupplier();
        this.loadItem();
	},	
	methods:{
		addReceive () {
            axios.post('/api/receive', {
                    items: JSON.stringify(this.inputs),
                    supplier: this.supplier
                })
                .then(response => {
                    console.log(response.data);
                    Toast.fire({
                        icon: 'success',
                        title: response.data.sys_no + ' created successfully'
                    });
                    this.$router.push({ name: 'receive-list'})
                })
                .catch(error => {
                    Toast.fire({
                        icon: 'error',
                        title: error
                    });
                })
        },
        add () {
            this.inputs.push({
                item: '',
                qty: '',
                price: ''
            })
            console.log(this.inputs)
        },

        remove (index) {
            this.inputs.splice(index, 1)
        },
        loadSupplier(){
            axios.get('/api/supplier').then(response => {
                if(response.data)
                {
                    this.suppliers = response.data;
                }
            }).catch(error =>{
                Toast.fire({
                    icon: 'error',
                    title: error
                });
            });
              
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
              
        },
        totalQnty(){
            let total=0;
            this.inputs.forEach(element => {
                total += Number(element.qty);
            });
            return total;
        },
        totalPrice(){
            let total=0;
            this.inputs.forEach(element => {
                total += Number(element.price*element.qty);
            });
            return total;
        }
	}
}
</script>

<style lang="css" scoped>
</style>
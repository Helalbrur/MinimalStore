<template>
	   <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5>Requisition</h5>
                        <router-link :to="{name: 'requisition-list'}" class="btn btn-primary">Requisition List</router-link>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-8 offset-3">
								<form @submit.prevent='addRequisition'>
                                    <table class="table table-responsive table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Item</th>
                                                <th>Qty</th>
                                                <th>Item Total Price</th>
                                                
                                                <th width="20%"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr class="form-group" v-for="(input,k) in inputs" :key="k">
                                                <td>
                                                    <select v-model="input.item" class="form-control" requred="1" @change="getItemForRequisition(k)">
                                                        <option v-for="(value, name, index) in items" :selected="1 == name" :value="value.id">{{ value.name }}</option>
                                                    </select>
                                                    <small class="text-danger" v-if="errors.item"> {{ errors.item[k] }} </small>
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control" v-model="input.qty" requred="1" @keyup="getItemForRequisition(k)">
                                                    <small class="text-danger" v-if="errors.qty"> {{ errors.qty[k] }} </small>
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control" v-model="input.price" requred="1" disabled>
                                                    <small class="text-danger" v-if="errors.price"> {{ errors.price[k] }} </small>
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
                price: '',
                mst_id : ''
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
		addRequisition () {
            axios.post('/api/requisition', {
                    items: JSON.stringify(this.inputs)
                })
                .then(response => {
                    console.log(response.data);
                    Toast.fire({
                        icon: 'success',
                        title: response.data.sys_no + ' created successfully'
                    });
                    this.$router.push({ name: 'requisition-list'})
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
                price: '',
                mst_id : ''
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
                total += Number(element.price);
            });
            return total;
        },
        getItemForRequisition(index)
        {
            let item=this.inputs[index];
            if(item.qty>0 && item.item!='')
            {
                axios.post('/api/get_receive_item_for_requisition', {
                    item_id: item.item,
                    qty: item.qty
                })
                .then(response => {
                    if(response.data.qty>0)
                    {
                        if(response.data.qty<item.qty){
                            Toast.fire({
                                icon: 'errr',
                                title: item.qty + ' is not availabe for this item available item : '+ response.data.qty
                            });
                        }
                        item.qty = response.data.qty;
                        item.price = response.data.price;
                        item.mst_id = response.data.mst_id ;
                        this.inputs[index]=item;
                        console.log(item);
                        
                    }
                    else
                    {
                        Toast.fire({
                            icon: 'error',
                            title: item.qty + ' is not availabe for this item'
                        });
                    }

                })
                .catch(error => {
                    Toast.fire({
                        icon: 'error',
                        title: error
                    });
                })
            }
        }
	}
}
</script>

<style lang="css" scoped>
</style>
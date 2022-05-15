<template>
	   <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5>Issue</h5>
                        <router-link :to="{name: 'issue-list'}" class="btn btn-primary">Issue List</router-link>
                        <div class="modal fade" id="add" role="dialog">
                            <div class="modal-dialog">
                                <!-- Modal content-->
                                <div class="modal-content">
                                    <div class="modal-header bg-primary">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>
                                    <div class="modal-body">
                                        <form method="POST" @submit.prevent='getRequisition'>
                                        
                                            <div class="form-group row">
                                                <label for="name" class="col-md-4 col-form-label text-md-right">Requisition No</label>
                                                <div class="col-md-6">
                                                    <input type="text" class="form-control" v-model="search" requred="1" >
                                                </div>
                                            </div>
                                            <div class="form-group row mb-0">
                                                <div class="col-md-6 offset-md-4">
                                                    <button type="submit" class="btn btn-primary">
                                                    Search
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div> <!-- End of modal-body -->
                                    <div class="modal-footer">
                                        <table id="search_list" style="display:none;" class="table table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th>Sl</th>
                                                    <th>Requisition No</th>
                                                    <th>Qty</th>
                                                    <th>Price</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr v-for="(requisition,i) in requisitions" @click="putRequisitionNo(requisition)" data-dismiss="modal">
                                                    <td>{{++i}}</td>
                                                    <td>{{requisition.sys_no}}</td>
                                                    <td>{{requisition.qty}}</td>
                                                    <td>{{requisition.price}}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    </div>
                                    
                                </div>

                            </div>
                        </div> <!-- End of modal -->
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-8 offset-3">
								<form @submit.prevent='addIssue'>
                                    <div class="form-group">
                                        <div class="row">
                                            <label class="col-md-4">Requisition</label>
                                            <input data-toggle="modal" data-target="#add" type="text" class="form-control" v-model="requisition_no" requred="1" @keyup="getItemForIssue()">
                                        </div>
									</div>
                                    <table class="table table-responsive table-bordered mb-10">
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
                                                   <input type="hidden" class="form-control" v-model="input.item_id" requred="1" >
                                                    {{items[input.item_id]}}
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control" v-model="input.qty" requred="1" >
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
                item_id: '',
                qty: '',
                price: '',
                mst_id : ''
            }],
            requisitions:[],
            requisition_no:'',
            req_sys_no: '',
            search:'',
			errors: {},
            items:[]
		}
	},
	mounted(){
        this.loadItem();
	},	
	methods:{
		addRequisition () {
            axios.post('/api/requisition', {
                    items: JSON.stringify(this.inputs),
                    req_sys_no :this.req_sys_no
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
                item_id: '',
                qty: '',
                price: '',
                mst_id : ''
            })
            console.log(this.inputs)
        },

        remove (index) {
            this.inputs.splice(index, 1)
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
        getItemForIssue(id)
        {
            axios.post('/api/get_requisition_item_for_issue', {
                id: id,
            })
            .then(response => {
                item.qty = response.data.qty;
                item.price = response.data.price;
                item.mst_id = response.data.mst_id ;
                item.item_id = response.data.item_id ;
                this.inputs.push(item);
                console.log(item);
            })
            .catch(error => {
                Toast.fire({
                    icon: 'error',
                    title: error
                });
            })
            
        },
        getRequisition(){
            axios.post('/api/search_requisition', {
                requisition_no: this.search,
            })
            .then(response => {
                this.requisitions=response.data;
                $('#search_list').css('display','block');
            })
            .catch(error => {
                Toast.fire({
                    icon: 'error',
                    title: error
                });
            })
        },
        putRequisitionNo(requisition)
        {
            this.requisition_no=requisition.sys_no;
            this.req_sys_no=requisition.sys_no;
            this.getItemForIssue(requisition.id);
        }

	}
}
</script>

<style lang="css" scoped>
</style>
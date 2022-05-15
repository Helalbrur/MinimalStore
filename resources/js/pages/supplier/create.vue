<template>
	   <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5>Supplier</h5>
                        <router-link :to="{name: 'supplier-list'}" class="btn btn-primary">Supplier List</router-link>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6 offset-3">
								<form @submit.prevent='createItem'>
									<div class="form-group">
                                        <label for="">Name</label>
                                        <input type="text" v-model="Form.name" class="form-control" name="name" placeholder="Supplier name" :class="{ 'is-invalid': Form.errors.has('name') }">
                                        <has-error :form="Form" field="name"></has-error>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Email</label>
                                        <input type="text" v-model="Form.email" class="form-control" name="email" placeholder="Supplier name" :class="{ 'is-invalid': Form.errors.has('email') }">
                                        <has-error :form="Form" field="email"></has-error>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Phone</label>
                                        <input type="text" v-model="Form.phone" class="form-control" name="phone" placeholder="Supplier phone" :class="{ 'is-invalid': Form.errors.has('phone') }">
                                        <has-error :form="Form" field="phone"></has-error>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Address</label>
                                        <textarea  v-model="Form.address" class="form-control" rows="10" cols="50" :class="{ 'is-invalid': Form.errors.has('address') }"></textarea>
                                        <has-error :form="Form" field="address"></has-error>
                                    </div>
                                    <div class="form-group">
										<select v-model="Form.status" requred class="form-control" :class="{ 'is-invalid': Form.errors.has('status') }">
                                            <option :value="0">InActive</option>
											<option :value="1">Active</option>
                                        </select>
										<has-error :form="Form" field="status"></has-error>
									</div>
                                   
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
			Form: new Form({
                name: '',
                email: '',
                phone: '',
                address: '',
                status: 1
            }),
			errors: {},
		}
	},
	mounted(){
		this.selectedStatus=1;
	},	
	methods:{
		async createItem(){
			await this.Form.post('/api/supplier/').then(() => {
                   Toast.fire({
                        icon: 'success',
                        title: 'Item updated Successfully'
                    });
                    this.$router.push('item-list');
                }).catch(error =>{
                     Toast.fire({
                        icon: 'error',
                        title: error
                    });
                })
			
		}
	}
}
</script>

<style lang="css" scoped>
</style>
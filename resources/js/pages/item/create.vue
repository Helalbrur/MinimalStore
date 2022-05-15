<template>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5>Create Item </h5>
                        <router-link :to="{name: 'item-list'}" class="btn btn-primary">Item List</router-link>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6 offset-3">
								<form @submit.prevent='createItem'>
									<div class="form-group">
										<input type="text" class="form-control" id="item-name" placeholder="Item name" v-model="itemForm.name" :class="{ 'is-invalid': itemForm.errors.has('name') }">
										<has-error :form="itemForm" field="name"></has-error>
									</div>
                                    <div class="form-group">
										<input type="text" class="form-control" id="item-description" placeholder="Item Description" v-model="itemForm.description" :class="{ 'is-invalid': itemForm.errors.has('description') }">
										<has-error :form="itemForm" field="description"></has-error>
									</div>
                                    <div class="form-group">
										<select v-model="itemForm.status" requred class="form-control" :class="{ 'is-invalid': itemForm.errors.has('status') }">
											<option :value="0">InActive</option>
											<option :value="1" selected="true">Active</option>
                                        </select>
										<has-error :form="itemForm" field="status"></has-error>
									</div>
                                   
									<div class="form-group">
										<button type="submit" class="btn btn-primary btn-block">Create</button>
									</div>
								</form>
								<div class="text-center">
								</div>
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
			itemForm: new Form({
                name: '',
                description: '',
                status: 1
            })
		}
	},
	mounted(){
	},	
	methods:{
		async createItem(){
		  	await this.itemForm.post('/api/item/').then(() => {
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
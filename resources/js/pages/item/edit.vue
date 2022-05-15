<template>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5>Edit Item - {{  itemForm.name }}</h5>
                        <router-link :to="{name: 'item-list'}" class="btn btn-primary">Item List</router-link>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6 offset-3">
                                <form @submit.prevent="updateItem">
                                    <div class="form-group">
                                        <label for="">Item name</label>
                                        <input type="text" v-model="itemForm.name" class="form-control" name="name" placeholder="Item name" :class="{ 'is-invalid': itemForm.errors.has('name') }">
                                        <has-error :form="itemForm" field="name"></has-error>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Item Description</label>
                                        <textarea  v-model="itemForm.description" class="form-control" rows="10" cols="50" :class="{ 'is-invalid': itemForm.errors.has('description') }"></textarea>
                                        <has-error :form="itemForm" field="description"></has-error>
                                    </div>
                                    <div class="form-group">
										<select v-model="itemForm.status" class="form-control" :class="{ 'is-invalid': itemForm.errors.has('status') }">
                                            <option v-for="(value, name, index) in statuses" :selected="1 == name" :value="name">{{ value }}</option>
                                        </select>
										<has-error :form="itemForm" field="status"></has-error>
									</div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-success">Update Item</button>
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
    data(){
        return {
            itemForm: new Form({
                name: '',
                description: '',
                status: ''
            }),
            selectedStatus:1,
            statuses:['InActive','Active'],
            uid: ''
        }
    },
    methods: {
       async updateItem(){
			let id=User.getItem('item');
            if(id)
            {
               await this.itemForm.put(`/api/item/${id}`).then(() => {
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
            
        },
       async loadItem(){
            let id=User.getItem('item');
            if(id)
            {
               await axios.get(`/api/item/${id}`).then(response => {
                    if(response.data)
                    {
                       this.itemForm.name = response.data.name;
                        this.itemForm.description = response.data.description;
                        this.itemForm.status = response.data.status;
                       // console.log(response.data);
                        this.selectedStatus = response.data.status;
                    }
                }).catch(error =>{
                    Toast.fire({
                        icon: 'error',
                        title: error
                    });
                });
            }  
        }
    },
    mounted(){
        this.loadItem();
        this.selectedStatus=1;
    },
    created(){
        this.loadItem();
        this.selectedStatus=1;
    }
}
</script>

<style>
</style>
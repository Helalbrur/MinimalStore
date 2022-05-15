<template>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5>Supplier - {{  Form.name }}</h5>
                        <router-link :to="{name: 'supplier-list'}" class="btn btn-primary">Supplier List</router-link>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6 offset-3">
                                <form @submit.prevent="updateSupplier">
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
										<select v-model="Form.status" class="form-control" :class="{ 'is-invalid': Form.errors.has('status') }">
                                            <option v-for="(value, name, index) in statuses" :selected="1 == name" :value="name">{{ value }}</option>
                                        </select>
										<has-error :form="Form" field="status"></has-error>
									</div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-success">Update Supplier</button>
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
            Form: new Form({
                name: '',
                email: '',
                phone: '',
                address: '',
                status: ''
            }),
            selectedStatus:'',
            statuses:['InActive','Active'],
            uid: ''
        }
    },
    methods: {
        updateSupplier(){
			let id=User.getItem('supplier');
            if(id)
            {
                this.Form.put(`/api/supplier/${id}`).then(() => {
                   Toast.fire({
                        icon: 'success',
                        title: 'supplier updated Successfully'
                    });
                    this.$router.push('supplier-list');
                }).catch(error=>{
                    Toast.fire({
                        icon: 'error',
                        title: error
                    });
                });
            }
            
        },
        loadSupplier(){
            let id=User.getItem('supplier');
            if(id)
            {
                axios.get(`/api/supplier/${id}`).then(response => {
                    if(response.data)
                    {
                        this.Form.name = response.data.name;
                        this.Form.email = response.data.email;
                        this.Form.phone = response.data.phone;
                        this.Form.address = response.data.address;
                        this.Form.status = response.data.status;
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
        this.loadSupplier();
    },
    created(){
        this.loadSupplier();
    }
}
</script>

<style>
</style>
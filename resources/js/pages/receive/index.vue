<template>
    <div>
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Receove</h5>
                        <router-link :to="{name: 'receive-create'}" class="btn btn-primary">Create Receove</router-link>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-8">
                                <table class="table table-responsive table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Sl</th>
                                            <th>Receive No</th>
                                            <th>Supplier</th>
                                            <th>Qty</th>
                                            <th>Price</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="(receive,i) in receives">
                                            <td>{{++i}}</td>
                                            <td>{{receive.sys_no}}</td>
                                            <td>{{suppliers[receive.supplier_id].name}}</td>
                                            <td>{{receive.qty}}</td>
                                            <td>{{receive.price}}</td>
                                            <td style="width:12%">
                                                <a @click.prevent="editReceive(receive)" href="#" class="btn btn-sm btn-info"><i class="fa fa-pen"></i></a>
                                                <a @click.prevent="deleteReceive(receive)" href="#" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
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
                suppliers: [],
                receives: []
            }
        },
        mounted() {
            this.loadSupplier();
            this.loadReceive();
        },
        created(){
            this.loadSupplier();
            this.loadReceive();
        },
         methods: {
            loadSupplier()
            {
                axios.get('/api/supplier').then(response => {
                    this.suppliers = response.data;
                }).catch(error =>{
                    //  this.errors = error.response.data.errors;
                    Notification.error()
                });
            },
            loadReceive()
            {
                axios.get('/api/receive').then(response => {
                    this.receives = response.data;
                }).catch(error =>{
                    Toast.fire({
                        icon: 'error',
                        title: error
                    });
                });
            },
            deleteReceive(receive){
                if(confirm("Do you really want to delete?")){
                    if(Accessible.getUserAccess('receive-delete')===true)
                    {
                        axios.delete(`/api/receive/${supplier.id}`).then(() => {
                            Toast.fire({
                                icon: 'success',
                                title: 'Receive Deleted Successfully'
                            });
                        }).catch(error =>{
                            Toast.fire({
                                icon: 'error',
                                title: error
                            });
                        });
                        let index = this.receives.indexOf(receive);
                        this.receives.splice(index, 1);
                    }
                    else
                    {
                        Toast.fire({
                            icon: 'error',
                            title: 'Delete is not allowed to '+User.getUserRole()
                        });
                    }
                }
                
            },
            editReceive(receive){
                this.$router.push({ name: 'receive-edit'});
                User.setItem('receive',receive.id);
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

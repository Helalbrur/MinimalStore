<template>
    <div>
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Suppliers</h5>
                        <router-link :to="{name: 'supplier-create'}" class="btn btn-primary">Create Supplier</router-link>
                    </div>

                    <div class="card-body">
                        <table class="table table-responsive table-bordered">
                            <thead>
                                <tr>
                                    <th>Sl</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Address</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(supplier,i) in suppliers">
                                    <td>{{++i}}</td>
                                    <td>{{supplier.name}}</td>
                                    <td>{{supplier.email}}</td>
                                    <td>{{supplier.phone}}</td>
                                    <td width="15%" style="word-break:break-word">{{supplier.address}}</td>
                                    <td>{{statuses[supplier.status]}}</td>
                                    <td style="width:12%">
                                        <a @click.prevent="editSupplier(supplier)" href="#" class="btn btn-sm btn-info"><i class="fa fa-pen"></i></a>
                                        <a @click.prevent="deleteSupplier(supplier)" href="#" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
                                    </td>
                                </tr>
                            </tbody>
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
                suppliers: [],
                statuses:['InActive','Active']
            }
        },
        mounted() {
            this.loadSupplier();
        },
        created(){
            this.loadSupplier();
        },
         methods: {
            loadSupplier()
            {
                axios.get('/api/supplier').then(response => {
                    this.suppliers = response.data;
                }).catch(error =>{
                    Toast.fire({
                        icon: 'error',
                        title: error
                    });
                });
            },
            deleteSupplier(supplier){
                if(confirm("Do you really want to delete?")){
                    if(Accessible.getUserAccess('supplier-delete')===true)
                    {
                        axios.delete(`/api/supplier/${supplier.id}`).then(() => {
                            Toast.fire({
                                icon: 'success',
                                title: 'Supplier Deleted Successfully'
                            });
                        }).catch(error =>{
                            Toast.fire({
                                icon: 'error',
                                title: error
                            });
                        });
                        let index = this.suppliers.indexOf(supplier);
                        this.suppliers.splice(index, 1);
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
            editSupplier(supplier){
                this.$router.push({ name: 'supplier-edit'});
                User.setItem('supplier',supplier.id);
            }
        }

    }
</script>

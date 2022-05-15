<template>
    <div>
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Items</h5>
                        <router-link :to="{name: 'item-create'}" class="btn btn-primary">Create Item</router-link>
                    </div>

                    <div class="card-body">
                        <table class="table table-responsive table-bordered">
                            <thead>
                                <tr>
                                    <th>Sl</th>
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(item,i) in items">
                                    <td>{{++i}}</td>
                                    <td>{{item.name}}</td>
                                    <td>{{item.description}}</td>
                                    <td>{{statuses[item.status]}}</td>
                                    <td style="width:12%">
                                        <a @click.prevent="editItem(item)" href="#" class="btn btn-sm btn-info"><i class="fa fa-pen"></i></a>
                                        <a @click.prevent="deleteItem(item)" href="#" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
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
                items: [],
                statuses:['InActive','Active']
            }
        },
        mounted() {
            this.loadItem();
        },
        created(){
            this.loadItem();
        },
         methods: {
            loadItem()
            {
                axios.get('/api/item').then(response => {
                    this.items = response.data;
                }).catch(error =>{
				//  this.errors = error.response.data.errors;
                    Notification.error()
                });
            },
            deleteItem(item){
                if(confirm("Do you really want to delete?")){
                    if(Accessible.getUserAccess('item-delete')===true)
                    {
                        axios.delete(`/api/item/${item.id}`).then(() => {
                            Toast.fire({
                                icon: 'success',
                                title: 'Item Deleted Successfully'
                            });
                        }).catch(error =>{
                             Toast.fire({
                                icon: 'error',
                                title: error
                            });
                        });
                        let index = this.items.indexOf(item);
                        this.items.splice(index, 1);
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
            editItem(item){
                this.$router.push({ name: 'item-edit'});
                User.setItem('item',item.id);
            },
            sortedArray: function() {
                function compare(a, b) {
                    if (a.name < b.name)
                        return -1;
                    if (a.name > b.name)
                        return 1;
                    return 0;
                }

                return this.arrays.sort(compare);
            }
            
        }

    }
</script>

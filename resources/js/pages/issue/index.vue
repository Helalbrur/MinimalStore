<template>
    <div>
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Requisition</h5>
                        <router-link :to="{name: 'requisition-create'}" class="btn btn-primary">Create Requisition</router-link>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-8" style="justify-content:center;text-align:center;">
                                <table class="table table-responsive table-bordered" width="100%">
                                    <thead>
                                        <tr>
                                            <th>Sl</th>
                                            <th>Requisition No</th>
                                            <th>Qty</th>
                                            <th>Price</th>
                                            <th>Staus</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="(requisition,i) in requisitions">
                                            <td>{{++i}}</td>
                                            <td>{{requisition.sys_no}}</td>
                                            <td>{{requisition.qty}}</td>
                                            <td>{{requisition.price}}</td>
                                            <td>{{statuses[requisition.status]}}</td>
                                            <td style="width:35%">
                                                <a @click.prevent="editRequisition(requisition)" href="#" class="btn btn-sm btn-info"><i class="fa fa-pen"></i></a>
                                                <a @click.prevent="approveRequisition(requisition)" href="#" class="btn btn-sm btn-primary">
                                                    <span v-if="requisition.status==0">Approve</span>
                                                    <span v-if="requisition.status==1">Unapproved</span>
                                                </a>
                                                <a @click.prevent="deleteRequisition(requisition)" href="#" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
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
                requisitions: [],
                statuses: ['Unapprove','Approved']
            }
        },
        mounted() {
            this.loadRequisition();
        },
        created(){
            this.loadRequisition();
        },
         methods: {
            loadRequisition()
            {
                axios.get('/api/requisition').then(response => {
                    this.requisitions = response.data;
                }).catch(error =>{
                    Toast.fire({
                        icon: 'error',
                        title: error
                    });
                });
            },
            deleteRequisition(requisition){
                if(confirm("Do you really want to delete?")){
                    if(Accessible.getUserAccess('requisition-delete')===true)
                    {
                        axios.delete(`/api/requisition/${requisition.id}`).then(() => {
                            Toast.fire({
                                icon: 'success',
                                title: 'Requisition Deleted Successfully'
                            });
                        }).catch(error =>{
                            Toast.fire({
                                icon: 'error',
                                title: error
                            });
                        });
                        let index = this.requisitions.indexOf(requisition);
                        this.requisitions.splice(index, 1);
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
            editRequisition(requisition){
                this.$router.push({ name: 'requisition-edit'});
                User.setItem('requisition',requisition.id);
            },
            approveRequisition(requisition)
            {
                let bitwiseor=requisition.status ^ 1
                if(confirm("Do you really want to "+this.statuses[bitwiseor]+"?"))
                {
                    if(Accessible.getUserAccess('requisition_approve')===true)
                    {
                        axios.post(`/api/requisition_approve/${requisition.id}`).then(response => {
                            if(response.data.status==1 && requisition.status ==0)
                            {
                                Toast.fire({
                                    icon: 'success',
                                    title: this.statuses[response.data.status]
                                });
                                this.loadRequisition();
                            }
                            else if(response.data.status==0 && requisition.status ==1)
                            {
                                Toast.fire({
                                    icon: 'success',
                                    title: this.statuses[response.data.status]
                                });
                                this.loadRequisition();
                            }
                            else if(requisition.status==response.data.status && response.data.status==0)
                            {
                                Toast.fire({
                                    icon: 'error',
                                    title: 'Issue Found delete not allowed'
                                });
                            }
                        }).catch(error =>{
                            Toast.fire({
                                icon: 'error',
                                title: error
                            });
                        });
                    }
                    else
                    {
                        Toast.fire({
                            icon: 'error',
                            title: 'Delete is not allowed to '+User.getUserRole()
                        });
                    }
                }
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

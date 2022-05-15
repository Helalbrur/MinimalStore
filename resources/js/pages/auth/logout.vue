<template>
</template>

<script>
export default {

	created(){
        if(!User.loggedIn())
        {
            this.$router.push({ name: 'login' });
        }
        else{
            this.logout();
        }
	},
    mounted(){
        if(!User.loggedIn())
        {
            this.$router.push({ name: 'login' });
        }
        else{
            this.logout();
        }
	},
     methods: {
        async logout(){
            await axios.get('/sanctum/csrf-cookie')
            await axios.post('/logout').then(response => {

                User.logOut() 
                Toast.fire({
                        icon: 'success',
                        title: 'Logout successfully'
                });
                this.$router.push({ name: 'login' });
            })
           
            
        }
    },
    watch:
    {
        $route (to, from){
        }
    }
}
</script>

<style lang="css" scoped>
</style>
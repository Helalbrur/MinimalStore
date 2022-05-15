<template>
    <nav class="navbar navbar-expand navbar-light bg-navbar topbar mb-4 static-top" >
        <button id="sidebarToggleTop" class="btn btn-link rounded-circle mr-3">
            <i class="fa fa-bars"></i>
        </button>
        <ul class="navbar-nav ml-auto">

            <li class="nav-item dropdown no-arrow">
                <a class="nav-link dropdown-toggle" href="/" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                
                <!-- Authentication Links -->
                    <router-link v-if="!isLogedIn" class="ml-2 d-none d-lg-inline text-white small" to="/login">Login</router-link>
                    <span v-if="isLogedIn"  class="ml-2 d-none d-lg-inline text-white small" >{{username}}</span>
                    <router-link v-if="isLogedIn" class="ml-2 d-none d-lg-inline text-white small" to="/logout">Logout</router-link>
            </a>
            </li>
        </ul>
    </nav>
</template>

<script>
export default {
    data () {
		return {
			username: '',
			isLogedIn:false
		}
	}, 
    methods: {
    },
    created() {
        this.isLogedIn=User.loggedIn();
        this.username=User.getUserName();
    },
    mounted()
    {
        this.isLogedIn=User.loggedIn();
        this.username=User.getUserName();
    },
    watch:
    {
        $route (to, from){
            this.isLogedIn=User.loggedIn();
            this.username=User.getUserName();
        }
    }
}
</script>

<style>
</style>
<nav id="sidebar" v-show="$route.path === '/' || $route.path === '/register' || $route.path === 'forget' ? false : true " style="display: none;">
    <ul class="navbar-nav sidebar sidebar-light accordion" id="accordionSidebar">
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
            <div class="sidebar-brand-icon">
            <img src="{{ asset('backend/img/logo/logo2.png') }}">
            </div>
            <div class="sidebar-brand-text mx-3">IMS</div>
        </a>
        <hr class="sidebar-divider my-0">
        <li class="nav-item active">
            <router-link class="nav-link" to="/home">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></router-link>
            </li>
            <li class="nav-item">
            <router-link class="nav-link" to="/pos">
                <i class="fas fa-fw fa-table"></i>
                <span>POS</span></router-link>
            </li>
            <hr class="sidebar-divider">
            <div class="sidebar-heading">
                Features
            </div>
            
            <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseBootstrap1"
            aria-expanded="true" aria-controls="collapseBootstrap1">
            <i class="far fa-fw fa-window-maximize"></i>
            <span>Supplier</span>
            </a>
            <div id="collapseBootstrap1" class="collapse" aria-labelledby="headingBootstrap" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <router-link class="collapse-item" to="/store-supplier">Add Supplier</router-link>
                <router-link class="collapse-item" to="supplier">All Supplier</router-link>
            </div>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseBootstrap2" aria-expanded="true" aria-controls="collapseBootstrap2">
                <i class="far fa fa-list"></i>
                <span>Item</span>
            </a>
            <div id="collapseBootstrap2" class="collapse" aria-labelledby="headingBootstrap" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                <router-link class="collapse-item" to="/create-item">Add Item</router-link>
                <router-link class="collapse-item" :to="{name : 'item-list'}">Items List</router-link>
                </div>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseBootstrap3" aria-expanded="true" aria-controls="collapseBootstrap3">
                <i class="far fa fa-shopping-bag"></i>
                <span>Product</span>
            </a>
            <div id="collapseBootstrap3" class="collapse" aria-labelledby="headingBootstrap" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <router-link class="collapse-item" to="/store-product">Add Product</router-link>
                <router-link class="collapse-item" to="product">All Product</router-link>
            </div>
            </div>
        </li>
        <li class="nav-item">
            <router-link to="stock" class="nav-link" aria-expanded="true">
            <i class="far fa fa-credit-card"></i>
            <span>Stock</span>
            </router-link>
        </li>
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseBootstrap4" aria-expanded="true" aria-controls="collapseBootstrap4">
                <i class="far fa fa-book"></i>
                <span>Expense</span>
            </a>
            <div id="collapseBootstrap4" class="collapse" aria-labelledby="headingBootstrap" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                <router-link class="collapse-item" to="/store-expense">Add Expense</router-link>
                <router-link class="collapse-item" to="expense">All Expense</router-link>
                </div>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseBootstrapcustomer"
            aria-expanded="true" aria-controls="collapseBootstrapcustomer">
            <i class="far fa fa-user"></i>
            <span>Customer</span>
            </a>
            <div id="collapseBootstrapcustomer" class="collapse" aria-labelledby="headingBootstrap" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <router-link class="collapse-item" to="/store-customer">Add Customer</router-link>
                <router-link class="collapse-item" to="customer">All Customer</router-link>
            </div>
            </div>
        </li>
    </ul>
</nav>
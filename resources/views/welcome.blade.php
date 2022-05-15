<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link href="{{ asset('backend/img/logo/logo.png') }}" rel="icon">
  <title>Minimal Store</title>
   <!-- CSRF Token -->
   <meta name="csrf-token" content="{{ csrf_token() }}">

  <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css">

  <link href="{{ asset('backend/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
  <link href="{{ asset('backend/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
  <link href="{{ asset('backend/css/ruang-admin.min.css') }}" rel="stylesheet">
</head>

<body id="page-top">
  <div id="app">
        <div id="wrapper">

            <!-- Sidebar -->
            <nav id="sidebar" >
                <ul class="navbar-nav sidebar sidebar-light accordion" id="accordionSidebar">
                    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
                        <div class="sidebar-brand-icon">
                        <img src="{{ asset('backend/img/logo/logo2.png') }}">
                        </div>
                        <div class="sidebar-brand-text mx-3">Minimal Store</div>
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
                            <router-link class="collapse-item" :to="{name : 'supplier-create'}">Add Supplier</router-link>
                            <router-link class="collapse-item" :to="{name : 'supplier-list'}">All Supplier</router-link>
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
                            <router-link class="collapse-item" :to="{name : 'item-create'}">Add Item</router-link>
                            <router-link class="collapse-item" :to="{name : 'item-list'}">Items List</router-link>
                            </div>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseBootstrap3" aria-expanded="true" aria-controls="collapseBootstrap3">
                            <i class="far fa fa-shopping-bag"></i>
                            <span>Receive</span>
                        </a>
                        <div id="collapseBootstrap3" class="collapse" aria-labelledby="headingBootstrap" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <router-link class="collapse-item" :to="{name : 'receive-create'}">Create</router-link>
                            <router-link class="collapse-item" :to="{name : 'receive-list'}">All Receive</router-link>
                        </div>
                        </div>
                    </li>
                    <li class="nav-item">
                        <router-link :to="{name : 'stock'}" class="nav-link" aria-expanded="true">
                            <i class="far fa fa-credit-card"></i>
                            <span>Stock</span>
                        </router-link>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseBootstrap4" aria-expanded="true" aria-controls="collapseBootstrap4">
                            <i class="far fa fa-book"></i>
                            <span>Requisition</span>
                        </a>
                        <div id="collapseBootstrap4" class="collapse" aria-labelledby="headingBootstrap" data-parent="#accordionSidebar">
                            <div class="bg-white py-2 collapse-inner rounded">
                            <router-link class="collapse-item" :to="{name : 'requisition-create'}">Create Requisition</router-link>
                            <router-link class="collapse-item" :to="{name : 'requisition-list'}">All Requisition</router-link>
                            </div>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseBootstrap5" aria-expanded="true" aria-controls="collapseBootstrap4">
                            <i class="far fa fa-book"></i>
                            <span>Issue</span>
                        </a>
                        <div id="collapseBootstrap5" class="collapse" aria-labelledby="headingBootstrap" data-parent="#accordionSidebar">
                            <div class="bg-white py-2 collapse-inner rounded">
                            <router-link class="collapse-item" :to="{name : 'issue-create'}">Create Issue</router-link>
                            <router-link class="collapse-item" :to="{name : 'issue-list'}">All Issue</router-link>
                            </div>
                        </div>
                    </li>
                </ul>
            </nav>

            <!-- Sidebar -->
        
            <div id="content-wrapper" class="d-flex flex-column">
                <div id="content">
                    <!-- TopBar -->
                    <navbar class="mb-3"></navbar>
                    <!-- Topbar -->

                    <!-- Container Fluid-->
                    <div class="container-fluid" id="container-wrapper">
                        <router-view></router-view>
                    </div>
                    <!---Container Fluid-->

                </div>
            </div>
        </div>
    </div>

<!-- Scroll to top -->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<script src="{{ asset('js/app.js') }}"></script>
<script src="{{ asset('backend/vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('backend/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

<script>
  let token = localStorage.getItem('token')
  if (token) {
    $('#sidebar').css('display', '')
    $('#topbar').css('display', '')
  }
</script>
<script src="{{ asset('backend/js/ruang-admin.js') }}"></script>
</body>

</html>
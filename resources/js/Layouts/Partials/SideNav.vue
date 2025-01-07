
<template>
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="index3.html" class="brand-link">
            <img src="~admin-lte/dist/img/AdminLTELogo.png" alt="AdminLTE Logo"
                class="brand-image img-circle elevation-3" style="opacity: .8">
            <span class="brand-text font-weight-light">Afrique Shop</span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar user panel (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    <img src="~admin-lte/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
                </div>
                <div class="info">
                    <Link href="#" class="d-block" v-if="$page.props.auth.user"> 
    {{ $page.props.auth.user.name }} 
</Link>

                </div>
            </div>

 

            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                    data-accordion="false">
  
                    <li class="nav-item">
                        <Link :href="route('home')" class="nav-link" :class="{'active' :$page.component === 'home'}">
                            <i class="nav-icon fas fa-th"></i>
                            <p> 
                                Home
                            </p>
                        </Link>
                    </li>
                    
                    <li class="nav-item">
                        <Link :href="route('product.index')" class="nav-link" :class="{'active' :$page.component === 'product'}">
                            <i class="nav-icon fas fa-th"></i>
                            <p>All Products</p>
                        </Link>
                    </li>
 
                    <li class="nav-item">
                        <Link :href="route('product.create')" class="nav-link" :class="{'active' :$page.component === 'product/create'}">
                            <i class="nav-icon fas fa-th"></i>
                            <p>Add Products</p>
                        </Link>
                    </li>
                    <li class="nav-item">
                        <Link :href="route('forecast.product')" class="nav-link" :class="{'active' :$page.component === 'forecast/product'}">
                            <i class="nav-icon fas fa-th"></i>
                            <p>Forecast </p>
                        </Link>
                    </li>

                     

                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>
</template>

<script setup>
    import { Link } from '@inertiajs/vue3'
</script>

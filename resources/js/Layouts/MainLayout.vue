<template>
    
    <div class="wrapper">

        <!-- Navbar -->
        <UpperNav />
        <!-- /.navbar -->
        <SideNav />
        <!-- Main Sidebar Container -->
        

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- <img
            id="background"
            class="absolute -left-20 top-0 max-w-[600px]"
            src="https://laravel.com/assets/img/welcome/background.svg"
        /> -->
            <slot />
        </div>
        <!-- /.content-wrapper -->

        
        <Footer/>


    </div>
</template>
<script setup>
    import Footer from './Partials/Footer.vue'
    import UpperNav from './Partials/UpperNav.vue'
    import SideNav from './Partials/SideNav.vue'

</script>

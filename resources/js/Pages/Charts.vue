<script setup>
import { defineProps } from 'vue';

const props = defineProps({
    count: {
        type: Number,
    },
    totalQuantitySold: {
        type: Number,
    },
    totalStock: {
        type: Number,
    },
    bestSellingCategory:{
        type: String,
    },
    bestSellingProduct:{
        type: String,
    },
    topSoldProducts:{
        type: Array,
    },
    topSoldBrand:{
        type: Array,
    }
});
</script>
<style>
@import '/resources/assets/css/icons.css';
@import '/resources/assets/plugins/simplebar/css/simplebar.css';
@import '/resources/assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css';
@import '/resources/assets/plugins/metismenu/css/metisMenu.min.css';
@import '/resources/assets/css/bootstrap.min.css';
@import '/resources/assets/css/bootstrap-extended.css';
@import '/resources/assets/css/style.css';
@import '/resources/assets/css/icons.css';
@import 'https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap';
@import '/resources/assets/css/dark-theme.css';
@import '/resources/assets/css/light-theme.css';
@import '/resources/assets/css/semi-dark.css';
@import '/resources/assets/css/header-colors.css';
@import 'https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css';
</style>


<template>
    <div class="m-5">
        <h6 class="mb-0 text-uppercase">Overview</h6>
        <hr>
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-xl-4 row-cols-xxl-4">
            <div class="col">
                <div class="card radius-10 border-0 border-start border-tiffany border-3">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="">
                                <p class="mb-1">Total Orders</p>
                                <h4 class="mb-0 text-tiffany">{{ props.count }}</h4>
                            </div>
                            <div class="ms-auto widget-icon bg-tiffany text-white">
                                <i class="bi bi-bag-check-fill"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card radius-10 border-0 border-start border-success border-3">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="">
                                <p class="mb-1">Total Quantity</p>
                                <h4 class="mb-0 text-success">{{ props.totalQuantitySold }}</h4>
                            </div>
                            <div class="ms-auto widget-icon bg-success text-white">
                                <i class="fadeIn animated bx bx-credit-card-front"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card radius-10 border-0 border-start border-pink border-3">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="">
                                <p class="mb-1">Best Selling Product</p>
                                <h5 class="mb-0 text-pink">{{props.bestSellingProduct}}</h5>
                            </div>
                            <div class="ms-auto widget-icon bg-pink text-white">
                                <i class="bi bi-bar-chart-fill"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card radius-10 border-0 border-start border-orange border-3">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="">
                                <p class="mb-1">Best Selling Category</p>
                                <h6 class="mb-0 text-orange">{{ props.bestSellingCategory }}</h6>
                            </div>
                            <div class="ms-auto widget-icon bg-orange text-white">
                                <i class="fadeIn animated bx bx-cart-alt"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div><!--end row-->
        <div class="row">
            <div class="col-12 col-lg-6 d-flex">
                <div class="card rounded-4 w-100">
                    <div class="card-header bg-transparent border-0">
                        <div class="row g-3 align-items-center">
                            <div class="col">
                                <h6 class="mb-0">Products - Top Sold - All Time</h6>
                            </div>
                            <div class="col">
                                <div class="d-flex align-items-center justify-content-end gap-3 cursor-pointer">
                                    <div class="dropdown">
                                        <a class="dropdown-toggle dropdown-toggle-nocaret" href="#"
                                            data-bs-toggle="dropdown" aria-expanded="false"><i
                                                class="bx bx-dots-horizontal-rounded font-22 text-option"></i>
                                        </a>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item" href="javascript:;">Action</a>
                                            </li>
                                            <li><a class="dropdown-item" href="javascript:;">Another action</a>
                                            </li>
                                            <li>
                                                <hr class="dropdown-divider">
                                            </li>
                                            <li><a class="dropdown-item" href="javascript:;">Something else here</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="best-product p-2 mb-3">
                            <div v-for="(product, index) in props.topSoldProducts" :key="index" class="best-product-item">
                                <div class="d-flex align-items-center gap-3">
                                    <div class="product-box border">
                                        <img :src="`assets/images/products/${product.id_produit}.png`" alt="">
                                    </div>
                                    <div class="product-info flex-grow-1">
                                        <div class="progress-wrapper">
                                            <div class="progress" style="height: 5px;">
                                                <div class="progress-bar bg-purple" :style="{ width: `${(product.total_sales / 500) * 100}%` }" role="progressbar"></div>
                                            </div>
                                        </div>
                                        <p class="product-name mb-0 mt-2 fs-6">
                                            {{ product.id_produit }} <span class="float-end">{{ product.total_sales }}</span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-6 d-flex">
                <div class="card rounded-4 w-100">
                    <div class="card-header bg-transparent border-0">
                        <div class="row g-3 align-items-center">
                            <div class="col">
                                <h6 class="mb-0">Brand - Top Sold - All Time</h6>
                            </div>
                            <div class="col">
                                <div class="d-flex align-items-center justify-content-end gap-3 cursor-pointer">
                                    <div class="dropdown">
                                        <a class="dropdown-toggle dropdown-toggle-nocaret" href="#"
                                            data-bs-toggle="dropdown" aria-expanded="false"><i
                                                class="bx bx-dots-horizontal-rounded font-22 text-option"></i>
                                        </a>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item" href="javascript:;">Action</a>
                                            </li>
                                            <li><a class="dropdown-item" href="javascript:;">Another action</a>
                                            </li>
                                            <li>
                                                <hr class="dropdown-divider">
                                            </li>
                                            <li><a class="dropdown-item" href="javascript:;">Something else here</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="best-product p-2 mb-3">
                            <div v-for="(product, index) in props.topSoldBrand" :key="index" class="best-product-item">
                                <div class="d-flex align-items-center gap-3">
                                    <div class="product-box border">
                                        <img :src="`assets/images/products/${product.id_produit}.png`" alt="">
                                    </div>
                                    <div class="product-info flex-grow-1">
                                        <div class="progress-wrapper">
                                            <div class="progress" style="height: 5px;">
                                                <div class="progress-bar bg-primary" :style="{ width: `${(product.total_sales / 5000) * 100}%` }" role="progressbar"></div>
                                            </div>
                                        </div>
                                        <p class="product-name mb-0 mt-2 fs-6">
                                            {{ product.marque }} <span class="float-end">{{ product.total_sales }}</span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div><!--end row-->
    </div>
</template>

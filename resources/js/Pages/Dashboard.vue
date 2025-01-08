<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import Charts from '@/Pages/Charts.vue';

const props = defineProps({
  productCount: Number,
  totalQuantitySold: Number,
  totalStock: Number,
  bestSellingCategory: String,
  bestSellingProduct: String,
  topSoldProducts: Array,
  topSoldBrand: Array,
});
</script>

<template>
  <Head title="Dashboard" />

  <AuthenticatedLayout>
    <template #header>
      <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-black-200">
        Dashboard
      </h2>
    </template>

    <div class="py-12">
      <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg dark:bg-gray-800">
          <!-- Pass productCount as a prop to the Charts component -->
          <Charts 
            :count="productCount"
            :total-quantity-sold="totalQuantitySold"
            :total-stock="totalStock" 
            :bestSellingCategory="bestSellingCategory"  
            :bestSellingProduct="bestSellingProduct"
            :topSoldProducts="topSoldProducts"
            :topSoldProducts_30="topSoldProducts_30"
            :topSoldBrand="topSoldBrand"
          />
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>

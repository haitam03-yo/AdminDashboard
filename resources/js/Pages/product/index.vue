<template>
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"> Index Products </h1>
                </div>
            </div>
        </div>
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title"></h3>
                            <div class="card-tools">
                                <Pagination 
                                :links="props.products.links" 
                                :prev="props.products.prev_page_url"
                                :next="props.products.next_page_url" />
                            </div>
                        </div>

                        <div class="card-body p-0">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Categorie</th>
                                        <th>Marque</th>
                                        <th>Prix Unitaire</th>
                                        <th>Promotion</th>
                                        <th>Stock Disponible</th>
                                        <th style="width: 100px">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="product in props.products.data" :key="product.id">
                                        <td>{{ product.categorie }}</td>
                                        <td>{{ product.marque }}</td>
                                        <td>{{ product.prix_unitaire.toFixed(2) }} €</td>
                                        <td>{{ product.promotion ? 'Yes' : 'No' }}</td>
                                        <td>{{ product.stock_disponible }}</td>
                                        <td>
                                            <div class="d-flex justify-items-center">
                                                <button class="btn btn-info mr-2"><i class="fas fa-pen"></i></button>
                                                <button class="btn btn-danger"><i class="fas fa-trash"></i></button>
                                            </div>
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
</template>

<script setup>
  import Pagination from '../../Shared/Pagination.vue';
  const props = defineProps({
    products: {
        type: Object,
        required: true
    }
  })
</script>

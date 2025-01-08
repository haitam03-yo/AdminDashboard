<template>
    <div>
      <h1>Product List</h1>
      <ul>
        <li v-for="product in products" :key="product.id">
          {{ product.name }} - ${{ product.price }}
        </li>
      </ul>
      <form @submit.prevent="addProduct">
        <input v-model="newProduct.name" placeholder="Product Name" required />
        <input v-model.number="newProduct.price" placeholder="Price" required type="number" />
        <button type="submit">Add Product</button>
      </form>
    </div>
  </template>
  
  <script>
  import axios from 'axios';
  
  export default {
    data() {
      return {
        products: [],
        newProduct: { name: '', price: '' },
      };
    },
    mounted() {
      this.fetchProducts();
    },
    methods: {
      fetchProducts() {
        axios.get('/products')
          .then(response => {
            this.products = response.data;
          });
      },
      addProduct() {
        axios.post('/products', this.newProduct)
          .then(response => {
            this.products.push(response.data);
            this.newProduct = { name: '', price: '' }; // Clear the form
          });
      },
    },
  };
  </script>
  
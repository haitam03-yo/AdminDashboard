<template>
    <button class="btn btn-primary" data-toggle="modal" data-target="#createProductModal">
      <i class="fa fa-plus"></i> Nouveau Produit
    </button>
  
    <div
      class="modal fade"
      id="createProductModal"
      data-backdrop="static"
      data-keyboard="false"
      tabindex="-1"
      aria-labelledby="staticBackdropLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="staticBackdropLabel">Ajout d'un produit</h5>
            <button type="button" @click="closeModal" class="close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form @submit.prevent="soumettre" id="createForm">
              <div class="form-group">
                <label for="categorie">Catégorie</label>
                <input
                  type="text"
                  required
                  class="form-control"
                  v-model="categorie"
                  id="categorie"
                />
              </div>
              <!-- Add more fields for product creation as needed -->
              <!-- Example: -->
              <!--
              <div class="form-group">
                <label for="price">Prix</label>
                <input
                  type="number"
                  required
                  class="form-control"
                  v-model="price"
                  id="price"
                />
              </div>
              -->
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" @click="closeModal">Fermer</button>
            <button form="createForm" type="submit" class="btn btn-success">
              Soumettre
            </button>
          </div>
        </div>
      </div>
    </div>
  </template>
  
  <script setup>
  import { ref, onMounted } from "vue";
  import { Inertia } from "@inertiajs/inertia";
  import { useSwalSuccess, useSwalError } from '@/Composables/alert';  
  const categorie = ref("");
  let createModal = "";
  
  onMounted(() => {
    createModal = $("#createProductModal");
  });
  
  const closeModal = () => {
    createModal.modal("hide");
    categorie.value = "";
  };
  
  const soumettre = () => {
    const url = route("products.store"); // Update the route name to match your backend route
    Inertia.post(
      url,
      { categorie: categorie.value }, // Add other fields as needed
      {
        onSuccess: (page) => {
          closeModal();
          useSwalSuccess("Produit ajouté avec succès!");
        },
        onError: (errors) => {
          useSwalError("Une erreur s'est produite");
        },
      }
    );
  };
  </script>
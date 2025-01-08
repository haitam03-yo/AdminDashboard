<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('data', function (Blueprint $table) {
            $table->id(); // Add an auto-incrementing 'id' column (primary key)
            $table->string('id_produit');// Define 'id_produit' as primary key
            $table->date('date'); // 'date' column for product date
            $table->string('categorie'); // 'categorie' column (string type)
            $table->string('marque'); // 'marque' column (string type)
            $table->decimal('prix_unitaire', 8, 2); // 'prix_unitaire' column (decimal for price)
            $table->boolean('promotion')->default(false); // 'promotion' column (boolean for promotion status)
            $table->boolean('jour_ferie')->default(false); // 'jour_ferie' column (boolean for holiday status)
            $table->boolean('weekend')->default(false); // 'weekend' column (boolean for weekend status)
            $table->integer('stock_disponible')->default(0); // 'stock_disponible' column (integer for stock available)
            $table->string('condition_meteo'); // 'condition_meteo' column (string for weather condition)
            $table->string('region'); // 'region' column (string for the region)
            $table->string('moment_journee'); // 'moment_journee' column (string for time of day)
            $table->integer('quantite_vendue')->default(0); // 'quantite_vendue' column (integer for sold quantity)
            $table->timestamps(); // Add created_at and updated_at columns (optional)
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data'); // Drop the 'data' table if the migration is rolled back
    }
};

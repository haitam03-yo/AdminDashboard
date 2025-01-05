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
        Schema::create('products', function (Blueprint $table) {
            $table->string('id')->primary(); // Define 'id' as a string and make it the primary key
            $table->string('categorie'); // Categorie column
            $table->string('marque'); // Marque column
            $table->decimal('prix_unitaire', 8, 2); // Prix unitaire column (decimal for price)
            $table->boolean('promotion')->default(false); // Promotion column (boolean to indicate if it's on promotion)
            $table->integer('stock_disponible')->default(0); // Stock disponible column (integer, default 0)
            $table->timestamps();
        });
    }
    
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prodcuts');
    }
};

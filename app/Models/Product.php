<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;
    
    protected $fillable = ['id', 'categorie', 'marque', 'prix_unitaire', 'promotion', 'stock_disponible'];

    // Define the primary key type as a string
    protected $keyType = 'string';

    // Disable auto-incrementing since 'id' is not an integer
    public $incrementing = false;

    // If needed, you can also specify the primary key (though 'id' is default)
    protected $primaryKey = 'id';
}


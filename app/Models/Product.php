<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['id', 'categorie', 'marque', 'prix_unitaire', 'stock_disponible'];
}

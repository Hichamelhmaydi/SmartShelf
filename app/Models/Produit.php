<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Produit extends Model
{
    protected $fillable = ['rayon_id', 'nom', 'prix', 'quantite', 'status', 'prix_promotion'];
}

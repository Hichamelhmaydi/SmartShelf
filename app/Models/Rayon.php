<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rayon extends Model
{
    protected $fillable = ['nombre', 'description', 'categorie_id'];
    public function produits(){
        return $this->hasMany(Produit::class);
    }
}

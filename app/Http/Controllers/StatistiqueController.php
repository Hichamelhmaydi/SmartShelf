<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Statistique;
use App\Models\Categorie;
use App\Models\Rayon;
use App\Models\Produit;
use App\Models\User;

class StatistiqueController extends Controller
{
    public function index()
    {
        $categories = Categorie::count();
        $rayons = Rayon::count();
        $produits = Produit::count();
        $users = User::count();
        $promotion = Produit::where('status', 'en promotion')->count();
        $statistiques = [
            'categories' => $categories,
            'rayons' => $rayons,
            'produits' => $produits,
            'users' => $users,
            'produits en promotion' => $promotion
        ];
        return response()->json($statistiques);
    }
}

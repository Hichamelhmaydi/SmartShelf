<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rayon;

class RayonController extends Controller
{
    public function index () {
        $rayons = Rayon::all();
        return response()->json($rayons, 200);
    }
    public function store (Request $request) {
        $validateData = $request->validate([
            'nombre' => 'required',
            'description' => 'required',
            'categorie_id' => 'required'
        ]);
        $rayon = Rayon::create($validateData);
        return response()->json([
            'message' => 'Rayon created',
            'rayon' => $rayon
        ], 201);
    }
    public function update (Request $request, $id) {
        $rayon = Rayon::find($id);
        if ($rayon) {
            $validateData = $request->validate([
                'nombre' => 'required',
                'description' => 'required',
                'categorie_id' => 'required'
            ]);
            $rayon->nombre = $validateData['nombre'];
            $rayon->description = $validateData['description'];
            $rayon->categorie_id = $validateData['categorie_id'];
            $rayon->save();
            return response()->json([
                'message' => 'Rayon updated',
                'rayon' => $rayon
            ], 200);
        } else {
            return response()->json([
                'message' => 'Rayon not found'
            ], 404);
        }
    }
    public function destroy ($id) {
        $rayon = Rayon::find($id);
        if ($rayon) {
            $rayon->delete();
            return response()->json([
                'message' => 'Rayon deleted'
            ], 200);
        } else {
            return response()->json([
                'message' => 'Rayon not found'
            ], 404);
        }
    }
    public function Produits($id)
    {
        $rayon = Rayon::with('produits')->find($id); 
    
        if (!$rayon) {
            return response()->json([
                'message' => 'Rayon not found'
            ], 404);
        }
    
        return response()->json([
            'rayon' => $rayon->description, 
            'produits' => $rayon->produits
        ], 200);
    }
}
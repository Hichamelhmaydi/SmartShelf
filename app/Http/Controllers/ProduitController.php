<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produit;

class ProduitController extends Controller
{
    public function index(){
        return response()->json(Produit::all(), 200);
    }
    public function store(Request $request){
        $validateData = $request->validate([
            'rayon_id' => 'required',
            'nom' => 'required',
            'prix' => 'required',
            'quantite' => 'required',
            'status' => 'required',
            'prix_promotion' => ['sometimes', 'required_if:status,en promotion'],
        ]);
        if ($request->status !== 'en promotion') {
            $validateData['prix_promotion'] = $validateData['prix'];
        }
        $produit = Produit::create($validateData);
        return response()->json([
            "message" => "Produit created",
            "produit" => $produit
        ], 201);
    }
    public function update(Request $request, $id){
        $produit = Produit::find($id);
        if($produit){
            $validateData = $request->validate([
                'rayon_id' => 'required',
                'nom' => 'required',
                'prix' => 'required',
                'quantite' => 'required',
                'status' => 'required',
                'prix_promotion' => 'required'
            ]);
            $produit->rayon_id = $validateData['rayon_id'];
            $produit->nom = $validateData['nom'];
            $produit->prix = $validateData['prix'];
            $produit->quantite = $validateData['quantite'];
            $produit->status = $validateData['status'];
            $produit->prix_promotion = $validateData['prix_promotion'];
            if($validateData['prix_promotion']>=$validateData['prix']){
                return response()->json(["message" => "Prix promotion doit être inférieur au prix"], 400);
            }
            else{   
                $produit->save();
            }
            return response()->json([
                "message" => "Produit updated",
                "produit" => $produit
            ], 200);
        }else{
            return response()->json(["message" => "Produit not found"], 404);
        }
    }
    public function destroy($id){
        $produit = Produit::find($id);
        if($produit){
            $produit->delete();
            return response()->json(["message" => "Produit deleted"], 200);
        }else{
            return response()->json(["message" => "Produit not found"], 404);
        }
    }
    public function list(){
        $produit = Produit::where('status','en promotion')->get();
        if($produit){
            return response()->json($produit, 200);
        }else{
            return response()->json(["message" => "Produit not found"], 404);
        }
    }
}

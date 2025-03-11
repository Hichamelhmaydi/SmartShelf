<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categorie;
use Illuminate\Support\Facades\Route;

class CategorieController extends Controller
{
    public function index()
    {
        return response()->json(Categorie::all(), 200);
    }
    public function store(Request $request)
    {
       $validateData = $request->validate(['name' => 'required']);
         $categorie = Categorie::create($validateData);
        return response()->json([
        "message" => "Categorie created",
        "categorie" => $categorie]
        , 201);
    }
    public function update(Request $request, $id)
    {
        $categorie = Categorie::find($id);
        if($categorie){
            $validateData = $request->validate(['name' => 'required']);
            $categorie->name = $validateData['name'];
            $categorie->save();
            return response()->json([
                "message" => "Categorie updated",
                "categorie" => $categorie
            ], 200);
        }else{
            return response()->json(["message" => "Categorie not found"], 404);
        }
    }
    public function destroy($id)
    {
        $categorie = Categorie::find($id);
        if($categorie){
            $categorie->delete();
            return response()->json(["message" => "Categorie deleted"], 200);
        }else{
            return response()->json(["message" => "Categorie not found"], 404);
        }
    }
}

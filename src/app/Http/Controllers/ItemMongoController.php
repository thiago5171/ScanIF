<?php

namespace App\Http\Controllers;
use App\Models\ItemMongo;
use Illuminate\Http\Request;

class ItemMongoController extends Controller
{
    public  function getItemByIdentifier($tombamento)
    {
    return ItemMongo::where('tombamento','=',$tombamento)->first();
    }
    public function getAllItems()
    {
        return ItemMongo::all();
    }
    public function store(Request $request){
       $item = new ItemMongo();

        $item->tombamento = $request->tombamento;
        $item->denominacao = $request->denominacao;
        $item->termo = $request->termo;
        $item->valor = $request->valor;
        $item->tomb_antigo = $request->tomb_antigo;
        $item->estado = $request->estado;
        $item->situacao = $request->situacao;
        $item->n_serie = $request->n_serie;
        $item->observacao = $request->observacao;
        $item->status_id = $request->status_id;
        $item->save();
        return response()->json([$item], 201);

    }
}

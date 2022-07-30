<?php

namespace App\Http\Controllers;
use App\Models\Item;
use App\Models\ItemMongo;
use Illuminate\Http\Request;
    use function PHPUnit\Framework\assertNotEmpty;
use function PHPUnit\Framework\returnValue;

class ItemMongoController extends Controller
{
    public  function getItemByIdentifier($tombamento)
    {
        $item = ItemMongo::where('tombamento','=',$tombamento)->first();
       if($item == null){
           return response()->json(["message" => "Item não encontrado ou já registrado"], 400);

       } else{
           return $item;
       }

    }



    public  function getItemByIdentifierInternalUse($tombamento)
    {
       return ItemMongo::where('tombamento', '=', $tombamento)->first();
    }



    public function store(Request $request){
       $item = new ItemMongo();

        $item->tombamento = $request->tombamento;
        $item->denominacao = $request->denominacao;
        $item->termo = $request->termo;
        $item->valor = $request->valor;
        $item->tomb_antigo = $request->tomb_antigo;
        $item->estado = $request->estado;
        $item->localidade = $request->localidade;
        $item->situacao = $request->situacao;
        $item->n_serie = $request->n_serie;
        $item->observacao = $request->observacao;
        $item->status_id = $request->status_id;
        $item->save();
        return response()->json([$item], 201);

    }
}

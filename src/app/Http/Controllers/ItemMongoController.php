<?php

namespace App\Http\Controllers;
use App\Models\ItemMongo;
use Illuminate\Http\Request;
use function MongoDB\BSON\fromJSON;
use function MongoDB\BSON\toJSON;

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

    public function getList()
    {
        return ItemMongo::all();
    }

    public function indexingReport(Request $request){
        $item=  json_decode($request->getContent());
        $itemObject =new ItemMongo();
              foreach ($item  as $value){
            $itemObject->tombamento = $value->tombamento;
            $itemObject->denominacao = $value->denominacao;
            $itemObject->termo = $value->termo;
            $itemObject->valor = $value->valor;
            $itemObject->tomb_antigo = $value->tomb_antigo;
            $itemObject->estado = $value->estado;
            $itemObject->localidade = $value->localidade;
            $itemObject->situacao = $value->situacao;
            $itemObject->n_serie = $value->n_serie;
            $itemObject->observacao = $value->observacao;
            $itemObject->save();

            $itemObject =new ItemMongo();

        }

        return response()->json(["message" => "Items cadastrados"], 201);

}


    public  function clearDatabase()
    {
        if (ItemMongo::truncate()) {
         return response()->json(["message" => "Items excluidos com sucesso"], 204);
        }else{
            return response()->json(["message" => "Erros ao excluir items"], 500);

        }
    }


}

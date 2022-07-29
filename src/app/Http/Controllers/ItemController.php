<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Item;
use App\Models\StatusItem;
use Illuminate\Support\Facades\DB;


/**
 * Description of ItemController
 *
 * @author Tuhin Bepari <digitaldreams40@gmail.com>
 */

class ItemController extends Controller
{
    public function getAll()
    {
        return DB::table('items')
            ->join('status_items','items.status_id','=','status_items.id')
            ->select('items.*','status_items.*')->get();
    }


    public function getById($id)
    {
        return Item::where("id", "=", $id)->first();
    }

    public function create(Request $request)
    {
        $item = new Item();
        $item->denominacao = $request->denominacao;
        $item->termo = $request->termo;
        $item->valor = $request->valor;
        $item->tomb_antigo = $request->tomb_antigo;
        $item->estado = $request->estado;
        $item->situacao = $request->situacao;
        $item->n_serie = $request->n_serie;
        $item->observacao = $request->observacao;
        $item->status_id = $request->status_id;



        if ($item->save()) {
            return response()->json([$item], 201);
        }
        return response()->json(["message"=>"Erro ao criar status"], 500);
        ;

    }
    public function analyzeItemStatus(Request $request){
        $item = new Item();
$mongoGontroller = new ItemMongoController();
        $itemFromMongo =  $mongoGontroller->getItemByIdentifier($request->tombamento);

if($itemFromMongo){
    $item->tombamento = $request->tombamento;
    $item->situacao = $request->situacao;
    $item->tomb_antigo = $request->tomb_antigo;
    $item->estado = $request->estado;

    $item->denominacao = $itemFromMongo->denominacao;
    $item->termo = $itemFromMongo->termo;
    $item->valor = $itemFromMongo->valor;
    $item->n_serie = $itemFromMongo->n_serie;
    $item->observacao = $itemFromMongo->observacao;
    $item->status_id = 1;
    if($item->save()){
        $itemFromMongo->delete();
    }else{
        return response()->json(["result" => "bad request"], 400);

    }

    return response()->json(["result" => "ok"], 200);
}



    }
//
//    public function update(Request $request, $id)
//    {
//        $status = StatusItems::find($id);
//        $status->sigla = $request->sigla;
//        $status->nome = $request->nome;
//
//        if ($status->save()) {
//            return response()->json([], 204);
//        }
//        return response()->json(["message"=>"Erro ao editar status"], 500);
//
//
//    }
//
//    public function destroy(Request $request, $id)
//    {
//        $status = StatusItems::find($id);
//
//        if ($status->delete()) {
//            return response()->json([], 204);
//
//        }
//
//        return response()->json(["message"=>"Erro ao deletar status"], 500);
//
//
//    }
}

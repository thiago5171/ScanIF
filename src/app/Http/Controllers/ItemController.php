<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Item;
use App\Models\StatusItem;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Stmt\Return_;


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
            ->join('status_items', 'items.status_id', '=', 'status_items.id')
            ->select('items.*', 'status_items.*')->get();
    }


    public function getById($id)
    {
        return Item::where("id", "=", $id)->first();
    }

    public function create(Request $request)
    {
        if ($request->status_id == 4){
            $mongoGontroller = new ItemMongoController();
            return $mongoGontroller->store($request);
        }
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
        $item->tombamento = $request->tombamento;
        $item->localidade = $request->localidade;


        if ($item->save()) {
            return response()->json(["message" => "Item registrado"], 201);
        }
        return response()->json(["message" => "Erro ao criar status"], 400);;

    }



    public function analyzeItemWithRegister(Request $request)
    {
        $item = new Item();

        $mongoGontroller = new ItemMongoController();
        $itemFromMongo = $mongoGontroller->getItemByIdentifierInternalUse($request->tombamento);
        $item->tombamento = $request->tombamento;
        $item->situacao = $request->situacao;
        $item->tomb_antigo = $request->tomb_antigo;
        $item->estado = $request->estado;
        $item->localidade = $itemFromMongo->localidade;

        if ($itemFromMongo != null) {
            $item->denominacao = $itemFromMongo->denominacao;
            $item->termo = $itemFromMongo->termo;
            $item->valor = $itemFromMongo->valor;
            $item->n_serie = $itemFromMongo->n_serie;
            $item->observacao = $itemFromMongo->observacao;
            $item->status_id = 1;

            if ($item->save()) {
                $itemFromMongo->delete();
                return response()->json(["message" => "Item registrado"], 201);
            }

        }else{
            return response()->json(["message" => "Item não encontrado insira o restante dos dados para cadastrar o item"], 400);
        }
    }


    public function getByStatusId($id)
    {
        return Item::where("status_id", "=", $id);
    }


}

<?php

namespace App\Http\Controllers;

use App\Models\StatusItems;
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



        if ($item->save()) {
            return response()->json([$item], 201);
        }
        return response()->json(["message"=>"Erro ao criar status"], 500);
        ;

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

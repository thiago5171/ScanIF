<?php

namespace App\Http\Controllers;

use App\Transformers\StatusItemsTransformer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\StatusItems;


/**
 * Description of StatusItemsController
 *
 * @author Tuhin Bepari <digitaldreams40@gmail.com>
 */
class StatusItemsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function getAll()
    {
        return StatusItems::all();
    }

    public function getById($id)
    {
        return StatusItems::where("id", "=", $id)->first();
    }

    public function create(Request $request)
    {
        $status = new StatusItems();
        $status->sigla = $request->sigla;
        $status->nome = $request->nome;

        if ($status->save()) {
            return response()->json([$status], 201);
        }
        return response()->json(["message"=>"Erro ao criar status"], 500);
        ;

    }

    public function update(Request $request, $id)
    {
        $status = StatusItems::find($id);
        $status->sigla = $request->sigla;
        $status->nome = $request->nome;

        if ($status->save()) {
            return response()->json([], 204);
        }
        return response()->json(["message"=>"Erro ao editar status"], 500);


    }

    public function destroy(Request $request, $id)
    {
        $status = StatusItems::find($id);

        if ($status->delete()) {
            return response()->json([], 204);

        }

        return response()->json(["message"=>"Erro ao deletar status"], 500);


    }
}

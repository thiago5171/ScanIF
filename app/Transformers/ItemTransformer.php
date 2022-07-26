<?php
namespace App\Transformers;

use LaraCrud\Helpers\TransformerAbstract;
use League\Fractal\ParamBag;
use App\Models\Item;



class ItemTransformer extends TransformerAbstract
{
     /**
     * @var array
     */
    private $validParams = ['q', 'limit', 'page','fields'];

    /**
     * @var array
     */
    protected $availableIncludes = [];

     /**
      * @var array
      */
    protected $defaultIncludes = [];


    public function transform(Item $item)
    {
        $data= [
			"id" => $item->id,
			"tombamento" => $item->tombamento,
			"denominacao" => $item->denominacao,
			"termo" => $item->termo,
			"valor" => $item->valor,
			"tomb_antigo" => $item->tomb_antigo,
			"estado" => $item->estado,
			"situacao" => $item->situacao,
			"n_serie" => $item->n_serie,
			"obsercao" => $item->obsercao,
			"status_id" => $item->status_id,

        ];
        return $this->filterFields($data);

    }

    
}
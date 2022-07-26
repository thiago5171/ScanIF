<?php
namespace App\Transformers;

use LaraCrud\Helpers\TransformerAbstract;
use League\Fractal\ParamBag;
use App\Models\StatusItems;



class StatusItemsTransformer extends TransformerAbstract
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


    public function transform(StatusItems $statusItems)
    {
        $data= [
			"id" => $statusItems->id,
			"nome" => $statusItems->nome,
			"sigla" => $statusItems->sigla,

        ];
        return $this->filterFields($data);

    }

    
}
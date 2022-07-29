<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
/**
@property varchar $tombamento tombamento
@property varchar $denominacao denominacao
@property varchar $termo termo
@property double $valor valor
@property varchar $tomb_antigo tomb antigo
@property varchar $estado estado
@property varchar $situacao situacao
@property varchar $n_serie n serie
@property varchar $observacao observacao
@property varchar $localidade localidade
@property timestamp $created_at created at
@property timestamp $updated_at updated at
@property bigint $status_id status id

 */
class Item extends Model
{

    /**
     * Database table name
     */
    protected $table = 'items';

    /**
     * Mass assignable columns
     */
    protected $fillable=['status_id',
        'tombamento',
        'denominacao',
        'termo',
        'valor',
        'tomb_antigo',
        'estado',
        'situacao',
        'n_serie',
        'observacao',
        'localidade',
        'status_id'];

    /**
     * Date time columns.
     */
    protected $dates=[];




}

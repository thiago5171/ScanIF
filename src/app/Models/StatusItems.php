<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
/**
@property varchar $nome nome
@property varchar $sigla sigla
@property \Illuminate\Database\Eloquent\Collection $item hasMany

 */
class StatusItems extends Model
{

    use HasFactory;
    protected $fillable=['nome','sigla'];

}

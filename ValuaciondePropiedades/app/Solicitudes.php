<?php
/**
 * Created by PhpStorm.
 * User: benja
 * Date: 11/11/2018
 * Time: 12:28 AM
 */
namespace App;

use Illuminate\Database\Eloquent\Model;

class Solicitudes extends Model
{
    protected $table = 'solicitudes_calculos';

    protected $fillable = [
        'colonia'=>'string' ,'m2_terreno' => 'float','m2_construido'=> 'float','acabados' => 'string','conservacion'=>'string',
    ];
}
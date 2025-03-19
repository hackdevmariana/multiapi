<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Provincia extends Model
{
    protected $fillable = [
        'codigo_provincia',
        'nombre_provincia',
        'codigo_autonomia',
        'comunidad_autonoma',
        'capital_provincia',
    ];
}

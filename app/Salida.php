<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Salida extends Model
{
    protected $table = 'salida';
    protected $fillable = [
        'id','fecha','añoSalida',
    ];
    protected $primaryKey = 'idSalida';
    public $timestamps = false;
}

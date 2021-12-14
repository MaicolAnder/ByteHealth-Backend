<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PersonaTipoIdentificacion extends Model
{
    public $timestamps = false;
    protected $primaryKey = 'Id_PerTipId';
    protected $table = 'persona_tipo_identificacion';
}

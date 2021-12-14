<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Afiliado extends Model
{
    public $timestamps = false;
    protected $primaryKey = 'Id_Afi';
    protected $table = 'afiliado';
}

<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * Modelo de datos para la tabla usuario
 * @author Miguel A. Tunubalá
 * @since 2021-09-17
 */
class Usuario extends Authenticatable implements JWTSubject
{
    use Notifiable;

    public $timestamps = true;
    protected $table = 'usuario';
    protected $primaryKey = 'Id_Usu';

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

}

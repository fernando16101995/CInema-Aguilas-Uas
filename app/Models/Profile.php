<?php

namespace App\Models;
use MongoDB\Laravel\Eloquent\Model;
class Profile extends Model
{
    /**
     *  Le decimos a Laravel que use conexión a MongoDB
     */
    protected $connection = 'mongodb';
    
    /**
     *  Le decimos el nombre de la "colección"  en MongoDB
     * donde se guardarán los perfiles.
     */
    protected $collection = 'perfiles';

    /**
     *  Lista de campos que permitimos se llenen 
     */
    protected $fillable = [
        'user_id',       
        'nombre_perfil',  
        'avatar_url',     
        'es_niño',        
    ];

    /*
     *  Esto define la relación: un Perfil (Mongo)
     * pertenece a un Usuario (Postgres).
     */
    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id', 'id');
    }
}

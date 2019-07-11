<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $fillable = [
        'nom_prenom', 'telephone', 'email', 'adresse'
    ];

    public function commandes(){

        return $this->hasMany('App\Model\Commande');
    }
}

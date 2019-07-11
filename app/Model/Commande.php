<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Commande extends Model
{
    protected $fillable = [
        'client_id', 'montant', 'nombre_produit', 'traiter'
    ];

    public function client(){

        return $this->belongsTo('App\Model\Client');
    }

    public function produits(){

        return $this->belongsToMany('App\Model\Produit');
    }
}

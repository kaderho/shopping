<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Produit extends Model
{
    protected $fillable = [
        'nom', 'label', 'prix', 'details', 'description', 'quantity', 'photo', 'disponible'
    ];

    public function commandes(){

        return $this->belongsToMany('App\Model\Commande');
        
    }
}

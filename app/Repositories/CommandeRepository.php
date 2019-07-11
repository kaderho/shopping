<?php

namespace App\Repositories;

use App\Model\Commande;
use App\Model\Produit;
use App\Model\Client;

use App\Repositories\ProduitRepository;
use App\Repositories\ClientRepository;
use App\Repositories\CommandeRepository;

class CommandeRepository
{

    protected $commande;

    public function __construct(Commande $commande){

        $this->commande = $commande;
    }

    public function getPaginate($n){

        return $this->commande->paginate($n);
    }

    public function store (Array $inputs, $client){
        
        $this->commande = $client->commandes()->create($inputs);

        return $this->commande;
    }

    public function destroy(Commande $commande){

        $commande->client()->dissociate();
        $commande->produits()->detach();
        $commande->delete();
        
    }

    public function getCommandeTraiterPaginate($n){

        return $this->commande->where('traiter', true)->paginate($n);
    }

     public function getCommandeNonTraiterPaginate($n){

        return $this->commande->where('traiter', false)->paginate($n);
    }
}
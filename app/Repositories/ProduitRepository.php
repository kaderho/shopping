<?php

namespace App\Repositories;

use App\Model\Produit;
use App\Model\Commande;


use Illuminate\Support\Facades\DB;
use Hash;
use Storage;

use App\Outils\FilesOutil;

class ProduitRepository
{
    protected $produit;

    protected $outil;
    
    public function __construct(Produit $produit, FilesOutil $outil){

        $this->produit = $produit;
        $this->outil = $outil;
    }

    public function getPaginate($n){

        $produits = Produit::all();

        foreach ($produits as $produit) {
        
            if($produit->quantity < 1){

                $produit->quantity = 0;
                $produit->disponible = false;
                $produit->update();
            }
        }
        return $this->produit->inRandomOrder()->take($n)->paginate($n);
    }

    public function store(Array $inputs){

        $path = $this->outil->storeFiles($inputs['photo']);
        $inputs['photo'] = $path;
        
        $this->produit->create($inputs);
    }

    public function update(Array $inputs, Produit $produit){

        $path = $path = $this->outil->storeFiles($inputs['photo']);
        $inputs['photo'] = $path;

        $produit->update($inputs);
    }

    public function destroy(Produit $produit){

        $produit->commandes()->detach();
        $produit->delete();
    }

    public function getAll($status){

        if($status == 'dispo'){

            return Produit::where('disponible', true)->get();
        }

        if($status == 'indispo'){
            
            return Produit::where('disponible', false)->get();
        }
       return Produit::all();


    }
    
    public function  getProduitDispoPaginate($n){

        return $this->produit->where('disponible', true)->paginate($n);
    }

     public function  getProduitIndispoPaginate($n){

        return $this->produit->where('disponible', false)->paginate($n);
    }

    public function  updateQuantityPoduct($produit, $n){

        $produit->quantity = $produit->quantity - $n;
        
        $produit->update();
    }

}
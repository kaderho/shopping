<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;

use App\Model\Produit;
use App\Repositories\ProduitRepository;

class ExportProduitExcel implements FromCollection
{

    protected $produitRepository;
    public $disponible;

    public function __construct(ProduitRepository $produitRepository){

        $this->produitRepository = $produitRepository;
       
    }

    public function collection(){
            
        return $this->produitRepository->getAll($this->disponible); 
        
    }

}
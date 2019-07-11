<?php

namespace App\Imports;

use App\Model\Produit;
use Maatwebsite\Excel\Concerns\ToModel;

class ProduitImportExcel implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        if(!isset($row[6])){
            return null;
        }
        return new Produit([
            
            'id' => null,
            'nom' => $row[1],
            'label' => $row[2],
            'prix' => $row[3],
            'details' => $row[4],
            'description' => $row[5],
            'photo' => $row[6]
        ]);
    }
}

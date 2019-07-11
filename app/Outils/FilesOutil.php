<?php

namespace App\Outils;

use Storage;
use Hash;

class filesOutil
{
    public function storeFIles($file){

        $fileExtension = strtolower($file->getClientOriginalExtension());

        if (in_array($fileExtension, ['jpg', 'jpeg', 'png'])) {
            $path = $file->store('imagesProduits', 'public');

            return $path;
        }

        if(in_array($fileExtension, ['xlsx'])){

            $filename = $file->getClientOriginalName();
            $file->storeAs('ExcelProduits',$file->getClientOriginalName(), 'public');
            
            return $filename;
        }

        if(in_array($fileExtension, ['pdf'])){

            $filename = $file->getClientOriginalName();
            $file->storeAs('FacturesClientsPdf',$file->getClientOriginalName(), 'public');
            
            return $filename;
        }
    }

    public function exportExcel(Excel $excel, ExportProduitExcel $produits){

        return Excel::download($produits, 'produits.xlsx');
    }

    public function importExcel(ProduitImportExcelRequest $request){

        $outil = new FilesOutil();
        $outil->storeFiles($request->excel_file);

        Excel::import(new ProduitImportExcel, $request->excel_file);

        return back()->withSuccess('Vous venez d\'importer une liste des produits');
    }

}
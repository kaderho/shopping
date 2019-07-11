<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;

use Illuminate\Http\Request;
use App\Http\Requests\ProduitRequest;
use App\Http\Requests\ProduitImportExcelRequest;

use App\Repositories\ProduitRepository;
use App\Model\Produit;

use App\Outils\FilesOutil;

use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ExportProduitExcel;
use App\Imports\ProduitImportExcel;

class ProduitController extends Controller
{
    protected $produitRepository;

    protected $produitPerPage = 4;

    public function __construct(ProduitRepository $produitRepository){

        $this->middleware('auth', ['except' => ['show', 'index']]);
        // $this->middleware('admin', ['only' => 
        //         ['create', 'store', 'edit', 'destroy', 'update', 'exportExcel', 'importExcel', 'destroy']]);
        
        $this->produitRepository = $produitRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $produits = $this->produitRepository->getPaginate($this->produitPerPage);

        return view('produits.liste', compact('produits'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('produits.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProduitRequest $request)
    {
        $this->produitRepository->store($request->all());

       // flash("Nouveau produit ajouté")->success();

        return redirect('/admin/produit/disponible')->with('success', 'Nouveau produit ajouté.');
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $label
     * @return \Illuminate\Http\Response
     */
    public function show($label)
    {
        $produit = Produit::where('label', $label)->firstOrFail();

        return view('produits.show', compact('produit'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  string  $label
     * @return \Illuminate\Http\Response
     */
    public function edit($label)
    {   
        $produit = Produit::where('label', $label)->firstOrFail();
        return view('produits.edit', compact('produit'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $label
     * @return \Illuminate\Http\Response
     */
    public function update(ProduitRequest $request, $label)
    {
        $produit = Produit::where('label', $label)->firstOrFail();

        if($produit->disponible){
            
            $this->produitRepository->update($request->all(), $produit);

            return redirect('/admin/produit/disponible')
            ->with('success', 'Le produit'. $produit->nom .'a bien été modifié !');
        }
        $this->produitRepository->update($request->all(), $produit);

        return redirect('/admin/produit/indisponible')
                ->with('success', 'Le produit'. $produit->nom .'a bien été modifié !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  string  $label
     * @return \Illuminate\Http\Response
     */
    public function destroy($label)
    {
        $produit = Produit::where('label', $label)->firstOrFail();
        
        //$file = Storage::disk('public')->exists($produit->photo)->get($produit->photo);

        $file = Storage::disk('public')->delete($produit->photo);       
        
        if($produit->disponible){

            $this->produitRepository->destroy($produit);
             return redirect('/admin/produit/disponible')
                    ->withSuccess('Le produit '. $produit->nom_produit .'à bien été supprimé !');
        }
        $this->produitRepository->destroy($produit);
        return redirect('/admin/produit/indisponible')->withSuccess('Le produit '. $produit->nom_produit .'à bien été supprimé !');
    }

    /**
     * Export list produits in excel format.
     */

     public function exportExcel(ExportProduitExcel $produits, Request $request){

        $produits->disponible = $request->disponible;

        return Excel::download($produits, 'produits_'.$request->disponible.'.xlsx');
     }

     //Imoporter sous format Excel
     public function importExcel(ProduitImportExcelRequest $request){

        $outil = new FilesOutil();
        $outil->storeFiles($request->excel_file);

        Excel::import(new ProduitImportExcel, $request->excel_file);

        return back()->withSuccess('Vous venez d\'importer une liste des produits');
     }

     //Produit Disponoble
     public function produitDispo(){

        $produitDispo = $this->produitRepository->getProduitDispoPaginate($this->produitPerPage);

        return view('admin.home')->with(['dispo' => 'dispo', 'produits' => $produitDispo]);
     }

     //Produit Indisponible
     public function produitIndispo(){
         
         $produitIndispo = $this->produitRepository->getProduitIndispoPaginate($this->produitPerPage);

        return view('admin.home')->with(['indispo' => 'indispo', 'produits' => $produitIndispo]);
     }
}

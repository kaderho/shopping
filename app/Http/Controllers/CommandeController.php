<?php

namespace App\Http\Controllers;

use Gloudemans\Shoppingcart\Facades\Cart;

//use Barryvdh\DomPDF\PDF;
use PDF;

use Dompdf\Dompdf;

use Illuminate\Http\Request;
use App\Http\Requests\CommandeRequest;

use App\Model\Commande;
use App\Model\Produit;
use App\Model\Client;

use App\Repositories\ProduitRepository;
use App\Repositories\ClientRepository;
use App\Repositories\CommandeRepository;

use App\Outils\FilesOutil;

class CommandeController extends Controller
{
    protected $commandeRepository;

    protected $commandePerPage = 4;

    public function __construct(CommandeRepository $commandeRepository){

        $this->middleware('auth', ['except' => ['create', 'store', 'downloadPdf', '']]);
      

        $this->commandeRepository = $commandeRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$commandes = $this->commandeRepository->getPaginate($this->commandePerPage);

        return view('commandes.liste');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(ProduitRepository $produitRepository)
    {
        return view('commandes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CommandeRequest $request, ClientRepository $clientRepository, ProduitRepository $produitRepository)
    {
        $client = $clientRepository->store($request->all());

        $montant = Cart::total();
        $nombre_produit = Cart::count();

        $commande = $this->commandeRepository->store(['montant' => $montant, 
                                                        'nombre_produit' => $nombre_produit], $client);
        
        foreach(Cart::content() as $produit){
            
            $produitRepository->updateQuantityPoduct($produit->model, $produit->qty);

            $commande->produits()->attach($produit->model->id);
        }

        return view('commandes.facture')->with(['commande'=>$commande, 'facture'=>'Ok']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Commande $commande)
    {
        return view('commandes.edit', compact('commande'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CommandeRequest $request, Commande $commande)
    {
        $this->commandeRepository
            ->update($request
            ->all(), ['client_id' => $request->clients()->id, 'produit_id' => $request->produits()->id]);
        
        return redirect('commande.index')->withFacture('Ok');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Commande $commande)
    {
        $this->commandeRepository->destroy($commande);

        return back();
    }

    public function downloadPdf($id){

        $dompdf = new DOMPDF();
        $outil = new FilesOutil();

        $commande = Commande::where('id', $id)->firstOrFail();

        $file = view('commandes.facture', compact('commande'));
       
        $dompdf->loadHtml($file);
        $dompdf->render();


       // $filePdf = ;
        //$outil->storeFiles($filePdf);

        return $dompdf->stream($commande->client->nom_prenom.'_facture.pdf', array('Attachment'=>1))
                    ->view('panier.index');
    }

    public function commandeTraiter(){
        
        $commandes = $this->commandeRepository->getCommandeTraiterPaginate($this->commandePerPage);

        return view('commandes.liste')->with(['commandes'=>$commandes, 'traiter'=>'traitées']);
    }

    public function commandeNonTraiter(){

        $commandes = $this->commandeRepository->getCommandeNonTraiterPaginate($this->commandePerPage);

        return view('commandes.liste')->with(['commandes'=>$commandes, 'nonTraiter'=>'non traitées']);
    }

    public function valider(Commande $commande){

        $commande->traiter = true;
        $commande->update();
        
        return redirect()->route('commande-non-traiter')->withSuccess('Commande valider !');
    }
}

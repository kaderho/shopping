i
@extends('layouts.app')

@section('content')

    <div class="container">
        
        <div class="row">
            <div class="col-md-offset-1 col-md-10">
                <div class="card card-primary">

                        <table>
                                <tr>
                                    <td>
                                            <div class="card-header">
                       
                                                    <div class="col-md-4"><h3>Votre facture</h3><span><b>Date du : </b> {{ $commande->created_at->format('d-m-Y') }}</span></div>
                                                    <div class="col-md-8"><h3>Notre Entreprise de E-commerce(N2Ec)</h3></div> 
                                                </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        
                    <div class="card-body">
                            <h5  class=" text-center"><b>Informations client</b></h5>
                            <div class="card-header">
                                <p><b>Nom et Prénom(s) : </b>{{ $commande->client->nom_prenom }} </p>
                                <p><b>Numéro de Téléphone : </b> {{ $commande->client->telephone }}</p>
                                <p><b>Adresse : </b>{{ $commande->client->adresse }} </p>
                                <p><b>E-mail : </b>{{ $commande->client->email }}</p>    
                            </div>
                            
                            <h5  class="text-center"><b>Informatoins achats</b></h5>
                            
                            <div class="card-header">
                                    <table class="table table-striped">
                                            <thead>
                                              <tr>
                                                <th scope="col">Produit</th>
                                                <th scope="col">Prix</th>
                                                <th scope="col">Quantité</th>
                                                <th scope="col">Total</th>
                                              </tr>
                                            </thead>
                                            <tbody>
                                        @foreach (Cart::content() as $produit)
                                                  <tr>
                                                    <td scope="row">{{ $produit->model->nom }}</td>
                                                    <td><b>{{ $produit->model->prix }} FCFA</b></td>
                                                    <td>{{ $produit->qty }}</td>
                                                    <td><b>{{ $produit->subtotal() }} FCFA</b></td>
                                                  </tr>
                                                  @endforeach
                                                  <tr>
                                                      <td scope="row"></td>
                                                      <td></td>
                                                      <td></td>
                                                      <td><b>Taxe(18%) {{ Cart::tax() }} FCFA</b></td>
                                                  </tr>
                                                  <tr>
                                                      <td scope="row"></td>
                                                      <td></td>
                                                      <td></td>
                                                      <td><b>Total TTC {{ Cart::total() }} FCFA</b></td>
                                                  </tr>
                                                </tbody>
                                              </table>
                                        
                                       
                            </div>
                      
                        </div>
                                    </td>
                                </tr>
                            </table>
                 
                </div>
              
                @if(isset($facture))
                <div><a href=" {{ route('download-pdf', ['id'=>$commande->id]) }} " class="btn btn-success btn-block btn-lg">Imprimer votre reçu au formar PDF</a></div>
                @endif
            </div>
           
        </div> 
          
    </div>

@endsection
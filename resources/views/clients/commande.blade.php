@extends('layouts.admin')

@section('content')
    <h2 class="text-center">Les commandes de {{ $client->nom_prenom }} </h2>
	@foreach($client->commandes as $commande)
		<article class="row bg-primary">
			<div class="col-md-12">
				<header>
					<h1> Commande Nº {{ $commande->id }}
						<div class="pull-right">
							@foreach($commande->produits as $produit)
								<em><a href="{{ route('produit.show', ['label'=>$produit->label]) }}"
                                    class="btn btn-xs btn-info">{{ $produit->nom }}</a></em>
							@endforeach
						</div>
					</h1>
				</header>
				<hr>
				<section>
                    <p><b>Montant : </b>{{ $commande->montant }} FCFA</p>
                    <p><b>Nombre de produit(s) : </b>{{ $commande->nombre_produit }}</p>
					<em class="pull-right">
                        <span><b>Date de la commande </b>{{ $commande->created_at->format('d-m-Y') }}
                        à {{ $commande->created_at->format('h:m:s') }}</span>
                        <br>
                        @if ($commande->traiter)
                             <span><b>Traitée le </b>{{ $commande->updated_at->format('d-m-Y') }}
                        à {{ $commande->created_at->format('h:m:s') }}</span>
                        @endif
						{{-- <span class="glyphicon glyphicon-cart"></span> Commandé le {!! $commande->commandes()->created_at->format('d-m-Y') !!} --}}
					</em>
				</section>
            </div>
           <div class="container">
               <div class="row pt-10" style="margin-bottom:20px; margin-left:3px;">
            {!! Form::open(['method' =>'DELETE', 'route' => ['commande.destroy', $commande]]) !!}
                {!! Form::submit('Supprimer', ['onclick' => 'return confirm(\'Voulez-vous vraiment suprimer cette commande ?\')',
                    'class' => 'btn btn-danger btn-xs']) !!}
            {!! Form::close() !!}
            
            <div class="col-md-1"><a href=" {{ route('validater', $commande) }} " class="btn btn-xs btn-success">Valider</a></div>
           </div>
           </div>
           
            
            
		</article>
		<br>
	@endforeach

@endsection
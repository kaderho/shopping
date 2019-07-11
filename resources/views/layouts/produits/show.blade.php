 <div class="col-md-12">
    <div class="card mb-3" style="max-width: 1500px;">
        <div class="row no-gutters">
            <div class="col-md-6" id="img-des">
                <img src="{{url('storage/'. $produit->photo)}}" class="card-img" alt="...">
            </div>
            
            <div class="col-md-6">
                <div class="card-body">
                    <h2 class="card-title" style="color:black;"> {{ $produit->nom }}</h2>
                    <h3 style="color:black;">Prix : {{ $produit->prix }} FCFA</h3>
                    <p class="card-text">
                        <b>Détails</b>
                        <p>{{ $produit->details }}</p>
                    </p>
                    <p class="card-text">
                        <b>Description</b>
                        <p>{{ $produit->description }}</p>
                    </p>
                    <p class="card-text">
                        <small class="text-muted">
                            <a href="{{ route('produit.index') }}" class="btn btn-primary">Retour</a>        
                            @if($produit->disponible)
                                <form action="{{ route('panier.store') }}" method="post">
                                    {{ csrf_field() }}
                                    <input type="text" hidden="" name="id" value="{{ $produit->id }}">
                                    <input type="text" hidden="" name="nom" value="{{ $produit->nom }}">
                                    <input type="text" hidden="" name="prix" value="{{ $produit->prix }}">
                
                                    <input type="submit" value="Ajouter au panier" class="btn btn-success">        
                                </form>
                            @endif
                        </small>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
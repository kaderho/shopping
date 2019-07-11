@if ($produits->count() > 0)


@if (auth()->check())
<h2 class="text-center">Nos Produits</h2>
    <div class="row">
    @if (isset($dispo))

        {!! Form::open(['route'=>'import-excel', 'files'=>true]) !!}      
        {!! csrf_field() !!}
        <div class="col-md-6">
            <div class=" form-group {{ $errors->has('excel_file') ? 'has-error' : '' }} ">
                <input type="file" name="excel_file" 
                    value=" {{ old('excel_file') }}" class="form-control" id="">
                {!! $errors->first('excel_file',  '<span class="text-danger"> :message</span>') !!}
            </div>
        </div>   
        <div class="col-md-2">
            {!! Form::submit('Importer un fichier Excel', ['class' => 'btn btn-primary'])  !!}
        </div>
    {!! Form::close() !!}
    @endif

    <div class="col-md-2 col-md-offset-1"> 
      
        @if (isset($dispo))
            {!! link_to_route('export-excel', 'Exporter la liste sous Excel', ['disponible'=> $dispo], ['class' => 'btn btn-success']) !!}    
        @endif
        @if (isset($indispo))
            {!! link_to_route('export-excel', 'Exporter la liste sous Excel', ['disponible'=> $indispo], ['class' => 'btn btn-success']) !!}
        @endif
        
    </div>
</div>
    
@endif


{!! $produits->links() !!}
<div class="row">                
    @foreach ($produits as $produit)
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title" style="color:black;">{{ $produit->nom }}</h3>
                </div>
                <div class="card-body" style="max-height:350px;">
                    <div class="row">
                        <div class="col-md-4">
                            <img src="{{ asset('storage/'. $produit->photo) }}" alt="">
                        </div>
                         <div class="col-md-6">
                            <p class="card-text">{{ $produit->details }}</p>
                            <h4 style="color:black;">Prix : {{ $produit->prix }} FCFA</h4>
                            <div>
                            
                            @if (Auth::guest())
                                 <a href=" {{route('produit.show', ['label'=>$produit->label])}} " class="btn btn-primary">Voir plus</a>
                            @else
                                
                            @endif
                            @if (auth()->check())
                                <a href=" {{route('produit.show', ['label'=>$produit->label])}} " class="btn btn-primary btn-xs">Voir plus</a>
                                <a href=" {{route('produit.edit', ['label'=>$produit->label])}} " class="btn btn-warning btn-xs">Modifier</a>

                                 {!! Form::open(['method' =>'DELETE', 'route' => ['produit.destroy', $produit->label]]) !!}
                                {!! Form::submit('Supprimer', ['onclick' => 'return confirm(\'Voulez-vous vraiment suprimer cet produit ?\')',
                                'class' => 'btn btn-danger btn-xs']) !!}
                            {!! Form::close() !!}
                            @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    Il ne reste que <b>{{ $produit->quantity }}</b> en stock.
                </div>
            </div>
            <br><br>
        </div>
    @endforeach
</div>
{!! $produits->links() !!}
@else
<h2 class="text-center" style="color:red">Oups, aucun produit !</h2>
@endif
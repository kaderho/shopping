@extends('layouts.admin')

@section('content')

    <div class="col-md-offset-3 col-md-6">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="text-center">Ajouter un produit</h3>
            </div>
            <div class="panel-body">
                {!! Form::open(['route' => 'produit.store', 'files' => true]) !!}
                    
                    @include('layouts.produits.form')    
                    
                    <div class="col-md-8"> 
                        {!! Form::submit('Enregistrer', ['class' => 'btn btn-success btn-block']) !!}
                    </div>
                    <div class="col-md-4">
                        {!! Form::reset('Tout éffacer', ['class' => 'btn btn-info btn-block']) !!}
                    </div>
                {!! Form::close() !!}
            </div>      
        </div>
    </div>
    
@endsection
@extends('layouts.app')

@section('content')

<div class="col-md-offset-1 col-md-4">
        <div class="panel panel-default">
            <div class="panel-heading">Soumettre un commande</div>
            <div class="panel-body">
                {!! Form::open(['route' => 'commande.store']) !!}
                    {!! csrf_field() !!}
                    
                    <fieldset>
                        <legend>Informations Client</legend>
                        <div class="form-group {{ $errors->has('nom_prenom') ? 'has-error' : '' }} ">
                                {!! Form::label('nom_prenom', 'Nom et Prénom(s)') !!}
                                {!! Form::text('nom_prenom', null, ['class' => 'form-control', 
                                    'placeholder' => 'Ecrivez votre nom et prenom ici',
                                    'value' => old('nom_prenom'), 'autofocus']) !!}
                                {!! $errors->first('nom_prenom', '<span> :message</span>') !!}
        
                            </div>
        
                            <div class="form-group {{ $errors->has('telephone') ? 'has-error' : '' }} ">
                                    {!! Form::label('telephone', 'Téléphone') !!}
                                    {!! Form::text('telephone', null, ['class' => 'form-control',
                                        'placeholder' => 'Ecrivez votre numero de téléphone ici. Ex: 123456789',
                                        'value' => old('telephone')]) !!}
                                    {!! $errors->first('telephone', '<span class="helper-block"> :message</span>') !!}
                            </div>
        
                            <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }} ">
                                    {!! Form::label('email', 'E-mail') !!}
                                    {!! Form::text('email', null, ['class' => 'form-control',
                                        'placeholder' => 'Ecrivez votre adresse E-mail ici. Ex: exemple@email.com',
                                        'value' => old('email')]) !!}
                                    {!! $errors->first('email', '<span class="helper-block"> :message</span>') !!}
                                </div>
        
                                <div class="form-group {{ $errors->has('adresse') ? 'has-error' : '' }} ">
                                        {!! Form::label('adresse', 'Adresse') !!}
                                        {!! Form::text('adresse', null, ['class' => 'form-control',
                                            'placeholder' => 'Ecrivez votre adresse ici.',
                                            'value' => old('adresse')]) !!}
                                        {!! $errors->first('adresse', '<span class="helper-block"> :message</span>') !!}
                                </div>
                    </fieldset>
                    {!! Form::submit('Valider votre commande', ['class' => 'btn btn-success pull-right']) !!}
                {!! Form::close() !!}
                    </div>
    </div>
</div>

    <div class="col-md-7">
       @include('parniers.produitCommandes')
    </div>

@endsection 
@extends('layouts.app')

@section('content')

<div class="col-sm-offset-3 col-sm-6">
    <div class="panel panel-default">
        <div class="panel-heading">Ajouter</div>
        <div class="panel-body">
            {!! Form::open(['route' => 'client.store']) !!}
                {!! csrf_field() !!}
                <div class="form-group {{ $errors->has('nom' ? ' has-error' : '') }}">
                    {!! Form::text('nom', null, ['class' => 'form-control', 
                    'placeholder' => 'Nom du client', 'value' => old('nom'), 'autofocus']) !!}
                    
                    {!! $errors->first('nom', '<span class="helper-block">:message</span>') !!}
                </div>

                <div class="form-group {{ $errors->has('prenom') ? ' has-error' : '' }}">
                    {!! Form::text('prenom', null, ['class' => 'form-control', 
                    'placeholder' => 'prenom du client',
                    'value' => old('prenom')]) !!}

                    {!! $errors->first('prenom', '<span class="helper-block">:message</span>') !!}
                </div>

                <div class="form-group {{ $errors->has('numero_cni') ? ' has-error' : '' }}">
                        {!! Form::text('numero_cni', null, ['class' => 'form-control',
                        'placeholder' => 'Ecrire vos numero_cni séparés par des virgule.',
                        'value' => old('numero_cni')]) !!}

                        {!! $errors->first('numero_cni', '<span class="helper-block">:message</span>') !!}
                </div>
                {!! Form::submit('Envoyer', ['class' => 'btn btn-primary pull-right']) !!}
            {!! Form::close() !!}
        </div>
                        
    </div>
</div>
    
@endsection
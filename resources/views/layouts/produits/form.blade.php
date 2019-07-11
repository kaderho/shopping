{!! csrf_field() !!}
    <div class="form-group {{ $errors->has('nom') ? 'has-error' : '' }} ">
        {!! Form::label('nom', 'Nom du produit') !!}
        {!! Form::text('nom', null, ['class' => 'form-control', 
            'placeholder' => 'Ecrire le nom du produit ici',
            'value' => old('nom'), 'autofocus']) !!}
        {!! $errors->first('nom', '<span class="text-danger"> :message</span>') !!}
    </div>

    <div class="form-group {{ $errors->has('label') ? 'has-error' : '' }} ">
        {!! Form::label('label', 'Label produit') !!}
        {!! Form::text('label', null, ['class' => 'form-control', 
            'placeholder' => 'Ecrire le label ici. Ex: label-label',
            'value' => old('label')]) !!}
        {!! $errors->first('label', '<span class="text-danger"> :message</span>') !!}
    </div>

    <div class="form-group {{ $errors->has('details') ? 'has-error' : '' }} ">
        {!! Form::label('details', 'Détails produit') !!}
        {!! Form::text('details', null, ['class' => 'form-control', 
            'placeholder' => 'Ecrire les détails ici.',
            'value' => old('details')]) !!}
        {!! $errors->first('details', '<span class="text-danger"> :message</span>') !!}
    </div>

    <div class="form-group {{ $errors->has('prix') ? 'has-error' : '' }} ">
        {!! Form::label('prix', 'Prix du produit') !!}
        {!! Form::number('prix', null, ['class' => 'form-control',
            'placeholder' => 'Ecrire le prix du produit ici. Ex:100',
            'value' => old('prix')]) !!}
        {!! $errors->first('prix', '<span class="text-danger"> :message</span>') !!}
    </div>

    <div class="form-group {{ $errors->has('quantity') ? 'has-error' : '' }} ">
        {!! Form::label('quantity', 'Quantité du produit') !!}
        {!! Form::number('quantity', null, ['class' => 'form-control',
            'placeholder' => 'Ecrire la quantité du produit ici. Ex:100',
            'value' => old('quantity')]) !!}
        {!! $errors->first('quantity', '<span class="text-danger"> :message</span>') !!}
    </div>

    <div class="form-group {{ $errors->has('description') ? 'has-error' : '' }} ">
        {!! Form::label('description', 'Description du produit') !!}
        {!! Form::textarea('description', null, ['class' => 'form-control',
            'placeholder' => 'Ecrire la description du produit ici',
            'value' => old('description'),
            'rows' => 5,
            'cels' => 10]) !!}
        {!! $errors->first('description', '<span class="text-danger"> :message</span>') !!}
    </div>
                                              
    <br>
    <div class="form-group {{ $errors->has('photo') ? 'has-error' : '' }} ">
        {!! Form::label('photo', 'La Photo du produit') !!}
        <input type="file" name="photo" class="form-control" 
        placeholder="La photo du produit" value=" {{ old('photo') }} " id="">
        {!! $errors->first('photo', '<span class="text-danger"> :message</span>') !!}
    </div>
    <br>
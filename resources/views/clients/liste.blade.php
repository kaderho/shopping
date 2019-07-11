@extends('layouts.admin')

@section('content')
    
    <div>
        <h3 class="text-center">Nos Clients</h3>
          @if ($clients->count() > 0)
        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nom et Prénom(s)</th>
                    <th>Téléhonep</th>
                    <th>Adresse</th>
                    <th>E-mail</th>
                    <th></th>
                    <th></th>
                    
                </tr>
            </thead>

            <tbody>
                
                @foreach ($clients as $client)
                    
                    <tr>
                        <td>{{ $client->id }}</td>
                        <td>{{ $client->nom_prenom }}</td>
                        <td>{{ $client->telephone }}</td>
                        <td>{{ $client->adresse }}</td>
                        <td>{{ $client->email }}</td>
                        <td>
                            {!! link_to_route('client.show', 
                            'Voir les commandes du client', 
                            ['id' => $client], ['class' => 'btn btn-primary btn-xs']) !!}
                        </td>
                        <td>{!! Form::open(['method' => 'DELETE', 'route' => ['client.destroy', $client]]) !!}
                                    {!! Form::submit('Supprimer', ['class' => 'btn btn-danger btn-xs', '
                                                                    onclick' => 'confirm(\'Voulez vous vraiment supprimer ?\')']) !!}
                            {!! Form::close() !!}
                        </td>
                    </tr>

                @endforeach
                
            </tbody>
        </table>

        {!! $clients->links() !!}

        @else
            <h2 class="text-center" style="color:red">Oups, aucun client !</h2>
        @endif
    </div>

@endsection
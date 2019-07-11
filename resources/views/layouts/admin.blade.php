<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
     <link href="{{ asset('css/style.css') }}" rel="stylesheet">

             <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: black;
                font-family: 'arial', sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0;
            }
        </style>
    
</head>
<body>
     @if (!isset($facture))
     <nav class="navbar navbar-expand-lg navbar-light navbar-static-top bg-light">
<a class="navbar-brand" href="{{ url('/') }}">{{ config('app.name', 'Commander') }}</a>
        <div class="navbar-header">
            <!-- Collapsed Hamburger -->
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar" aria-controls="app-navbar" aria-expanded="false" aria-label="Toogle navigation">
                <span class="navbar-toggle-icon">Toggle Navigation</span>
            </button>
        </div>
        <div class="collapse navbar-collapse" id="app-navbar">
            <!-- Left Side Of Navbar -->
            <ul class="nav navbar-nav">
                {{--  <li class="nav-item"><a href=" {{ route('admin') }} ">Accueil</a></li>  --}}
                <li class="nav-item"><a href=" {{ route('produit.index') }} ">Nos Produits</a></li>
                <li class="nav-item">
                    <a href=" {{ route('panier.index') }} ">Parnier 
                        @if (Cart::instance('default')->count() > 0)
                            <span class="badge badge-danger">{{ Cart::instance('default')->count() }}</span>
                        @endif
                    </a>
                </li>
            </ul>

            <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @if (Auth::guest())
                            <li><a href="{{ route('login') }}">Connexion</a></li>
                            <li><a href="{{ route('register') }}">Inscription</a></li>
                        @else
                            <li class="dropdowng">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true" v-pre>
                                    Bonjour, {{ Auth::user()->name }} 
                                    @if(Auth::user()->admin == 1)
                                    (Administrateur)
                                    @endif !
                                </a>

                                <ul class="dropdown-menu">
                                    <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Déconnexion
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                       @endif
                    </ul>

        </div>

    </nav>
    @endif

    <div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading"><h3 class="text-center">Tableau de bord</h3></div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    
                        <nav class="navbar navbar-expand-lg navbar-primary bg-light">
                            <ul class="nav navbar-nav">
                                <li  class="nav-item">
                                    <li class="dropdown">
                                    <a data-toggle="dropdown" href="#">Produits<b class="caret"></b></a>
                                    <ul class="dropdown-menu">
                                        <li  class="nav-item"><a href="{{ route('produit.create') }}">Ajouter Produit</a></li>
                                        <li  class="nav-item"><a href="{{ route('produit-dispo') }}">Produit Disponibles</a></li>
                                        <li  class="nav-item"><a href="{{ route('produit-indispo') }}">Produit Indisponibles</a></li>
                                        
                                    </ul>
                                </li>
                                </li>
                                 <li class="dropdown">
                                    <a data-toggle="dropdown" href="#">Client<b class="caret"></b></a>
                                    <ul class="dropdown-menu">
                                        <li  class="nav-item"><a href="{{ route('client.index') }}">Nos clients</a></li>
                                        <li  class="nav-item"><a href="#"></a></li>
                                    </ul>
                                </li>
                                <li class="dropdown">
                                    <a data-toggle="dropdown" href="#">Commandes<b class="caret"></b></a>
                                    <ul class="dropdown-menu">
                                        <li  class="nav-item"><a href="{{ route('commande-non-traiter') }}">Commandes non traitées</a></li>
                                        <li  class="nav-item"><a href=" {{ route('commande-traiter') }} ">Commandes traitées</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </nav>
                        <hr>
                      @include('flash-message')
                     @yield('content')
                     
                    </div>
                </div>
            </div>
        </div>
    </div>
  <!-- Scripts -->
    <script src="{{ asset('js/jquery-3.3.1.js') }}"></script>
    <script src="{{ asset('js/bootstrap.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>
   
    @yield('js-extra')

</body>
</html>
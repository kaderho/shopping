@extends('layouts.app')

@section('content')

<div class="container">

    @if (Cart::count() > 0)
    
    <h2> {{ Cart::count() }} produit(s) ajouté(s) au panier. </h2>
	<table id="cart" class="table table-hover table-condensed">
    				<thead>
						<tr>
							<th style="width:50%">Produit</th>
							<th style="width:10%">Prix</th>
							<th style="width:8%">Quantité</th>
							<th style="width:22%" class="text-center">Total</th>
							<th style="width:10%"></th>
						</tr>
					</thead>
					<tbody>
                        @foreach (Cart::content() as $produit)
                         
                        <tr>
                                <td data-th="Product">
                                    <div class="row">
                                        <div class="col-sm-2 hidden-xs"><img src=" {{ asset('storage/'.$produit->model->photo) }} " alt="..." class="img-responsive"/></div>
                                        <div class="col-sm-10">
                                            <h4 class="nomargin">{{  $produit->model->nom }}</h4>
                                        <p>{{ $produit->model->details }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td data-th="Price"><b>{{ $produit->model->prix }} FCFA</b></td>
                                <td data-th="Quantity">
                                <input type="number" name="quantity" class="form-control text-center quantity"
                                id =" {{ $produit->name }} " data-id="{{ $produit->rowId }}" 
                                value="{{ $produit->qty }}">
                                </td>
                                <td data-th="Subtotal" class="text-center">{{ $produit->subtotal() }} FCFA</td>
                                <td class="actions" data-th="">
                                    {{-- <button class="btn btn-info btn-sm"><i class="fa fa-refresh"></i></button> --}}
                                    <form action=" {{ route('panier.destroy', $produit->rowId) }}" method="POST">
                                            {{ csrf_field() }}
                                            {{ method_field('DELETE') }}
    
                                            <input type="submit" value="Supprimer" class="btn btn-danger">
                                        </form>
                                    {{-- <button class="btn btn-danger btn-sm"><i class="fa fa-trash-o"></i>X</button>								 --}}
                                </td>
                            </tr>
                            
                        @endforeach
					</tbody>
					<tfoot>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td class="text-center"><strong>Total HTC {{ Cart::subtotal() }} FCFA</strong></td>
                                </tr>
						<tr>
							<td></td>
                            <td></td>
                            <td></td>
                            <td class="text-center"><strong>Taxes {{ Cart::tax() }} FCFA</strong></td>
                        </tr>
                        <tr>
							<td class="hidden-xs" colspan="1"></td>
                            <td></td>
                            <td></td>
                            <td class=" text-center"><strong>Total TTC {{ Cart::total() }} FCFA</strong></td>
						</tr>
						<tr>
							<td><a href=" {{ route('produit.index') }}" class="btn btn-warning"><i class="fa fa-angle-left"></i> Continuer vos achats</a></td>
							<td><a href=" {{ route('vider-panier') }}" onclick="confirm('Voulez-vous vider le parnier ?')" class="btn btn-danger"><i class="fa fa-angle-left"></i> Vider le panier</a></td>                           
                            <td colspan="" ></td>
                          
							
							<td><a href="{{ route('commande.create') }}" class="btn btn-success btn-block">Passer la commande <i class="fa fa-angle-right"></i></a></td>
						</tr>
					</tfoot>
                </table>
            @else

                <h2>Votre panier est vide ! ! !</h2>

                <p>Vous n'êtes pas inspiré ?</p>
                <a href=" {{ route('produit.index') }} ">Continuer vos achats</a>
            @endif
</div>

@section('js-extra')

<script>
    
    //const classname = $(".quantity");
    $(".quantity").each(function(){

        $(this).change(function() {
            const id = $(this).attr('data-id');
    
           //  alert(id);
            axios.patch(`/panier/${id}`, {
                quantity: this.value
            })
            
            .then(function (response) {
               //console.log(response);
               window.location.href = '{{ route('panier.index') }}';
            })
            
            .catch(function (error) {
                //console.log(error);
    
               window.location.href = '{{ route('panier.index') }}';
            });
        });
        }
    );
    </script>
@endsection

@endsection


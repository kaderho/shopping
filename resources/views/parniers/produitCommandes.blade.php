    <h2> Votre commande </h2>
        <table id="cart" class="table table-hover table-condensed">
                        <thead>
                            <tr>
                                <th style="width:50%">Produit</th>
                                <th style="width:10%">Prix</th>
                                <th style="width:8%">Quantité</th>
                                <th style="width:22%" class="text-center">Total</th>
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
                                            <p>{{ $produit->model->label }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td data-th="Price"><b>{{ $produit->model->prix }} FCFA</b></td>
                                    <td data-th="Quantity">
                                        <input type="number" name="quantity" disabled class="form-control text-center" value="{{ $produit->qty }}">
                                    </td>
                                    <td data-th="Subtotal" class="text-center">{{ $produit->subtotal() }} FCFA</td>
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
                            <tr>
                               <td></td>
                               <td></td>
                               <td><td class="text-center"><strong>Taxes {{ Cart::tax() }} FCFA</strong></td></td> 
                            </tr>
                            <tr>
                                <td></td>
                                <td colspan="2" class="hidden-xs"></td>
                                <td class="hidden-xs text-center"><strong>Total TTC {{ Cart::total() }} FCFA</strong></td>
                            </tr>
                        </tfoot>
                    </table>
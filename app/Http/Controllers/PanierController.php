<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;

use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;

class PanierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('parniers.liste');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $duplicate = Cart::search(function($cartProduit, $rowId) use ($request){

            return $cartProduit->id === $request->id;
        });

        if ($duplicate->isNotEmpty()) {
            
            return redirect()->route('panier.index')->withSuccess('Ce produit existe déjà dans votre panier !');
        }

        Cart::add($request->id, $request->nom, 1, $request->prix)->associate('App\Model\Produit');

        return back()->withSuccess('Vous avez ajouté un produit au panier');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validate = Validator::make($request->all(), ['quantity' => 'required|numeric|between:1,10']);

        if($validate->fails()){

            session()->flash('error', 'La quantité doit être inférieur à 11.');
            return response()->json(['success' => false], 500);
        }

        Cart::update($id, $request->quantity);

       session()->flash('success', 'La quantité du produit mise à jour !');
        return response()->json(['success' => true]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Cart::remove($id);

        return back()->withSuccess('Un produit a été supprimé du panier !');
    }
}

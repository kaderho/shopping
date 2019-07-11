<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

//Route to Home
Auth::routes();
Route::get('admin', 'AdminController@index')->name('admin');

//Route to resource Commande
Route::resource('commande', 'CommandeController');
Route::get('admin/commande/traiter', 'CommandeController@commandeTraiter')->name('commande-traiter');
Route::get('admin/commande/valider/{commande}', 'CommandeController@valider')->name('validater');
Route::get('admin/commande/non-traiter', 'CommandeController@commandeNonTraiter')->name('commande-non-traiter');


//Route to Download PDF
Route::get('commande/facture/{id}', 'CommandeController@downloadPdf')->name('download-pdf');

//Route to resource Product
Route::resource('produit', 'ProduitController');
Route::get('admin/produit/disponible', 'ProduitController@produitDispo')->name('produit-dispo');
Route::get('admin/produit/indisponible', 'ProduitController@produitIndispo')->name('produit-indispo');

//Route to resource Client
Route::resource('client', 'ClientController');

//Route for import, export files Excel
Route::get('/export-excel/{disponible}', 'ProduitController@exportExcel')->name('export-excel');

Route::post('produit/import-excel', 'ProduitController@importExcel')->name('import-excel');

//Route to resource Parnier
Route::resource('panier', 'PanierController');

//Route to update cart
//Route::patch('panier/{produit}', 'PanierController@updateP')->name('panier.updateP');

//empty panier
Route::get('empty', function () {
    
    Cart::destroy();

    return redirect()->route('panier.index')->withSuccess('Parnier vidé !');
})->name('vider-panier');


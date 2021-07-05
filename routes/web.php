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


// Auth & compte & commandes

Auth::routes();

Route::get('/compte', 'HomeController@index')->name('home');
//route pour le pdf
Route::get('compte/facture/{order}', 'HomeController@invoice')->name('invoice');

// La boutique & gestion des items

Route::get('/', 'ItemController@index')->name('item.index');
Route::resource('item', 'ItemController')->except('index', 'show', 'create');

// Panier d'achat

Route::get('panier', 'CartController@index')->name('cart.index');
Route::get('ajouter/{item}', 'CartController@add')->name('cart.add');
Route::get('retirer/{item}', 'CartController@drop')->name('cart.drop');
Route::get('vider', 'CartController@clear')->name('cart.clear');

// paiement

Route::get('ckeckout', 'CartController@checkout')->name('cart.checkout');
Route::post('ckeckout', 'CartController@pay')->name('cart.pay');

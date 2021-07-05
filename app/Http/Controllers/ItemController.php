<?php

namespace App\Http\Controllers;

use App\Item;
use Illuminate\Http\Request;
use App\Http\Requests\StoreItem;
use App\Http\Requests\UpdateItem;
use Illuminate\Support\Facades\Storage;

class ItemController extends Controller
{
    public function __construct(){
      //on applique le middleware a toute les page excepté index (page d'accueil)
      $this->middleware('admin')->except('index');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Item::orderBy('id', 'desc')->get();

        return view('item.index', ['items' => $items]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreItem $request)
    {
        //var_dump($request->validated());
        extract($request->validated());

        $picture->store('public');

        $item = new Item();

        $item->name = $item_name;
        $item->price = $price;
        $item->picture = $picture->hashName();

        $item->save();

        return back()->withStatus('Produit mis en ligne !');

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function edit(Item $item)
    {
        return view('item.edit', ['item' => $item]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateItem $request, Item $item)
    {
      extract($request->validated());

      $item->name = $item_name;
      $item->price = $price;

      $item->save();

      return back()->withStatus('Produit mis à jour !');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function destroy(Item $item)
    {
        Storage::delete("public/$item->picture");

        $item->delete();

        return redirect()->route('home')->withStatus('Produit supprimé !');
    }
}

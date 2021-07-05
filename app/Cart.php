<?php

namespace App;

class Cart
{
    //ajouter un article au panier
    public static function add(Item $item)
    {
        $cart = session('cart', []);
        $cart_changed = false;

        foreach ($cart as &$item_cart) {
            if($item_cart['id'] === $item->id){
              //incrémenter la quantité, modifier le total et mettre à jour le panier
              $item_cart['quantity']++;
              $item_cart['total'] = $item_cart['price'] * $item_cart['quantity'];
              session()->put('cart', $cart);
              $cart_changed = true;
            }
        }

          //si l'article n'est pas dans le panier on le stocke dans la variable de session Cart
          if (!$cart_changed){
            self::store($item);
          }
    }

    private static function store(Item $item)
    {
      session()->push('cart', [
          'id' => $item->id,
          'picture' => $item->picture,
          'name' => $item->name,
          'price' => $item->price,
          'quantity' => 1,
          'total' => $item->price
      ]);
    }

    //décrémenter un article du panier
    public static function drop(Item $item)
    {
      $cart = session('cart', []);

      foreach ($cart as $key => &$item_cart) {
        if($item_cart['id'] === $item->id){
          if($item_cart['quantity'] === 1){
            session()->forget("cart.$key");
            return; //on sort du if
          }

          $item_cart['quantity']--;
          $item_cart['total'] = $item_cart['price'] * $item_cart['quantity'];
          session()->put('cart', $cart);
          return;

        }
      }
    }

    //vider le panier
    public static function clear()
    {
        session()->forget('cart');
    }

    public static function total()
    {
        $cart = session('cart', []);
        $total = 0;

        foreach ($cart as $item) {
            $total += $item['total'];
        }

        return $total;
    }
}

<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Item;
use App\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    //on affecte le middleware cart à nos méthodes
    public function __construct(){
      $this->middleware(['auth', 'cart'])->only('checkout', 'pay');
    }

    public function index()
    {
        //on récupère le contenu du panier d'achat et on le transmet à la vue
        $cart = session('cart', []);
        $total = Cart::total();

        return view('cart.index', ['cart' => $cart, 'total' => $total]);

    }

    public function add(Item $item)
    {
      Cart::add($item);

      return redirect()->route('cart.index');
    }

    public function drop(Item $item)
    {
      Cart::drop($item);

      return redirect()->route('cart.index');
    }

    public function clear()
    {
        Cart::clear();

        return back();
    }

    //acceder au formulaire de paiement
    public function checkout()
    {
        $total = Cart::total();

        return view('cart.checkout', ['total' => $total]);
    }

    //envoi du formulaire avec les coordonées bancaires
    public function pay(Request $request)
    {
        \Stripe\Stripe::setApiKey(env('STRIPE_SECRET_KEY'));

        $token = $request->stripeToken;

        $charge = \Stripe\Charge::create([
          'amount' => Cart::total(),
          'currency' => 'xof',
          'source' => $token
        ]);

        $order = new Order();

        $order->user_id = Auth::id();
        $order->charge_id = $charge->id;
        $order->order = json_encode(session('cart'));
        $order->total = Cart::total();

        $order->save();

        Cart::clear();

        return redirect()->route('home')->withStatus('Commande validée !');
    }
}

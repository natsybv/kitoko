<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Item;
use App\Order;
Use Barryvdh\DomPDF\Facade as PDF;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if(Auth::user()->role === 1){
          $items = Item::orderBy('id', 'desc')->get();
          return view('admin.home', ['items' => $items]);
        }
        //on retourne au membre normaux leurs commandes dans l'ordre décroissant
        $orders = Order::where('user_id', Auth::id())->orderBy('id', 'desc')->get();
        return view('home', ['orders' => $orders]);
    }

    public function invoice(Order $order){
      $user = Auth::user();

      if ($user->can('view', $order)){
          $pdf = PDF::loadView('pdf.invoice', [
              'user' => $user,
              'id' => $order->id,
              'date' => $order->created_at,
              'order' => json_decode($order->order),
              'total' => $order->total
          ]);

          return $pdf->download("facture_$order->created_at.pdf");
      }

      abort(403);
    }
}

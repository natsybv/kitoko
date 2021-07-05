<?php

namespace App\Policies;

use App\User;
use App\Order;
use Illuminate\Auth\Access\HandlesAuthorization;

//on donne l'accès aux membres qu'à ses propres factures
class OrderPolicy
{
    use HandlesAuthorization;

    //pour les admin
    public function before($user, $ability)
    {
        if ($user->role === 1){
          return true;
        }
    }

    public function view(User $user, Order $order)
    {
        //renvoie vrai si le user_id de la facture est égale à l'id de l'utilisateur connecté
        return $order->user_id === $user->id;
    }

}

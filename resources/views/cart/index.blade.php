@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
              @if ($cart)
                  <table class="table table-striped">
                    @foreach ($cart as $item)
                      <tr>
                        <td><img class="img-short" src="storage/{{$item['picture']}}" alt="{{ $item['picture'] }}"></td>
                          <td>{{ $item['name'] }}</td>
                          <td>@price($item['price'])</td>
                          <td><a href="{{ route('cart.drop', $item['id']) }}">-</a> {{ $item['quantity'] }} <a href="{{ route('cart.add', $item['id']) }}">+</a></td>
                          <td>@price($item['total'])</td>
                      </tr>
                    @endforeach
                      <tr>
                          <td colspan="3"></td>
                          <td class="font-weight-bold">@price($total)</td>
                      </tr>
                  </table>
                  <a class="btn btn-secondary" href="{{ route('cart.clear') }}">Vider le panier</a>
                  <a class="btn btn-success" href="{{ route('cart.checkout') }}">Payer @price($total)</a>
                @else
                  <div class="alert alert-primary">
                      Le panier est vide !
                  </div>
                @endif
            </div>
        </div>
    </div>
@endsection

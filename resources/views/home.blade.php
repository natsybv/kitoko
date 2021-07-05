@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
              @if (session('status'))
                <div class="alert alert-success">
                  {{ session('status') }}
                </div
              @endif
                <div class="card">
                    <div class="card-header">Factures</div>
                    <ul class="list-group list-group-flush">
                      @foreach ($orders as $order)
                        <li class="list-group-item"><a href=" {{ route('invoice', $order) }}">Commande du @datetime($order->created_at)</a></li>
                      @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection

@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
          @foreach ($items as $item)
            <div class="col-md-6 col-lg-4 mb-5">
                <article>
                    <img class="img-fluid" src="{{ asset("storage/$item->picture") }}" alt="{{ $item->picture }}">
                    <h1 class="h5 my-3"> {{ $item->name }} <small class="text-muted">@price($item->price)</small></h1>
                    <a class="btn btn-success" href="{{ route('cart.add', $item) }}">AJOUTER</a>
                </article>
            </div>
          @endforeach
        </div>
    </div>
@endsection

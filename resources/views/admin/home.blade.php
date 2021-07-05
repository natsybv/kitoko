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
              @foreach ($errors->all() as $error)
                <div class="alert alert-danger">
                  {{ $error }}
                </div>
              @endforeach
                <div class="card mb-5">
                    <div class="card-header">Ajouter un produit</div>
                    <ul class="card-body">
                        <form method="POST" action="{{ route('item.store') }}" enctype="multipart/form-data" novalidate>
                            @csrf
                            <div class="form-group">
                                <label for="name">Nom du produit</label>
                                <input type="text" name="item_name" value="{{ old('item_name') }}" id="name" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="price">Prix en FCFA</label>
                                <input type="number" name="price" value="{{ old('price') }}" id="price" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="picture">Image</label>
                                <input type="file" name="picture" id="picture" class="form-control-file">
                            </div>
                            <input class="btn btn-success" type="submit" value="Mettre en vente">
                        </form>
                    </ul>
                </div>
                <div class="card mb-5">
                    <div class="card-header">Produits en ligne</div>
                    <ul class="list-group list-group-flush">
                        @foreach ($items as $item)
                        <li class="list-group-item"><a href="{{ route('item.edit', $item) }}">{{ $item->name }}</a></li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection

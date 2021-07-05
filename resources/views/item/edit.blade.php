@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
              @if (session ('status'))
                <div class="alert alert-success">
                    {{ session('status')}}
                </div>
              @endif
              @foreach ($errors->all() as $error)
                <div class="alert alert-danger">
                  {{ $error }}
                </div>
              @endforeach
                <div class="card">
                    <div class="card-header">Modifier un produit</div>
                    <ul class="card-body">
                        <form method="POST" action="{{ route('item.update', $item) }}" novalidate>
                          @csrf
                          @method('put')
                            <div class="form-group">
                                <label for="name">Nom du produit</label>
                                <input type="text" name="item_name" value="{{ $item->name }}" id="name" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="price">Prix en FCFA</label>
                                <input type="number" name="price" value="{{ $item->price }}" id="price" class="form-control">
                            </div>
                            <input class="btn btn-success" type="submit" value="Mettre à jour">
                        </form>
                        <a class="btn btn-danger mt-3" href="" onclick="event.preventDefault(); document.getElementById('destroy').submit();">Supprimer</a>
                        <form id="destroy" action="{{ route('item.destroy', $item) }}" method="POST" style="display: none;">
                          @csrf
                          @method('delete')
                        </form>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection

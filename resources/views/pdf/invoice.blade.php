<!DOCTYPE html>
<html lang="fr">
<head>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
</head>
<body>
    <h1>Facture n° {{ $id }} du @datetime($date) </h1>
    <h2 class="mb-4">{{ $user->name }}</h2>
    <table class="table table-striped">
        <thead class="thead-dark">
            <tr>
                <th colspan="4">Commande</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($order as $item)
            <tr>
                <td>{{ $item->name }}</td>
                <td>@price($item->price)</td>
                <td> &nbsp;x{{ $item->quantity }}</td>
                <td>@price($item->total)</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <h3>Total : @price($total)</h3>
</body>
</html>

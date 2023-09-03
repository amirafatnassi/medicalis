@extends('layouat.layoutCoordinateur')
@section('contenu')
<form action="{{ url('coordinateur/dossiers/search') }}" method="GET">
    <div class="row">
        <div class="col-9">
            <div class="form-group">
                <input type="text" class="form-control" name="search" id="search" value="{{ old('search') }}" placeholder="Search by ID, Name or Last Name">
            </div>
        </div>
        <div class="col-3">
            <button type="submit" class="btn btn-primary">Search</button>
        </div>
    </div>
</form>

@if (isset($dossiers) && !empty($dossiers))
<h2>Search Results:</h2>
<table class="table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Last Name</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($dossiers as $dossier)
        <tr>
            <td>{{ $dossier->id }}</td>
            <td>{{ $dossier->nom }}</td>
            <td>{{ $dossier->prenom }}</td>
            <td>{{ $dossier->datenaissance }}</td>
            <td>
                @if ($dossier->dossierUsers->contains('user_id', Auth::user()->id))
                @if ($dossier->dossierUsers->where('user_id', Auth::user()->id)->first()->actif)
                <button class="btn btn-success" disabled>Access Granted</button>
                @else
                <a href="{{ route('coordinateur.dossier.request-access', ['id' => $dossier->id]) }}" class="btn btn-primary">Request Access</a>
                @endif
                @else
                <a href="{{ route('coordinateur.dossier.request-access', ['id' => $dossier->id]) }}" class="btn btn-primary">Request Access</a>
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endif
@endsection
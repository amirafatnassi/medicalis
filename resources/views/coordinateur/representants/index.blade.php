@extends('layouat.layoutCoordinateur')
@section('contenu')

<div class="card">
    <div class="card-header">
        <div class="card-title">Mes représentants</div>
    </div>
    <div class="card-body table-responsive">
        <table id="myTable" class="table table-striped">
            <tr>
                <td>Nom et prénom</td>
                <td>Role</td>
                <td>Tel</td>
                <td>E-mail</td>
                <td>Actions</td>
            </tr>
            @foreach($representants as $representant)
            <tr class="list-goup-item">
                <td><a href="{{url('coordinateur/representants/show',$representant->id)}}">{{$representant->prenom}} {{$representant->nom}}</a></td>
                <td>{{$representant->Role->lib}}</td>
                <td>{{$representant->tel}}</td>
                <td>{{$representant->email}}</td>
                <td>
                    @if ($representant->representingCoordinateur->isEmpty())
                    <form action="{{ route('coordinateur.activate.representant', $representant->id) }}" method="POST">
                        @csrf
                        <button class="btn btn-primary" type="submit">Activer</button>
                    </form>
                    @else
                    @if ($representant->representingCoordinateur->first()->actif)
                    <form action="{{ route('coordinateur.deactivate.representant', $representant->id) }}" method="POST">
                        @csrf
                        <button class="btn btn-danger" type="submit">Désactiver</button>
                    </form>
                    @else
                    <form action="{{ route('coordinateur.activate.representant', $representant->id) }}" method="POST">
                        @csrf
                        <button class="btn btn-primary" type="submit">Activer</button>
                    </form>
                    @endif
                    @endif
                </td>
            </tr>
            @endforeach

        </table>
    </div>
</div>
@endsection
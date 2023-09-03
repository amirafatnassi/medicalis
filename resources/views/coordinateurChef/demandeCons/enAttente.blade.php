@extends('menus.layoutCoordinateurChef')
@section('contenu')
<div class="card">
    <table class="table align-middle mb-0 bg-white">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Status demande</th>
                <th scope="col">ID Dossier</th>
                <th scope="col">Utilisateur</th>
                <th scope="col">Crée le</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($demandes as $demande)
            <tr class="fw-normal">
                <td>
                    <a href="{{url('coordinateurChef/demandeCons/demande/'.$demande->id)}}" class="btn btn-outline-primary">ID:{{$demande->id}}</a>
                </td>
                <td class="align-middle">
                    @if($demande->status_id===1) <span class="badge badge-danger rounded-pill d-inline">
                        @elseif($demande->status_id===2) <span class="badge badge-success rounded-pill d-inline">
                            @elseif($demande->status_id===3) <span class="badge badge-warning rounded-pill d-inline">
                                @elseif(($demande->status_id===4) || ($demande->status_id===5)) <span class="badge badge-secondary rounded-pill d-inline">
                                    @elseif($demande->status_id===6) <span class="badge badge-success rounded-pill d-inline">
                                        @endif {{$demande->status}}</span>
                </td>
                <td class="align-middle">{{$demande->dossier_id}}</td>
                <td class="align-middle">{{$demande->user}}</td>
                <td class="align-middle">{{$demande->created_at->format('d/m/Y H:m')  }}</td>
                <td class="align-middle">
                    <div class="row">
                        <form method="POST" action="{{url('coordinateurChef/prendre-en-charge/'.$demande->id)}}" enctype="multipart/form-data"> {{csrf_field()}}
                            <button class="btn btn-link" type="submit" data-md-toggle="tooltip" title="Prendre en charge">
                                <i data-feather="check"></i>
                            </button>
                        </form>
                        &nbsp;
                        <a class="btn btn-link" type="submit" data-md-toggle="tooltip" title="Affecter" href="{{url('coordinateurChef/demandeCons/'.$demande->id.'/affecter_cchef')}}">
                            <i data-feather="user"></i>
                        </a>
                    </div>

                </td>
            </tr>
            @empty<span class="badge badge-danger">Pas de demandes de consultations non traités pour le moment !</span>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
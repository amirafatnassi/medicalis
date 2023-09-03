@extends('menus.layoutCoordinateurChef')
@section('contenu')
<div class="card user-card">
    <div class="card-body">
        <div class="row">
            <div class="col-xl-6 col-lg-12 d-flex flex-column justify-content-between border-container-lg">
                <div class="user-avatar-section">
                    <div class="d-flex justify-content-start">
                        <img class="img-fluid rounded" src="{{asset('uploads/dossier/'.$dossier->image)}}" height="110" width="110" alt="avatar" />
                        <div class="d-flex flex-column ml-1">
                            <div class="user-info mb-1">
                                <h4 class="mb-0">Dossier médical n°: {{$dossier->id}}: {{$dossier->nom}} {{$dossier->prenom}}</h4>
                                <span class="card-text">{{$dossier->email}}</span>
                            </div>
                            <div class="d-flex flex-wrap">
                                <a href="{{url('coordinateurChef/dossiers/edit/'.$dossier->id)}}" class="btn btn-primary"> <i data-feather="edit-2"></i></a>
                                <a class="btn btn-outline-primary ml-1" href="">
                                    <i data-feather="printer"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-xl-6 col-lg-12 mt-2 mt-xl-0">
                <div class="user-info-wrapper">
                    <div class="d-flex flex-wrap my-50">
                        <div class="user-info-title">
                            <i data-feather="flag" class="mr-1"></i>
                            <span class="card-text user-info-title font-weight-bold mb-0">Pays: </span>
                        </div>
                        <p class="card-text mb-0">{{$dossier->pays}}</p>
                    </div>
                    <div class="d-flex flex-wrap">
                        <div class="user-info-title">
                            <i data-feather="phone" class="mr-1"></i>
                            <span class="card-text user-info-title font-weight-bold mb-0">Tel: </span>
                        </div>
                        <p class="card-text mb-0">{{$dossier->tel}}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="card">
    <div class="card-title">
        <h3>Demande de consultation n° {{$demandeCons->id}}</h3>
    </div>
    <div class="card-header">
        <ul class="timeline">
            <div><b><u>ID:</b></u>{{$demandeCons->id}}</div>
            <div><u><b>Status:</b></u>
                @if($demandeCons->status_id===1) <span class="badge badge-danger rounded-pill d-inline">
                    @elseif($demandeCons->status_id===2) <span class="badge badge-success rounded-pill d-inline">
                        @elseif($demandeCons->status_id===3) <span class="badge badge-warning rounded-pill d-inline">
                            @elseif(($demandeCons->status_id===4) || ($demandeCons->status_id===5)) <span class="badge badge-secondary rounded-pill d-inline">
                                @elseif($demandeCons->status_id===6) <span class="badge badge-success rounded-pill d-inline">
                                    @endif
                                    {{$demandeCons->status}} </span>
            </div>
            <div><u><b>Coordinateur en charge:</b></u> {{$demandeCons->coordinateurEnCharge}}</div>
            <div><u><b>Objet: {{$demandeCons->objet}}</b></u></div>
            <div><u><b>Observation:</b></u></div>
            <div>{!!$demandeCons->observation!!}</div>
        </ul>
    </div>
    <div class="card-body">
        <a class="btn btn-outline-primary" type="submit" data-md-toggle="tooltip" title="Demande infos complémentaires" href="{{url('coordinateurChef/demandeCons/'.$demandeCons->id.'/enAttenteInfos')}}">
            <i data-feather="help-circle"></i> Demande infos complémentaires
        </a>
        <table class="table align-middle mb-0 bg-white">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Status demande</th>
                    <th scope="col">Observation</th>
                    <th scope="col">Utilisateur</th>
                </tr>
            </thead>
            <tbody>
                @forelse($demandes as $demande)
                <tr class="fw-normal">
                    <th>
                        <a href="{{url('coordinateurChef/demandeCons/demande_infos/'.$demande->id)}}" class="btn btn-outline-primary">ID:{{$demande->id}}</a>
                    </th>
                    <td class="align-middle">
                        @if($demande->status_id===1) <span class="badge badge-danger rounded-pill d-inline">
                            @elseif($demande->status_id===2) <span class="badge badge-success rounded-pill d-inline">
                                @elseif($demande->status_id===3) <span class="badge badge-warning rounded-pill d-inline">
                                    @elseif(($demande->status_id===4) || ($demande->status_id===5)) <span class="badge badge-secondary rounded-pill d-inline">
                                        @elseif($demande->status_id===6) <span class="badge badge-success rounded-pill d-inline">
                                            @endif {{$demande->status}}</span>
                    </td>
                    <td class="align-middle">{!!$demande->observation!!}</td>
                    <td class="align-middle">{{$demande->user}}</td>
                </tr>
                @empty<span class="badge badge-danger">Liste de demandes d'informations vide !</span>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
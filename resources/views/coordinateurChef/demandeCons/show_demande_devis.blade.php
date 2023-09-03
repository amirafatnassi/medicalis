@extends('menus.layoutCoordinateurChef')
@section('contenu')
<div class="card user-card">
    <div class="card-body">
        <div class="row">
            <div class="col-xl-6 col-lg-12 d-flex flex-column justify-content-between border-container-lg">
                <div class="user-avatar-section">
                    <div class="d-flex justify-content-start">
                        <img class="img-fluid rounded" src="{{asset('uploads/dossier/'.$dossier->image)}}" height="50px" width="50px" alt="avatar" />
                        <div class="d-flex flex-column ml-1">
                            <div class="user-info mb-1">
                                <h4 class="mb-0">Dossier médical n°: {{$dossier->id}}: {{$dossier->nom}} {{$dossier->prenom}}</h4>
                                <span class="card-text">{{$dossier->email}}</span>
                            </div>
                            <div class="d-flex flex-wrap">
                                <a href="" class="btn btn-primary">
                                    <i data-feather="edit-2"></i>
                                </a>
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
<h3>Demande de devis n° {{$demande_devis->id}}</h3>
<div class="card">
    <div class="card-body">
        <ul class="timeline">
            <div class="row">
                <b><u>Type de demande:</u></b>
                {{$demande_devis->type_demande}}
            </div>
            <div class="row">
                <b><u>Objet:</u></b>
                {{$demande_devis->objet}}
            </div>
            <div class="row">
                <b><u>Observation:</u></b>
            </div>
            <div>{!!$demande_devis->observation!!}</div>
            <div class="row">
                <b><u>Status demande:</u></b>
                @if($demande_devis->status_id===1) <span class="badge badge-pill badge-light-danger mr-1">
                    @elseif($demande_devis->status_id===2) <span class="badge badge-pill badge-light-success mr-1">
                        @elseif($demande_devis->status_id===3) <span class="badge badge-pill badge-light-warning mr-1">
                            @elseif(($demande_devis->status_id===4) || ($demande_devis->status_id===5)) <span class="badge badge-pill badge-light-secondary mr-1">
                                @elseif($demande_devis->status_id===6) <span class="badge badge-pill badge-light-success mr-1">
                                    @elseif($demande_devis->status_id===9) <span class="badge badge-pill badge-light-success mr-1">
                                        @endif {{$demande_devis->status}}</span>
            </div>
        </ul>
    </div>
</div>
@endsection
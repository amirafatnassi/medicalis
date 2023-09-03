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
<h3>Demande de consultation n° {{$demande_consultation->id}}</h3>
<div class="card">
    <div class="card-body">
        <ul class="timeline">
            <div class="row">
                <i data-feather="bookmark"></i> <b><u> Patient: </u></b> {{$demande_consultation->dossier_id}}
            </div>
            @if(!is_null($demande_consultation->coordinateurEnCharge))
            <div class="row">
                <i data-feather="user"></i> <b><u> Coordinateur en charge: </u></b> {{$demande_consultation->coordinateurEnCharge}}
            </div>
            @endif
            <div class="row">
                <i data-feather="star"></i> <u><b>Type demande:</b></u> {{$demande_consultation->type_demande}}
            </div>
            <div class="row">
                <i data-feather="star"></i> <u><b>Objet:</b></u> {{$demande_consultation->objet}}
            </div>
            <div class="row">
                <i data-feather="menu"></i><b><u>Observation:</u></b>
            </div>
            <div>{!!$demande_consultation->observation!!}</div>
            <div class="row"> <i data-feather="info"></i>
                <b><u>Status demande:</u></b>
                @if($demande_consultation->status_id===1) <span class="badge badge-pill badge-light-danger mr-1">
                    @elseif($demande_consultation->status_id===2) <span class="badge badge-pill badge-light-success mr-1">
                        @elseif($demande_consultation->status_id===3) <span class="badge badge-pill badge-light-warning mr-1">
                            @elseif(($demande_consultation->status_id===4) || ($demande_consultation->status_id===5)) <span class="badge badge-pill badge-light-secondary mr-1">
                                @elseif($demande_consultation->status_id===6) <span class="badge badge-pill badge-light-success mr-1">
                                    @elseif($demande_consultation->status_id===9) <span class="badge badge-pill badge-light-success mr-1">
                                        @endif {{$demande_consultation->status}} </span>
                                    @if($demande_consultation->coordinateur_en_charge===Auth::user()->id)
                                    @if($demande_consultation->status_id===1)
                                    <form method="POST" action="{{url('coordinateurChef/prendre-en-charge/'.$demande_consultation->id)}}" enctype="multipart/form-data"> {{csrf_field()}}
                                        <button class="btn btn-link" type="submit" data-md-toggle="tooltip" title="Prendre en charge">
                                            <i data-feather="check"></i> Prendre en charge
                                        </button>
                                    </form>
                                    @elseif($demande_consultation->status_id===2)
                                    <div class="row">
                                        <form method="GET" action="{{url('coordinateurChef/demandeCons/'.$demande_consultation->id.'/demande-devis')}}" enctype="multipart/form-data"> {{csrf_field()}}
                                            <button class="btn btn-link" type="submit" data-md-toggle="tooltip" title="Lancer demande devis">
                                                <i data-feather="pen-tool"></i> Lancer demande devis
                                            </button>
                                        </form>
                                        &nbsp;
                                        <a class="btn btn-link" data-md-toggle="tooltip" title="Demande infos complémentaires" href="{{url('coordinateurChef/demandeCons/'.$demande_consultation->id.'/enAttenteInfos')}}">
                                            <i data-feather="help-circle"></i>Demande informations complémentaires
                                        </a>
                                    </div>
                                    @elseif(($demande_consultation->status_id===3)||($demande_consultation->status_id===9))
                                    <div class="row">
                                        <form method="GET" action="{{url('coordinateurChef/demandeCons/'.$demande_consultation->id.'/demande-devis')}}" enctype="multipart/form-data"> {{csrf_field()}}
                                            <button class="btn btn-link" type="submit" data-md-toggle="tooltip" title="Lancer demande devis">
                                                <i data-feather="pen-tool"></i> Lancer demande devis
                                            </button>
                                        </form>
                                        &nbsp;
                                        <a class="btn btn-link" type="submit" data-md-toggle="tooltip" title="Ré-affecter" href="{{url('coordinateurChef/demandeCons/'.$demande_consultation->id.'/affecter')}}">
                                            <i data-feather="corner-down-right"></i> Ré-affecter
                                        </a>
                                        &nbsp;
                                        <form method="POST" action="{{url('coordinateurChef/demandeCons/'.$demande_consultation->id.'/cloturer')}}" enctype="multipart/form-data"> {{csrf_field()}}
                                            <button class="btn btn-link" type="submit" data-mdb-toggle="tooltip" title="Cloturer">
                                                <i data-feather="lock"></i> Cloturer
                                            </button>
                                        </form>
                                        &nbsp;
                                        <a class="btn btn-link" data-md-toggle="tooltip" title="Liste demandes infos complémentaires" href="{{url('coordinateurChef/demandeCons/'.$demande_consultation->id.'/liste_demandes_infos')}}">
                                            <i data-feather="list"></i> Liste demandes infos complémentaires
                                        </a>
                                    </div>
                                    @elseif(($demande_consultation->status_id===4)||($demande_consultation->status_id===5))
                                    @elseif($demande_consultation->status_id===6)
                                    <div class="row">
                                        <form method="GET" action="{{url('coordinateurChef/demandeCons/'.$demande_consultation->id.'/demande-devis')}}" enctype="multipart/form-data"> {{csrf_field()}}
                                            <button class="btn btn-link" type="submit" data-md-toggle="tooltip" title="Lancer demande devis">
                                                <i data-feather="pen-tool"></i> Lancer demande devis
                                            </button>
                                        </form>
                                        &nbsp;
                                        <a class="btn btn-link" type="submit" data-md-toggle="tooltip" title="Demande infos complémentaires" href="{{url('coordinateurChef/demandeCons/'.$demande_consultation->id.'/enAttenteInfos')}}">
                                            <i data-feather="help-circle"></i> Demande infos complémentaires
                                        </a>
                                        &nbsp;
                                        <a class="btn btn-link" type="submit" data-md-toggle="tooltip" title="Ré-affecter" href="{{url('coordinateurChef/demandeCons/'.$demande_consultation->id.'/affecter')}}">
                                            <i data-feather="corner-down-right"></i> Ré-affecter
                                        </a>
                                        &nbsp;
                                        <form method="POST" action="{{url('coordinateurChef/demandeCons/'.$demande_consultation->id.'/cloturer')}}" enctype="multipart/form-data"> {{csrf_field()}}
                                            <button class="btn btn-link" type="submit" data-md-toggle="tooltip" title="Cloturer">
                                                <i data-feather="lock"></i> Cloturer
                                            </button>
                                        </form>
                                    </div>
                                    @endif
                                    @endif
            </div>
            @if(
            (!$demandes_devis->isEmpty())
            &&
            (($demande_consultation->status_id===2)||($demande_consultation->status_id===3)||($demande_consultation->status_id===6))
            )
            <div class="col-12">
                <table class="table align-middle mb-0 bg-white">
                    <thead>
                        <tr>
                            <td>ID</td>
                            <td>Type de demande</td>
                            <td>Objet</td>
                            <td>Status</td>
                            <td>Observation</td>
                            <td>Utilisateur</td>
                            <td>Date et heure</td>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($demandes_devis as $d)
                        <tr>
                            <td>
                                <a href="{{url('coordinateurChef/demandeDevis/'.$d->id.'/show')}}" class="btn btn-outline-primary">ID:{{$d->id}}</a>
                            </td>
                            <td>{{$d->type_demande}}</td>
                            <td>{{$d->objet}}</td>
                            <td>
                                @if($d->status_id===1) <span class="badge badge-pill badge-light-danger mr-1">
                                    @elseif($d->status_id===2) <span class="badge badge-pill badge-light-success mr-1">
                                        @elseif($d->status_id===3) <span class="badge badge-pill badge-light-warning mr-1">
                                            @elseif(($d->status_id===4) || ($d->status_id===5)) <span class="badge badge-pill badge-light-secondary mr-1">
                                                @elseif($d->status_id===6) <span class="badge badge-pill badge-light-secondary mr-1">
                                                    @elseif($d->status_id===9) <span class="badge badge-pill badge-light-success mr-1">
                                                        @endif {{$d->status}}</span>
                            </td>
                            <td>{!!$d->observation!!}</td>
                            <td>{{$d->prenom}} {{$d->nom}}</td>
                            <td>{{$d->created_at}}</td>
                        </tr>
                        @empty<span class="badge badge-danger">Liste de demandes de devis vide !</span>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @endif
        </ul>
    </div>
</div>
@endsection
@extends('menus.layoutRepresentant')
@section('contenu')
<div class="card user-card">
    <div class="card-body">
        <div class="row">
            <div class="col-xl-6 col-lg-12 d-flex flex-column justify-content-between border-container-lg">
                <div class="user-avatar-section">
                    <div class="d-flex justify-content-start">
                        @if($dossier->image!==null)
                        <img src=" {{asset('uploads/dossier/'.$dossier->image)}}" class="rounded img-fluid" height="400" width="105">
                        @else
                        <img class="rounded img-fluid" alt="Card image" src="{{asset('uploads/dossier/user.png')}}" height="400" width="105">
                        @endif
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
<div class="card">
    <h3 class="card-header">Demande de consultation n° {{$demande->id}}:</h3>
    <div class="card-body">
        <ul class="timeline">
            <div class="row">
                <i data-feather="bookmark"></i> <b><u> Dossier: </u></b> {{$demande->dossier_id}}
            </div>
            <div class="row">
                <i data-feather="star"></i> <b><u> Objet: </u></b> {{$demande->objet}}
            </div>
            @if(!is_null($demande->coordinateurEnCharge))
            <div class="row">
                <i data-feather="user"></i> <b><u> Coordinateur en charge: </u></b> {{$demande->coordinateurEnCharge}}
            </div>
            @endif
            <div class="row">
                <i data-feather="menu"></i><b><u>Observation:</u></b>
            </div>
            <div>{!!$demande->observation!!}</div>
            <div class="row">
                <i data-feather="info"></i> <b><u> Status: </u></b>
                <div class="col-4">
                    @if($demande->status_id===1) <span class="badge badge-pill badge-light-danger mr-1">
                        @elseif($demande->status_id===2) <span class="badge badge-pill badge-light-success mr-1">
                            @elseif($demande->status_id===3) <span class="badge badge-pill badge-light-warning mr-1">
                                @elseif(($demande->status_id===4) || ($demande->status_id===5)) <span class="badge badge-pill badge-light-secondary mr-1">
                                    @elseif($demande->status_id===6) <span class="badge badge-pill badge-light-success mr-1">
                                        @elseif($demande->status_id===7) <span class="badge badge-pill badge-light-success mr-1">
                                            @elseif($demande->status_id===8) <span class="badge badge-pill badge-light-success mr-1">
                                                @elseif($demande->status_id===9) <span class="badge badge-pill badge-light-success mr-1">
                                                    @endif {{$demande->status}}</span>
                </div>
            </div>
            @if(!$files->isEmpty())
            <div class="row"><b><u>Liste de téléchargement:</u></b></div>
            @foreach($files as $f)
            <div class="row">
                <a href="{{url('/uploads/demandeCons/'.$f->downloads)}}"><i data-feather="paperclip"></i> {{$f->downloads}}</a>
            </div>
            @endforeach
            @endif
            <div class="row"><b><u>Date de création: </u></b>{{date('d/m/Y',strtotime($demande->created_at))}} </div>
            <div class="row"><b><u>Dernière mise à jour: </u></b>{{date('d/m/Y',strtotime($demande->updated_at))}}</div>
            <div class="row"><b> <u>Saisie par:</b></u> {{$demande->user}}</b></div>
        </ul>
    </div>
    <div class="card-footer">
        @if(($demande->status_id===1)||($demande->status_id===2))
        <form method="POST" action="{{url('representant/demandeCons/'.$demande->id.'/cloturer')}}" enctype="multipart/form-data"> {{csrf_field()}}
            <button class="btn btn-link" type="submit" data-mdb-toggle="tooltip" title="Cloturer">
                <i data-feather="lock"></i> Cloturer
            </button>
        </form>
        @elseif($demande->status_id===3)
        <div class="row">
            <form method="POST" action="{{url('representant/demandeCons/'.$demande->id.'/edit')}}" enctype="multipart/form-data"> {{csrf_field()}}
                <button class="btn btn-link" type="submit" data-md-toggle="tooltip" title="Edit">
                    <i data-feather="edit"></i> Edit
                </button>
            </form>
            &nbsp;
            <form method="POST" action="{{url('representant/demandeCons/'.$demande->id.'/cloturer')}}" enctype="multipart/form-data"> {{csrf_field()}}
                <button class="btn btn-link" type="submit" data-mdb-toggle="tooltip" title="Cloturer">
                    <i data-feather="lock"></i> Cloturer
                </button>
            </form>
            &nbsp;
            <a class="btn btn-link" data-md-toggle="tooltip" title="Liste demandes infos complémentaires" href="{{url('representant/demandeCons/'.$demande->id.'/liste_demandes_infos')}}">
                <i data-feather="list"></i> Liste demandes infos complémentaires
            </a>
        </div>
        @elseif(($demande->status_id===4)||($demande->status_id===5))
        @elseif($demande->status_id===6)
        <div class="row">
            <form method="POST" action="{{url('representant/demandeCons/'.$demande->id.'/cloturer')}}" enctype="multipart/form-data"> {{csrf_field()}}
                <button class="btn btn-link" type="submit" data-md-toggle="tooltip" title="Cloturer">
                    <i data-feather="lock"></i> Cloturer
                </button>
            </form>
        </div>
        @endif
    </div>
</div>
@endsection
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
    <h3>Demande de devis n° {{$devis->id}}</h3>
<div class="card">
    <ul>
        <li><u><b>Status:</b></u> <span class="badge badge-pill badge-light-danger mr-1"> {{$devis->status}}</span></li>
        <li><u><b>Type de demande de devis:</b></u> {{$devis->type_demande}}</li>
        <li><u><b>Objet:</b></u> {{$devis->objet}}</li>
        <li>
            <div><u><b>Observation:</b></u></div>
            <div> {!!$devis->observation!!}</div>
        </li>
        <li><u><b>Utilisateur:</b></u> {{$devis->utilisateur}}</li>
        <li><u><b>Date de création:</b></u> {{date('d/m/Y',strtotime($devis->created_at))}}</li>
        <div class="align-middle">
            @if(($devis->downloads)!==0)
            <b><u>Liste de téléchargement:</u></b>
            @foreach($files as $f)
            <div class="row">
                <a href="{{url('/uploads/demandeDevis/'.$f->downloads)}}"><i data-feather="paperclip"></i> {{$f->downloads}}</a>
            </div>
            @endforeach
            @endif
        </div>

    </ul>
    <h5><u><b>Liste de destinataires:</b></u></h5>
    <ul>
        @foreach($destinataires as $d)
        <li>{{$d->display_name}}</li>
        @endforeach
    </ul>
    <div class="card-footer">
        <div class="row">
            <form method="POST" action="{{url('coordinateurChef/demandeDevis/'.$devis->id.'/storeDemandeDevis')}}" enctype="multipart/form-data"> {{csrf_field()}}
                <button class="btn btn-primary" type="submit">
                    Confirmer
                </button>
            </form>
            &nbsp;
            <form method="POST" action="{{url('coordinateurChef/demandeDevis/'.$devis->id.'/annulerDemandeDevis')}}" enctype="multipart/form-data"> {{csrf_field()}}
                <button class="btn btn-primary" type="submit">
                    Annuler
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
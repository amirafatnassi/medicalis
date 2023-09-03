@extends('layouat.layoutCoordinateur')
@section('contenu')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-6">
                <div class="user-avatar-section">
                    <div class="d-flex justify-content-start">
                        <img class="img-fluid rounded" src="{{asset('uploads/dossier/'.$dossier->image)}}" height="60px" width="60px" alt="avatar" />
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
            <div class="col-6">
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
    <div class="card-header">
        <div class="card-title">Demande de devis n°: {{$devis->id}}</div>
    </div>
    <div class="card-body">
        <ul>
            <div class="row"><b><u>ID:</u></b> {{$devis->id}}</div>
            <div class="row"><b><u>Status:</u></b>
                @if($devis->status_id===1) <span class="badge badge-roundede badge-light-danger mr-1">
                    @endif {{$devis->status}}</span>
            </div>
            <div class="row"><b><u>Type de demande de devis:</u></b> {{$devis->type_demande}}</div>
            <div class="row"><b><u>Objet:</u></b> {{$devis->objet}}</div>
            <div class="row"><b><u>Observation:</u></b></div>
            <div>{!!$devis->observation!!}</div>
            <div class="row"><b><u>Utilisateur:</u></b> {{$devis->utilisateur}}</div>
            <div class="row"><b><u>Date de création:</u></b> {{date('d/m/Y H:m',strtotime($devis->created_at))}}</div>
            @if(!$files->isEmpty())
            <div class="row"><b><u>Liste de téléchargement:</u></b></div>
            @foreach($files as $f)
            <div class="row">
                <a href="{{url('/uploads/demandeDevis/'.$f->downloads)}}"><i data-feather="paperclip"></i> {{$f->downloads}}</a>
            </div>
            @endforeach
            @endif
        </ul>
        <h5>Liste de destinataires:</h5>
        <ul>
            @foreach($destinataires as $d)
            <li>{{$d->display_name}}</li>
            @endforeach
        </ul>
    </div>
    <div class="card-footer">
        <div class="row">
            <form method="POST" action="{{url('coordinateur/demandeDevis/'.$devis->id.'/storeDemandeDevis')}}" enctype="multipart/form-data"> {{csrf_field()}}
                <button class="btn btn-primary" type="submit">
                    Confirmer
                </button>
            </form>
            &nbsp;
            <form method="POST" action="{{url('coordinateur/demandeDevis/'.$devis->id.'/annulerDemandeDevis')}}" enctype="multipart/form-data"> {{csrf_field()}}
                <button class="btn btn-primary" type="submit">
                    Annuler
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
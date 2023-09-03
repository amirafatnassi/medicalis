@extends('menus.layoutRepresentant')
@section('contenu')
<div class="card user-card">
    <div class="card-body">
        <div class="row">
            <div class="col-xl-6 col-lg-12 d-flex flex-column justify-content-between border-container-lg">
                <div class="user-avatar-section">
                    <div class="d-flex justify-content-start">
                        <img class="img-fluid rounded" src="{{asset('uploads/dossier/'.$dossier->image)}}" height="55px" width="55px" alt="avatar" />
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
        <h3>Demande d'information n° {{$demandeInfos->id}}</h3>
        <div class="align-middle">
            <b><u>Status:</u></b>
            @if($demandeInfos->status_id===1) <span class="badge badge-danger rounded-pill d-inline">
                @elseif($demandeInfos->status_id===2) <span class="badge badge-success rounded-pill d-inline">
                    @elseif($demandeInfos->status_id===3) <span class="badge badge-warning rounded-pill d-inline">
                        @elseif(($demandeInfos->status_id===4) || ($demandeInfos->status_id===5)) < class="badge badge-secondary rounded-pill d-inline">
                            @elseif($demandeInfos->status_id===6) <span class="badge badge-success rounded-pill d-inline">
                                @endif {{$demandeInfos->status}}</span>
        </div>
        <div class="align-middle"><u><b>Observation:</b></u></div>
        <div class="align-middle">{{$demandeInfos->observation}}</div>
        <div class="align-middle"><b><u>Crée par:</u></b> {{$demandeInfos->user}}</div>
        <div class="align-middle">
            @if(($demandeInfos->downloads)!==0)
            <b><u>Liste de téléchargement:</u></b>
            @foreach($files as $f)
            <div class="row">
                <a href="{{url('/uploads/demandeInfos/'.$f->downloads)}}"><i data-feather="paperclip"></i> {{$f->downloads}}</a>
            </div>
            @endforeach
            @endif
        </div>

        <form method="POST" action="{{url('representant/demandeInfos/storeRep')}}" enctype="multipart/form-data"> {{csrf_field()}}
            <label for="observation"><b>Rapport:</b></label>
            <textarea class="form-control" id="observation" name="observation" placeholder="observation" cols="30" rows="10">{{old('observation') }}</textarea>
            <div class="alert alert-warning alert-dismissible fade show" role="alert" id="msg" hidden>
                Le rapport est obligatoire !
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="col-12">
                <label for="file"><b>Pièce jointe:</b></label>
                <div class="input-group">
                    <div class="custom-file">
                        <input type="file" name="filesup[]" class="custom-file-input" multiple id="fileup">
                        <label class="custom-file-label" id="filename">Choisir fichier</label>
                    </div>
                </div>
            </div>
            <input type="text" value="{{$demandeInfos->id}}" class="form-control" name="demande_infos_id" hidden>
            <button class="btn btn-primary" type="submit" data-md-toggle="tooltip" title="Prendre en charge">
                <i data-feather="check"></i> Répondre
            </button>
        </form>
    </div>
</div>
<script>
    CKEDITOR.replace('observation');
</script>
@endsection
@extends('layouat.layaoutPatient')
@section('contenu')

<div class="card">
    <div class="card-header">
        <div class="card-title">Demande de consultation n° {{$demandeCons->id}}: {{$demandeCons->objet}}</div>
    </div>
    <div class="card-body">
        <div class="align-middle">
            <i data-feather="bookmark"></i> <b><u> Dossier: </u></b> {{$demandeCons->dossier_id}}
        </div>
        @if($demandeCons->coordinateur_en_charge)
        <div class="align-middle">
            <i data-feather="user"></i> <b><u> Coordinateur en charge: </u></b> {{$demandeCons->coordinateurEnCharge->prenom}} {{$demandeCons->coordinateurEnCharge->nom}}
        </div>
        @endif
        <div class="align-middle">
            <i data-feather="menu"></i><b><u>Observation:</u></b>
        </div>
        <div>{!!$demandeCons->observation!!}</div>
        <div class="align-middle">
            <i data-feather="info"></i> <b><u> Status: </u></b>
            @switch($demandeCons->status_id)
            @case(1) <span class="badge badge-pill badge-light-danger mr-1">{{$demandeCons->Status->lib}}</span>
            @break
            @case(2) <span class="badge badge-pill badge-light-success mr-1">{{$demandeCons->Status->lib}}</span>
            @break
            @case(3) <span class="badge badge-pill badge-light-warning mr-1">{{$demandeCons->Status->lib}}</span>
            @break
            @case(4) <span class="badge badge-pill badge-light-secondary mr-1">{{$demandeCons->Status->lib}}</span>
            @break
            @case(5) <span class="badge badge-pill badge-light-secondary mr-1">{{$demandeCons->Status->lib}}</span>
            @break
            @case(6) <span class="badge badge-pill badge-light-success mr-1">{{$demandeCons->Status->lib}}</span>
            @break
            @case(7) <span class="badge badge-pill badge-light-success mr-1"> {{$demandeCons->Status->lib}}</span>
            @break
            @case(8) <span class="badge badge-pill badge-light-success mr-1"> {{$demandeCons->Status->lib}}</span>
            @break
            @case(9) <span class="badge badge-pill badge-light-success mr-1"> {{$demandeCons->Status->lib}}</span>
            @break
            @case(10) <span class="badge badge-pill badge-light-success mr-1"> {{$demandeCons->Status->lib}}</span>
            @break
            @default {{$demandeCons->Status->lib}} @break
            @endswitch
        </div>
        @if($demandeCons->files->count()>0)
        <div class="card">
            <div class="card-header">
                <div class="card-title">Liste de téléchargement:</div>
            </div>
            <div class="card-body">
                @foreach($demandeCons->files as $f)
                <div class="row">
                    <a href="{{url('/uploads/demandeCons/'.$f->downloads)}}"><i data-feather="paperclip"></i> {{$f->downloads}}</a>
                </div>
                @endforeach
            </div>
        </div>
        @endif
        <div class="align-middle"><b><u>Date de création: </u></b>{{date('d/m/Y',strtotime($demandeCons->created_at))}} </div>
        <div class="align-middle"><b><u>Dernière mise à jour: </u></b>{{date('d/m/Y',strtotime($demandeCons->updated_at))}}</div>
        <div class="align-middle"><b> <u>Saisie par:</b></u> {{$demandeCons->createdBy->prenom}} {{$demandeCons->createdBy->nom}}</b></div>
        </ul>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <div class="card-title">Demande d'information n° {{$demandeInfos->id}}</div>
    </div>
    <div class="card-body row">
        <div class="col-12">
            <b><u>Status:</u></b>
            @switch($demandeInfos->status_id)
            @case(1) <span class="badge badge-danger rounded-pill d-inline">{{$demandeInfos->status->lib}}</span> @break
            @case(2) <span class="badge badge-success rounded-pill d-inline">{{$demandeInfos->status->lib}}</span> @break
            @case(3) <span class="badge badge-warning rounded-pill d-inline">{{$demandeInfos->status->lib}}</span> @break
            @case(4) <span class="badge badge-secondary rounded-pill d-inline">{{$demandeInfos->status->lib}}</span> @break
            @case(5) <span class="badge badge-secondary rounded-pill d-inline">{{$demandeInfos->status->lib}}</span> @break
            @case(6) <span class="badge badge-success rounded-pill d-inline">{{$demandeInfos->status->lib}}</span> @break
            @case(7) <span class="badge badge-success rounded-pill d-inline">{{$demandeInfos->status->lib}}</span> @break
            @case(8) <span class="badge badge-success rounded-pill d-inline">{{$demandeInfos->status->lib}}</span> @break
            @default {{$demandeInfos->Status->lib}} @break
            @endswitch
        </div>
        <div class="col-12"><u><b>Observation:</b></u></div>
        <div class="col-12">{!!$demandeInfos->observation!!}</div>
        <div class="col-12">
            @if($demandeInfos->files->count()>0)
            @foreach($demandeInfos->files as $f)
            <div class="col-12">
                <a href="{{url('/uploads/demandeInfos/'.$f->downloads)}}"><i data-feather="paperclip"></i> {{$f->downloads}}</a>
            </div>
            @endforeach
            @endif
        </div>
        <div class="col-12"><b><u>Crée par:</u></b> {{$demandeInfos->createdBy->prenom}} {{$demandeInfos->createdBy->nom}}</div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <div class="card-title">Réponse</div>
    </div>
    <form method="POST" action="{{url('patient/demandeInfos/storeRep')}}" enctype="multipart/form-data"> {{csrf_field()}}
        <div class="card-body">
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
        </div>
        <div class="card-footer">
            <button class="btn btn-primary" type="submit" data-md-toggle="tooltip" title="Prendre en charge">
                <i data-feather="send"></i> Répondre
            </button>
        </div>
    </form>

</div>
<script>
    CKEDITOR.replace('observation');
</script>
@endsection
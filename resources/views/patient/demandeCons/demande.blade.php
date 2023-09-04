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
            @case(6) <span class="badge badge-pill badge-light-success mr-1">{{$demandeCons->Status->lib}}</span>
            @break
            @case(7) <span class="badge badge-pill badge-light-success mr-1"> {{$demandeCons->Status->lib}}</span>
            @break
            @case(8) <span class="badge badge-pill badge-light-success mr-1"> {{$demandeCons->Status->lib}}</span>
            @break
            @case(9) <span class="badge badge-pill badge-light-success mr-1"> {{$demandeCons->Status->lib}}</span>
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

@if($demandeInfos)
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
@endif

@if($repDemandeInfos)
<div class="card">
    <div class="card-header">
        <div class="card-title">Réponse à la demande d'information n° {{$repDemandeInfos->id}}</div>
    </div>
    <div class="card-body">
        <div class="align-middle"><u><b>Observation:</b></u></div>
        <div class="align-middle">{!!$repDemandeInfos->observation!!}</div>
        <div class="align-middle"><b><u>Crée par:</u></b> {{$repDemandeInfos->user}}</div>
        <div class="card">
            @if($repDemandeInfos->files->count()>0)
            <div class="card-header">
                <div class="card-title">Liste de téléchargement:</div>
            </div>
            <div class="card-body">
                @foreach($repDemandeInfos->files as $f)
                <div class="row">
                    <a href="{{url('/uploads/repDemandeInfos/'.$f->downloads)}}"><i data-feather="paperclip"></i> {{$f->downloads}}</a>
                </div>
                @endforeach
            </div>
            @endif
        </div>
    </div>
</div>
@endif

<div class="card">
    @switch($demandeCons->status_id)
    @case(1)
    @case(2)
    @case(6)
    @case(9)
    <div class="row card-body">
        <form method="POST" action="{{url('patient/demandeCons/'.$demandeCons->id.'/cloturer')}}" enctype="multipart/form-data"> {{csrf_field()}}
            <button class="btn btn-link" type="submit" data-mdb-toggle="tooltip" title="Cloturer">
                <i data-feather="lock"></i> Cloturer
            </button>
        </form>
    </div>
    @break
    @case(3)
    <div class="row card-body">
        <a class="btn btn-link" href="{{url('patient/demandeInfos/repondre/'.$demandeInfos->id)}}" type="button" data-md-toggle="tooltip" title="Edit">
            <i data-feather="edit"></i> Répondre
        </a>
        <form method="POST" action="{{url('patient/demandeCons/'.$demandeCons->id.'/cloturer')}}" enctype="multipart/form-data"> {{csrf_field()}}
            <button class="btn btn-link" type="submit" data-mdb-toggle="tooltip" title="Cloturer">
                <i data-feather="lock"></i> Cloturer
            </button>
        </form>
    </div>
    @break
    @case(8)
    <div class="row card-body">
        <a href="{{url('patient/devis/'.$demandeCons->genInvoice->id.'/show')}}" class="btn btn-link">
            <i data-feather="eye"></i> afficher devis
        </a>
        <form method="POST" action="{{url('patient/demandeCons/'.$demandeCons->id.'/cloturer')}}" enctype="multipart/form-data"> {{csrf_field()}}
            <button class="btn btn-link" type="submit" data-md-toggle="tooltip" title="Cloturer">
                <i data-feather="lock"></i> Cloturer
            </button>
        </form>
    </div>
    @break
    @default @break
    @endswitch
</div>
@endsection
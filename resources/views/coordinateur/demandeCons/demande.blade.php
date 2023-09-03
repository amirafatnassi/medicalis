@extends('layouat.layoutCoordinateur')
@section('contenu')
<div class="card user-card">
    <div class="card-body row">
        <div class="col-6">
            <div class="user-avatar-section">
                <div class="d-flex justify-content-start">
                    <img class="img-fluid rounded" src="{{asset('uploads/users/'.($dossier->user->image??'user.png'))}}" height="55px" width="55px" alt="avatar" />
                    <div class="d-flex flex-column ml-1">
                        <div class="user-info mb-1">
                            <h4 class="mb-0">Dossier médical n°: {{$dossier->id}}: {{$dossier->user->prenom}} {{$dossier->user->nom}}</h4>
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
                    <p class="card-text mb-0">{{$dossier->user->Country->lib}}</p>
                </div>
                <div class="d-flex flex-wrap">
                    <div class="user-info-title">
                        <i data-feather="phone" class="mr-1"></i>
                        <span class="card-text user-info-title font-weight-bold mb-0">Tel: </span>
                    </div>
                    <p class="card-text mb-0">{{$dossier->user->tel}}</p>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="card">
    <div class="card-header">
        <div class="card-title"> Demande de consultation n° {{$demande->id}}: {{$demande->objet}}</div>
    </div>
    <div class="card-body">
        <div class="align-middle">
            <i data-feather="bookmark"></i> <b><u> Patient: </u></b> {{$demande->dossier->id}}: {{$demande->dossier->user->prenom}} {{$demande->dossier->user->nom}}
        </div>
        @if($demande->coordinateurEnCharge)
        <div class="align-middle">
            <i data-feather="user"></i> <b><u> Coordinateur en charge: </u></b> @if($demande->coordinateur_en_charge)
            {{$demande->coordinateurEnCharge->prenom}} {{$demande->coordinateurEnCharge->nom}}
            @endif
        </div>
        @endif
        <div class="align-middle">
            <i data-feather="star"></i> <u><b>Type demande:</b></u> {{$demande->TypeDemande->lib}}
        </div>
        <div class="align-middle">
            <i data-feather="menu"></i><b><u>Observation:</u></b>
        </div>
        <div class="align-middle">{!!$demande->observation!!}</div>
        <div class="align-middle">
            <i data-feather="info"></i>
            <b><u>Status demande:</u></b>
            @switch($demande->status->id)
            @case(1) <span class="badge badge-rounded badge-light-danger mr-1"> {{$demande->status->lib}}</span> @break
            @case(2) <span class="badge badge-rounded badge-light-success mr-1"> {{$demande->status->lib}}</span> @break
            @case(3) <span class="badge badge-rounded badge-light-warning mr-1"> {{$demande->status->lib}}</span> @break
            @case(4) <span class="badge badge-rounded badge-light-secondary mr-1"> {{$demande->status->lib}}</span> @break
            @case(6) <span class="badge badge-rounded badge-light-success mr-1"> {{$demande->status->lib}}</span> @break
            @case(8) <span class="badge badge-rounded badge-light-success mr-1"> {{$demande->status->lib}}</span> @break
            @case(9) <span class="badge badge-rounded badge-light-success mr-1"> {{$demande->status->lib}}</span> @break
            @default {{$demande->status->lib}} @break
            @endswitch
        </div>

        @if($demande->files->count()>0)
        <div class="card">
            <div class="card-header">
                <div class="card-title">Liste de téléchargement:</div>
            </div>
            <div class="card-body">
                @foreach($demande->files as $f)
                <div class="row">
                    <a href="{{url('/uploads/demandeCons/'.$f->downloads)}}"><i data-feather="paperclip"></i> {{$f->downloads}}</a>
                </div>
                @endforeach
            </div>
        </div>
        @endif

        <div class="align-middle"><b><u>Date de création: </u></b>{{date('d/m/Y',strtotime($demande->created_at))}} </div>
        <div class="align-middle"><b><u>Dernière mise à jour: </u></b>{{date('d/m/Y',strtotime($demande->updated_at))}}</div>
        <div class="align-middle"><b><u>Saisie par:</b></u> {{$demande->createdBy->prenom}} {{$demande->createdBy->nom}}</div>

        @php
        $allowedStatusIds = [2, 3, 6];
        $hasDemandeDevis = $demande->demandeDevis->count() > 0;
        $isStatusAllowed = in_array($demande->status_id, $allowedStatusIds);
        @endphp

        @if ($hasDemandeDevis && $isStatusAllowed)
        <div class="table-responsive">
            <table class="table align-middle mb-0 bg-white">
                <thead>
                    <tr>
                        <td>Objet</td>
                        <td>Type de demande</td>
                        <td>Status</td>
                        <td>Utilisateur</td>
                        <td>Date et heure</td>
                    </tr>
                </thead>
                <tbody>
                    @forelse($demande->demandeDevis as $d)
                    <tr>
                        <td>
                            <a href="{{url('coordinateur/demandeDevis/'.$d->id.'/show')}}">{{$d->objet}}</a>
                        </td>
                        <td>@if($d->type_demande_id){{$d->typeDemande->lib}}@endif</td>
                        <td>
                            @switch($d->status_id)
                            @case(1) <span class="badge badge-rounded badge-light-danger mr-1"> {{$d->status->lib}}</span> @break
                            @case(2) <span class="badge badge-rounded badge-light-success mr-1"> {{$d->status->lib}}</span> @break
                            @case(3) <span class="badge badge-rounded badge-light-warning mr-1"> {{$d->status->lib}}</span> @break
                            @case(4) <span class="badge badge-rounded badge-light-secondary mr-1"> {{$d->status->lib}}</span>@break
                            @case(5) <span class="badge badge-rounded badge-light-secondary mr-1"> {{$d->status->lib}}</span>@break
                            @case(6) <span class="badge badge-rounded badge-light-success mr-1"> {{$d->status->lib}}</span>@break
                            @case(7) <span class="badge badge-rounded badge-light-warning mr-1"> {{$d->status->lib}}</span>@break
                            @case(9) <span class="badge badge-rounded badge-light-success mr-1"> {{$d->status->lib}}</span>@break
                            @default {{$d->status->lib}} @break
                            @endswitch
                        </td>
                        <td> {{$d->createdBy->prenom}} {{$d->createdBy->nom}}</td>
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
            @case(8) <span class="badge badge-success rounded-pill d-inline">{{$demandeInfos->status->lib}}</span> @break
            @default {{$demandeInfos->status->lib}} @break
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
        <div class="card-title">Réponse à la demande d'informations n° {{$repDemandeInfos->id}}</div>
    </div>
    <div class="card-body">
        <div class="align-middle"><u><b>Observation:</b></u></div>
        <div class="align-middle">{!!$repDemandeInfos->observation!!}</div>
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
        <div class="align-middle"><b><u>Crée par:</u></b> {{$repDemandeInfos->createdBy->prenom}} {{$repDemandeInfos->createdBy->nom}}</div>
    </div>
</div>
@endif

@php
$isCoordinateurNull = $demande->coordinateur_en_charge === null;
$isCurrentUserCoordinateur = $demande->coordinateur_en_charge === Auth::user()->id;
$statusId = $demande->status_id;
@endphp

@if ($isCoordinateurNull && $statusId === 1)
<div class="card">
    <form method="POST" action="{{url('coordinateur/prendre-en-charge/'.$demande->id)}}" enctype="multipart/form-data">
        {{csrf_field()}}
        <button class="btn btn-link" type="submit" data-md-toggle="tooltip" title="Prendre en charge">
            <i data-feather="check"></i> Prendre en charge
        </button>
    </form>
</div>
@elseif ($isCurrentUserCoordinateur && in_array($statusId, [2, 3, 6, 7, 8, 9]))
<div class="card">
    <div class="card-body">
        <div class="btn-group" role="group">
            <form method="GET" action="{{url('coordinateur/demandeCons/'.$demande->id.'/demande-devis')}}" enctype="multipart/form-data">
                {{csrf_field()}}
                <button class="btn btn-link" type="submit" data-md-toggle="tooltip" title="Lancer demande devis">
                    <i data-feather="pen-tool"></i> Lancer demande devis
                </button>
            </form>
            @if($demande->genInvoices->count() > 0)
            <a href="{{url('coordinateur/devis/'.$demande->genInvoices->first()->id.'/show')}}" class="btn btn-link">
                <i data-feather="eye"></i> afficher devis
            </a>
            @else
            <a href="{{url('coordinateur/devis/'.$demande->id.'/create')}}" class="btn btn-link">
                <i data-feather="edit-3"></i> Rédiger votre devis
            </a>
            @endif
            <a class="btn btn-link" type="submit" data-md-toggle="tooltip" title="Ré-affecter" href="{{url('coordinateur/demandeCons/'.$demande->id.'/affecter')}}">
                <i data-feather="corner-down-right"></i> Ré-affecter
            </a>
            <form method="POST" action="{{url('coordinateur/demandeCons/'.$demande->id.'/cloturer')}}" enctype="multipart/form-data">
                {{csrf_field()}}
                <button class="btn btn-link" type="submit" data-mdb-toggle="tooltip" title="Cloturer">
                    <i data-feather="lock"></i> Cloturer
                </button>
            </form>
            @if (in_array($statusId, [2, 6]))
            <a class="btn btn-link" type="submit" data-md-toggle="tooltip" title="Demande infos complémentaires" href="{{url('coordinateur/demandeCons/'.$demande->id.'/enAttenteInfos')}}">
                <i data-feather="help-circle"></i> Demande infos complémentaires
            </a>
            @endif
        </div>
    </div>
</div>
@endif
@endsection
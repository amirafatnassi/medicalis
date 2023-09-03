@extends('layouat.layoutCoordinateur')
@section('contenu')
<div class="card">
    <div class="card-body row">
        <div class="col-6">
            <div class="user-avatar-section">
                <div class="d-flex justify-content-start">
                    <img class="img-fluid rounded" src="{{asset('uploads/users/'.($dossier->user->image??'user.png'))}}" height="105" width="105" alt="avatar" />
                    <div class="d-flex flex-column ml-1">
                        <div class="user-info mb-1">
                            <h4 class="mb-0">Dossier médical n°: {{$dossier->id}}: {{$dossier->user->prenom}} {{$dossier->user->nom}}</h4>
                            <span class="card-text">{{$dossier->user->email}}</span>
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
        <div class="card-title">Demande devis n° {{$demande_devis->id}}</div>
    </div>
    <div class="card-body">
        <div class="col-12">
            <b><u>Type de demande:</u></b> {{$demande_devis->type_demande}}
        </div>
        <div class="col-12">
            <b><u>Objet:</u></b> {{$demande_devis->objet}}
        </div>
        <div class="col-12">
            <b><u>Observation:</u></b>
        </div>
        <div>{!!$demande_devis->observation!!}</div>
        <div class="col-12">
            <b><u>Status demande:</u></b>
            @switch($demande_devis->status_id)
            @case(1) <span class="badge badge-rounded badge-danger mr-1"> {{$demande_devis->status->lib}}</span> @break
            @case(2) <span class="badge badge-rounded badge-success mr-1"> {{$demande_devis->status->lib}}</span> @break
            @case(3) <span class="badge badge-rounded badge-warning mr-1"> {{$demande_devis->status->lib}}</span> @break
            @case(4) <span class="badge badge-rounded badge-secondary mr-1"> {{$demande_devis->status->lib}}</span>@break
            @case(5) <span class="badge badge-rounded badge-secondary mr-1"> {{$demande_devis->status->lib}}</span>@break
            @case(6) <span class="badge badge-rounded badge-success mr-1"> {{$demande_devis->status->lib}}</span>@break
            @case(7) <span class="badge badge-rounded badge-warning mr-1"> {{$demande_devis->status->lib}}</span>

            @php
            $invoicesCount = $demande_devis->invoices->count();
            $destinatairesCount = $demande_devis->destinataires->count();
            @endphp

            <span class="badge badge-rounded
                @if ($invoicesCount < $destinatairesCount) badge-light-danger
                @elseif ($invoicesCount === $destinatairesCount) badge-light-success
                @else badge-light-warning
                @endif
                mr-1">
                @if ($invoicesCount === $destinatairesCount)
                Tout le monde a répondu:
                @else
                En attente de réponses:
                @endif
                {{$invoicesCount}} / {{$destinatairesCount}}
            </span>
            @break
            @case(9) <span class="badge badge-rounded badge-success mr-1"> {{$demande_devis->status}}</span>@break
            @default {{$demande_devis->status}} @break
            @endswitch
        </div>
        <div class="col-12"><b><u>Date de création: </u></b>{{date('d/m/Y',strtotime($demande_devis->created_at))}} </div>
        <div class="col-12"><b><u>Dernière mise à jour: </u></b>{{date('d/m/Y',strtotime($demande_devis->updated_at))}}</div>
        <div class="col-12"><b> <u>Saisie par:</b></u> {{$demande_devis->createdBy->prenom}} {{$demande_devis->createdBy->prenom}}</div>

        @if($demande_devis->destinataires->count()>0)
        <div class="card-body">
            <b><u>Destinataires</u></b>
            @foreach($demande_devis->destinataires as $destinataire)
            <div class="col-12">
                <i data-feather="user" class="mr-1"></i> {{$destinataire->prenom}} {{$destinataire->nom}}
                @php
                $invoice = $destinataire->invoices->where('demande_devis_id', $demande_devis->id)->first();
                @endphp
                @if ($invoice)
                <a href="{{ url('coordinateur/devis/'.$invoice->id.'/show') }}" class="ml-2">
                    <i data-feather="eye"></i> Afficher devis
                </a>
                @endif
            </div>
            @endforeach
        </div>
        @endif
    </div>
</div>

@endsection
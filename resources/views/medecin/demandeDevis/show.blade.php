@extends('layouat.layaoutMedecin')
@section('contenu')
<div class="card">
    <div class="card-header">
        <div class="card-title">Demande devis n° {{$demandeDevis->id}}: {{$demandeDevis->objet}}</div>
    </div>
    <div class="card-body">
        <ul class="timeline">
            <div class="row">
                <b><u>Type de demande:</u></b>
                {{$demandeDevis->type_demande}}
            </div>
            <div class="row">
                <b><u>Observation:</u></b>
            </div>
            <div>{!!$demandeDevis->observation!!}</div>
            <div class="row">
                <b><u>Status demande: </u></b>
                @php
                $statusBadges = [
                1 => ['class' => 'badge-light-danger'],
                2 => ['class' => 'badge-light-success'],
                3 => ['class' => 'badge-light-warning'],
                4 => ['class' => 'badge-light-secondary'],
                5 => ['class' => 'badge-light-secondary'],
                6 => ['class' => 'badge-light-success'],
                7 => ['class' => 'badge-light-success'],
                8 => ['class' => 'badge-light-success'],
                9 => ['class' => 'badge-light-success'],
                ];
                @endphp

                @if(array_key_exists($demandeDevis->status_id, $statusBadges))
                <span class="badge badge-pill {{ $statusBadges[$demandeDevis->status_id]['class'] }} mr-1">
                    {{ $demandeDevis->status->lib}}
                </span>
                @endif
            </div>
            <div class="row">
                <b><u>Crée par:</u></b> {{$demandeDevis->createdBy->prenom}} {{$demandeDevis->createdBy->nom}}
            </div>
            <div class="row">
                <b><u>Crée le:</u></b> {{$demandeDevis-> created_at->format('d/m/y h:i')}}
            </div>
        </ul>
    </div>
    <div class="card-footer">
        <div class="row">
            <div class="col">
                <a href="{{url('medecin/dossiers/show/'.$demandeDevis->dossier_id)}}" class="btn btn-outline-primary">
                    <i data-feather="bookmark"></i> Consulter dossier patient:: {{$demandeDevis->demandeConsultation->dossier_id}}
                </a>
            </div>
            <div class="col">
                @if($invoice)
                <div><a href="{{url('medecin/devis/show-invoice/'.$invoice->id)}}" class="btn btn-primary"><i data-feather="eye"></i> afficher devis</a></div>
                @else
                <div><a href="{{url('medecin/devis/'.$demandeDevis->id.'/create')}}" class="btn btn-primary"><i data-feather="plus"></i> Rédiger devis</a></div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
@extends('layouat.layaoutMedecin')
@section('contenu')
<div class="card">
    <div class="card-header">
        <div class="card-title">Liste des demande devis</div>
    </div>
    <table class="table" id="myTable">
        <thead>
            <tr>
                <th style="width:15%">Objet</th>
                <th style="width:15%">Date</th>
                <th style="width:15%">Status</th>
                <th style="width:15%">Objet</th>
                <th style="width:15%">Dossier</th>
                <th style="width:25%">Envoyé par</th>
            </tr>
        </thead>
        <tbody>
            @foreach($demande_devis as $d)
            <tr>
                <td><a href="{{url('medecin/demandeDevis/show/'.$d->id)}}">{{$d->objet}}</a></td>
                <td>{{date('d/m/Y h:s', strtotime($d->created_at))}}</td>
                <td>
                    @php
                    $statusBadges = [
                    1 => ['class' => 'badge-light-danger'],
                    3 => ['class' => 'badge-light-warning'],
                    4 => ['class' => 'badge-light-secondary'],
                    5 => ['class' => 'badge-light-secondary'],
                    6 => ['class' => 'badge-light-success'],
                    7 => ['class' => 'badge-light-success'],
                    8 => ['class' => 'badge-light-success'],
                    9 => ['class' => 'badge-light-success'],
                    ];
                    @endphp

                    @if(array_key_exists($d->status_id, $statusBadges))
                    <span class="badge badge-pill {{ $statusBadges[$d->status_id]['class'] }} mr-1">
                        {{ $d->status->lib}}
                    </span>
                    @endif
                </td>
                <td>{{$d->objet}}</td>
                <td>
                    <a href="{{url('medecin/dossiers/show/'.$d->demandeConsultation->dossier_id)}}">{{$d->demandeConsultation->dossier_id}}</a>
                </td>
                <td>
                    <h5>{{$d->createdBy->prenom}} {{$d->createdBy->nom}}</h5>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
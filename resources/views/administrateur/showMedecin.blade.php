@extends('layouat.layoutAdmin')
@section('contenu')
<div class="card">
    <div class="card-header">
        <div class="card-title">Informations Médecin: </div>
    </div>
    <ul class="timeline">
        <li class="list-group-item">
            <div class="row">
                <div class="col"><b>Patient: </b>{{$Medecin->prenom}} {{$Medecin->nom}}@if(!is_null($Medecin->sexe)) ( {{$Medecin->Sexe->lib}} ) @endif</div>
                <div class="col"><b>Date de naissance: </b>{{date('d/m/Y',strtotime($Medecin->datenaissance))}}</div>
                <div class="col"><b>Lieu de naissance: </b>{{$Medecin->lieunaissance}}</div>
            </div>
        </li>
        <li class="list-group-item">
            <div class="row">
                <div class="col">@if($Medecin->tel) <b>Tel: </b>{{$Medecin->tel}}@endif</div>
                <div class="col">@if($Medecin->contactdurgence) <b>Contact d'urgence: </b>{{$Medecin->contactdurgence}}@endif</div>
            </div>
        </li>
        <li class="list-group-item">
            <div class="row">
                <div class="col">@if($Medecin->country_id) <b>Pays: </b>{{$Medecin->Country->lib}}@endif</div>
                <div class="col">@if($Medecin->ville_id) <b>Ville: </b>{{$Medecin->Ville->name}}@endif</div>
                <div class="col">@if($Medecin->cp) <b>Code postal: </b>{{$Medecin->cp}}@endif</div>
            </div>
        </li>
        <li class="list-group-item">
            <div class="row">
                <div class="col">@if($Medecin->specialite_id) <b>Spécialité: </b>{{$Medecin->Specialite->lib}}@endif</div>
            </div>
        </li>
        @if($Medecin->organisme_id)
        <li class="list-group-item">
            <div class="row">
                <div class="col"> <b>Organisme: </b>{{$Medecin->Organisme->lib}}</div>
            </div>
        </li>
        @endif
        @if ($Medecin->email)
        <li class="list-group-item">
            <b>E-mail: </b><a href="{{url('mailto:'.$Medecin->email)}}">{{$Medecin->email}}</a>
            @if($Medecin->hasVerifiedEmail())
            <span class="badge badge-pill badge-light-success mr-1">Email vérifié</span>
            @else
            <span class="badge badge-pill badge-light-danger mr-1">Email non vérifié</span>
            @endif
        </li>
        @endif
    </ul>
    <div class="card-footer">
        @if($Medecin->hasVerifiedEmail())
        <a class="btn btn-primary mr-1" href="{{ url('administrateur/approuverMedecin/'.$Medecin->id) }}"><i data-feather="check"></i> Approuver</a>
        @else
        <a class="btn btn-primary mr-1 disabled" href="#"><i data-feather="check"></i> Approuver</a>
        @endif
        <a class="btn btn-danger" href="{{url('administrateur/annulerMedecins/'.$Medecin->id.'/')}}"><i data-feather="x"></i> Annuler</a>
    </div>
</div>
@endsection
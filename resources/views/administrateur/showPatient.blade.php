@extends('layouat.layoutAdmin')
@section('contenu')
<div class="card">
    <div class="card-header">
        <div class="card-title">Informations Patient: </div>
    </div>
    <ul class="timeline">
        <li class="list-group-item">
            <div class="row">
                <div class="col"><b>Patient: </b>{{$Patient->prenom}} {{$Patient->nom}}@if(!is_null($Patient->sexe)) ( {{$Patient->Sexe->lib}} ) @endif</div>
                <div class="col"><b>Date de naissance: </b>{{date('d/m/Y',strtotime($Patient->datenaissance))}}</div>
                <div class="col"><b>Lieu de naissance: </b>{{$Patient->lieunaissance}}</div>
            </div>
        </li>
        <li class="list-group-item">
            <div class="row">
                <div class="col">@if($Patient->profession) <b>Profession: </b>{{$Patient->Profession->lib}}@endif</div>
                <div class="col">@if($Patient->tel) <b>Tel: </b>{{$Patient->tel}}@endif</div>
            </div>
        </li>
        <li class="list-group-item">
            <div class="row">
                <div class="col">@if($Patient->country_id) <b>Pays: </b>{{$Patient->country->lib}}@endif</div>
                <div class="col">@if($Patient->ville_id) <b>Ville: </b>{{$Patient->Ville->name}}@endif</div>
                <div class="col">@if($Patient->cp) <b>Code postal: </b>{{$Patient->cp}}@endif</div>
            </div>
        </li>
        @if ($Patient->email)
        <li class="list-group-item">
            <b>E-mail: </b><a href="{{url('mailto:'.$Patient->email)}}">{{$Patient->email}}</a>
            @if($Patient->hasVerifiedEmail())
            <span class="badge badge-pill badge-light-success mr-1">Email vérifié</span>
            @else
            <span class="badge badge-pill badge-light-danger mr-1">Email non vérifié</span>
            @endif
        </li>
        @endif
    </ul>
    <div class="card-footer">
        @if($Patient->hasVerifiedEmail())
        <a class="btn btn-primary mr-1" href="{{ url('administrateur/approuverPatients/'.$Patient->id) }}"><i data-feather="check"></i> Approuver</a>
        @else
        <a class="btn btn-primary mr-1 disabled" href="#"><i data-feather="check"></i> Approuver</a>
        @endif
        <a class="btn btn-danger" href="{{url('administrateur/annulerPatients/'.$Patient->id.'/')}}"><i data-feather="x"></i> Annuler</a>
    </div>
</div>
@endsection
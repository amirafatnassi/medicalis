@extends('layouat.layaoutPatient')
@section('contenu')

<div class="card">
    <div class="card-header">
        <div class="card-title">{{$medecin->prenom}} {{$medecin->nom}}</div>
    </div>
    <div class="card-body row">
        @if($medecin->organisme_id)
        <div class="col-12"><b>Organisme: </b> {{$medecin->Organisme->lib}}</div>
        @endif
        <div class="col-12"><b>Spécialité :</b>{{$medecin->Specialite->lib}}</div>
        <div class="col-12">
            <b><i data-feather="map-pin"></i> Adresse :</b> 
            {{$medecin->rue}} @if($medecin->ville_id){{$medecin->Ville->name}}@endif {{$medecin->cp}} {{$medecin->Country->lib}}</div>
        <div class="col-12"><b><i data-feather="phone"></i> Tel :</b> {{$medecin->tel}}</div>
        <div class="col-12"><b><i data-feather="at-sign"></i> E-mail :</b> <a href="{{url('mailto:'.$medecin->email)}}">{{$medecin->email}}</a></div>
    </div>
</div>
@endsection
@extends('layouat.layoutPatientNoHeader')
@section('contenu')
<div class="card">
    <div class="card-body row justify-content-center">
        <div class="col-4 ">
            <img src="{{asset('uploads/users/'.($patient->image??'user.png'))}}" class="rounded img-fluid" alt="Card image" />
            <a href="{{ url('patient/editMonProfil')}}" class="btn btn-block btn-primary mt-1"> <i data-feather="pen-tool"></i></a>
        </div>

        <div class="col-8">
            <div class="col-12"><b>ID: </b>{{$patient->id}}</div>
            <div class="col-12"><b>Nom et Prénom: </b>{{$patient->nom}} {{$patient->prenom}}</div>
            <div class="col-12"><b>Sexe: </b>{{$patient->Sexe->lib}}</div>
            <div class="col-12"><b>Date de naissance: </b>{{date('d/m/Y',strtotime($patient->datenaissance))}}</div>
            <div class="col-12"><b>Lieu de naissance: </b>{{$patient->lieunaissance}}</div>
            <div class="col-12"><b>E-mail: </b>{{$patient->email}}</div>
            <div class="col-12"><b>N°Tel: </b>{{$patient->tel}}</div>
            <div class="col-12"><b>Pays: </b>{{$patient->country->lib }} ({{$patient->country->code}})</div>
            <div class="col-12"><b>Adresse: </b>{{$patient->rue}} {{$patient->cp}} {{ $patient->Ville->name ?? '' }}</div>
            <div class="col-12"><b>Login: </b>{{$patient->login}}</div>
            <div class="col-12"><b>Crée le: </b>{{date('d/m/Y',strtotime($patient->created_at))}}</div>
            <div class="col-12"><b>Mis à jour le: </b>{{date('d/m/Y',strtotime($patient->updated_at))}}</div>
            <div class="col-12"><a href="{{url('patient/editmdp/'.$patient->id)}}" class="btn btn-primary">Modifier Mot de passe</a></div>
        </div>
    </div>
</div>
@endsection
@extends('layouat.layaoutMedecin')
@section('contenu')
<div class="row">
    <div class="col-2">
        <div class="position-relative">
            <div class="profile-img-container d-flex align-items-center">
                <div class="profile-img">
                    <img src="{{ asset('uploads/users/'.($medecin->image ??'user.png')) }}" class="rounded img-fluid" alt="Card image" />
                </div>
            </div>
            <div class="row">
                <a href="{{ url('medecin/editMonProfil')}}" class="btn btn-block btn-primary">
                    <i data-feather="edit-3"></i>
                </a>
            </div>
        </div>
    </div>
    <div class="card col-10">
        <div class="card-body row">
            <div class="col-12">
                <h5 class="mb-75">ID: {{$medecin->id}}</h5>
            </div>
            <div class="col-12">
                <h5 class="mb-75">Nom et Prénom: {{$medecin->nom}} {{$medecin->prenom}}</h5>
            </div>
            <div class="col-12">
                <h5 class="mb-75">Sexe: {{$medecin->Sexe->lib}}</h5>
            </div>
            <div class="col-12">
                <h5 class="mb-75">Spécialité: {{$medecin->Specialite->lib}}</h5>
            </div>
            <div class="col-12">
                <h5 class="mb-75">Url PACS: {{$medecin->url_pacs}}</h5>
            </div>
            <div class="col-12">
                <h5 class="mb-75">Url Bio: {{$medecin->url_pacs}}</h5>
            </div>
            <div class="col-12">
                <h5 class="mb-75">E-mail: {{$medecin->email}}</h5>
            </div>
            <div class="col-12">
                <h5 class="mb-75">Tel: {{$medecin->tel}}</h5>
            </div>
            <div class="col-12">
                <h5 class="mb-50">Pays: {{$medecin->Country->lib}}</h5>
            </div>
            <div class="col-12">
                <h5 class="mb-50">Adresse: {{$medecin->rue}} {{$medecin->cp}} @if($medecin->ville_id){{$medecin->Ville->name}}@endif</h5>
            </div>
            <div class="col-12">
                <h5>Crée le: </b>{{$medecin->created_at}}</h5>
            </div>
            <div class="col-12">
                <h5>Mis à jour le: </b>{{$medecin->updated_at}}</h5>
            </div>
        </div>
        <div class="card-footer">
            <a href="{{url('medecin/editmdp/'.$medecin->id)}}" class="btn btn-primary">Modifier Mot de passe</a>
        </div>
    </div>
</div>
@endsection
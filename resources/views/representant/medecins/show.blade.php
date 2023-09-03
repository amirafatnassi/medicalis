@extends('menus.layoutRepresentant')
@section('contenu')
<div class="row">
    <div class="col-3">
        <div class="position-relative">
            <div class="profile-img-container d-flex align-items-center">
                <div class="profile-img">
                    <img src="{{asset('uploads/medecin/'.$medecin->image)}}" class="rounded img-fluid" alt="Card image" />
                </div>
            </div>
        </div>
    </div>
    <div class="col-9">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <h5 class="mb-75">ID: {{$medecin->id}}</h5>
                    </div>
                    <div class="col-12">
                        <h5 class="mb-75">Nom et Prénom: {{$medecin->prenom}} {{$medecin->nom}}</h5>
                    </div>
                    <div class="col-12">
                        <h5 class="mb-75">Sexe: {{$medecin->sexe}}</h5>
                    </div>
                    <div class="col-12">
                        <h5 class="mb-75">Spécialité: {{$medecin->specialite}}</h5>
                    </div>
                    <div class="col-12">
                        <h5 class="mb-75">Organisme: {{$medecin->organisme}}</h5>
                    </div>
                    <div class="col-12">
                        <h5 class="mb-75">Url PACS: {{$medecin->url_pacs}}</h5>
                    </div>
                    <div class="col-12">
                        <h5 class="mb-75">Url Bio: {{$medecin->url_bio}}</h5>
                    </div>
                    <div class="col-12">
                        <h5 class="mb-75">E-mail: {{$medecin->email}}</h5>
                    </div>
                    <div class="col-12">
                        <h5 class="mb-75">N°Tel: {{$medecin->tel}}</h5>
                    </div>
                    <div class="col-12">
                        <h5 class="mb-50">Pays: {{$medecin->pays}}</h5>
                    </div>
                    <div class="col-12">
                        <h5 class="mb-50">Adresse: {{$medecin->rue}} {{$medecin->cp}} {{$medecin->ville}}</h5>
                    </div>
                    <div class="col-12">
                        <h5>Crée le: </b>{{$medecin->created_at}}</h5>
                    </div>
                    <div class="col-12">
                        <h5>Mis à jour le: </b>{{$medecin->updated_at}}</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
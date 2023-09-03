@extends('layouat.layoutCoordinateur')
@section('contenu')
<div class="row">
    <div class="col-3">
        <div class="position-relative">
            <div class="profile-img-container d-flex align-items-center">
                <div class="profile-img">
                    <img src="{{asset('uploads/users/'.($medecin->image??'user.png'))}}" class="rounded img-fluid" alt="Card image" />
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
                        <h5 class="mb-75">Sexe: {{$medecin->Sexe->lib}}</h5>
                    </div>
                    <div class="col-12">
                        <h5 class="mb-75">Spécialité: {{$medecin->Specialite->lib}}</h5>
                    </div>
                    <div class="col-12">
                        <h5 class="mb-75">Organisme: @if($medecin->organisme_id){{$medecin->Organisme->lib}}@endif</h5>
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
                        <h5 class="mb-50">Pays: {{$medecin->Country->lib}}</h5>
                    </div>
                    <div class="col-12">
                        <h5 class="mb-50">Adresse: {{$medecin->rue}} {{$medecin->cp}} @if($medecin->ville_id){{$medecin->Ville->name}}@endif</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
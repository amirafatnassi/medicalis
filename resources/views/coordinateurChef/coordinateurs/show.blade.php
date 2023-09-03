@extends('layouat.layoutCoordinateurChef')
@section('contenu')
<div class="row">
    <div class="col-2">
        <div class="position-relative">
            <div class="profile-img-container d-flex align-items-center">
                <div class="profile-img">
                    <img src="{{ asset('uploads/users/'.($coordinateur->image ??'user.png')) }}" class="rounded img-fluid" alt="Card image" />
                </div>
            </div>
        </div>
    </div>
    <div class="card col-10">
        <div class="card-body row">
            <div class="col-12">
                <h5 class="mb-75">ID: {{$coordinateur->id}}</h5>
            </div>
            <div class="col-12">
                <h5 class="mb-75">Nom et Prénom: {{$coordinateur->prenom}} {{$coordinateur->nom}}</h5>
            </div>
            <div class="col-12">
                <h5 class="mb-75">Role: {{$coordinateur->Role->lib}}</h5>
            </div>
            <div class="col-12">
                <h5 class="mb-75">E-mail: {{$coordinateur->email}}</h5>
            </div>
            <div class="col-12">
                <h5 class="mb-75">N°Tel: {{$coordinateur->tel}}</h5>
            </div>
            <div class="col-12">
                <h5 class="mb-50">Pays: @if($coordinateur->country_id){{$coordinateur->Country->lib}}@endif</h5>
            </div>
            <div class="col-12">
                <h5 class="mb-50">Adresse: {{$coordinateur->rue}} {{$coordinateur->cp}} @if($coordinateur->ville_id){{$coordinateur->Ville->name}}@endif</h5>
            </div>
        </div>
    </div>
</div>
@endsection
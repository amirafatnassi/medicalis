@extends('layouat.layoutCoordinateur')
@section('contenu')
<div class="card">
    <div class="card-header">
        <div class="card-title">Mon superviseur</div>
    </div>
    @if ($supervisor)
    <div class="card-body row">
        <div class="col-12">
            <h5 class="mb-75">ID: {{$supervisor->id}}</h5>
        </div>
        <div class="col-12">
            <h5 class="mb-75">Nom et Prénom: {{$supervisor->prenom}} {{$supervisor->nom}}</h5>
        </div>
        <div class="col-12">
            <h5 class="mb-75">E-mail: {{$supervisor->email}}</h5>
        </div>
        <div class="col-12">
            <h5 class="mb-75">N°Tel: {{$supervisor->tel}}</h5>
        </div>
        <div class="col-12">
            <h5 class="mb-50">Pays: {{$supervisor->pays}}</h5>
        </div>
        <div class="col-12">
            <h5 class="mb-50">Adresse: {{$supervisor->rue}} {{$supervisor->cp}} {{$supervisor->ville}}</h5>
        </div>
        <div class="col-12">
            <h5>Crée le: </b>{{$supervisor->created_at}}</h5>
        </div>
        <div class="col-12">
            <h5>Mis à jour le: </b>{{$supervisor->updated_at}}</h5>
        </div>
    </div>
    @else
    <div class="card-body row">
        <p>Vous n'avez pas de supérviseur pour le moment.</p>
    </div>

    @endif
</div>
@endsection
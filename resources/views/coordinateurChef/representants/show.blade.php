@extends('menus.layoutCoordinateurChef')
@section('contenu')
<div class="row">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <h5 class="mb-75">ID: {{$representant->id}}</h5>
                    </div>
                    <div class="col-12">
                        <h5 class="mb-75">Nom et Prénom: {{$representant->prenom}} {{$representant->nom}}</h5>
                    </div>
                    <div class="col-12">
                        <h5 class="mb-75">Travail: {{$representant->fonction}} {{$representant->lieuTravail}}</h5>
                    </div>
                    <div class="col-12">
                        <h5 class="mb-75">E-mail: {{$representant->email}}</h5>
                    </div>
                    <div class="col-12">
                        <h5 class="mb-75">N°Tel: {{$representant->tel}}</h5>
                    </div>
                    <div class="col-12">
                        <h5 class="mb-50">Pays: {{$representant->pays}}</h5>
                    </div>
                    <div class="col-12">
                        <h5 class="mb-50">Adresse: {{$representant->rue}} {{$representant->cp}} {{$representant->ville}}</h5>
                    </div>
                    <div class="col-12">
                        <h5>Crée le: </b>{{$representant->created_at}}</h5>
                    </div>
                    <div class="col-12">
                        <h5>Mis à jour le: </b>{{$representant->updated_at}}</h5>
                    </div>
                </div>
            </div>
        </div>
</div>
@endsection
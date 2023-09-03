@extends('layouat.layoutCoordinateur')
@section('contenu')

<div class="card">
    <div class="card-header">
        <div class="card-title">Représentant: {{$representant->prenom}} {{$representant->nom}}</div>
    </div>
    <div class="card-body row">
        <div class="col-12">
            ID: {{$representant->id}}
        </div>
        <div class="col-12">
            E-mail: {{$representant->email}}
        </div>
        <div class="col-12">
            N°Tel: {{$representant->tel}}
        </div>
        <div class="col-12">
            Pays: {{$representant->Country->lib}}
        </div>
        <div class="col-12">
            Adresse: {{$representant->rue}} {{$representant->cp}} {{$representant->Ville->name}}
        </div>
    </div>
</div>
@endsection
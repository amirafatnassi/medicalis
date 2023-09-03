@extends('layout.layout')
@section('contenu')
<ul class="timeline">
    <div class="d-flex w-100 justify-content-between">
        <h5></h5>
        <img src="{{asset('assets/img/toucomex.png')}}" alt="..." class="img-thumbnail" width="100px" height="70px">
    </div>
    <br><br><br>
    <div class="d-flex w-100 justify-content-between">
        <h5 class="mb-1">ID: {{$client[0]->id}}</h5>
    </div>
    <div class="d-flex w-100 justify-content-between">
        <h5 class="mb-1">Libelle: {{$client[0]->lib}}</h5>
    </div>
    <div class="d-flex w-100 justify-content-between">
        <h5 class="mb-1">Type établissement: {{$client[0]->type_id}}</h5>
    </div>

    <table id="myTable" class="table table-bordered">
        <thead class="thead-light">
            <tr>
                <th style="width:30%">Numéro de série</th>
                <th style="width:20%">Lot</th>
                <th style="width:20%">Modèle</th>
                <th style="width:20%">Fournisseur</th>
                <th style="width:20%">Emplacement actuel</th>
                <th style="width:30%">Date de péremption</th>
                <th style="width:30%">Code QR</th>
            </tr>
        </thead>
        <tbody>
            @forelse($materiels as $m)
            <tr>
                <td>{{$m->ns}}</td>
                <td>{{$m->lot}}</td>
                <td>{{$m->modele}}</td>
                <td>{{$m->fournisseur}}</td>
                <td>{{$m->affectation_actuelle}}</td>
                <td>{{date('d/m/Y',strtotime($m->date_peremption))}}</td>
                <td> {!! QrCode::size(40)->generate($m->id) !!}</td>
            </tr>
            @empty<span class="badge badge-danger">Liste de matériels vide !</span>
            @endforelse
        </tbody>
    </table>
    <div class="d-flex w-100 justify-content-between">
        <h5></h5>
        <small>Date: {{$date}}</small>
    </div>
</ul>
@endsection
@extends('layouat.layaoutMedecin')
@section('contenu')

<div class="card">
    <div class="card-header">
        <div class="card-title">
            Les Medecins sur le platforme
        </div>
    </div>
    <div class="card-body table-responsive">
        <table id="myTable" class="table">
            <thead>
                <tr>
                    <th><i data-feather="home"></i> Organisme</th>
                    <th><i data-feather="user"></i> Nom et prénom</th>
                    <th>Spécialité</th>
                    <th><i data-feather="flag"></i> Pays</th>
                    <th>Ville</th>
                    <th>Rue</th>
                    <th><i data-feather="phone"></i> Tel</th>
                    <th><i data-feather="mail"></i> E-mail</th>
                    <th><i data-feather="send"></i> Nouvele Discussion</th>
                </tr>
            </thead>
            <tbody>
                @foreach($listMedecins as $medecin)
                <tr>
                    <td>@if($medecin->Organism){{$medecin->Organism->lib}}@endif</td>
                    <td>{{$medecin->prenom}} {{$medecin->nom}}</td>
                    <td>{{$medecin->specialty->lib}}</td>
                    <td>{{$medecin->country->lib}}</td>
                    <td>{{$medecin->Ville->name}}</td>
                    <td>{{$medecin->rue}}</td>
                    <td>{{$medecin->tel}}</td>
                    <td><a href="{{url('mailto:'.$medecin->email)}}">{{$medecin->email}}</a></td>
                    <td><a class="btn btn-primary" href="{{url('/medecin/forum/createbyid/'.$medecin->id)}}"><i data-feather="send"></i></a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
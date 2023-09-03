@extends('layouat.layoutAdmin')
@section('contenu')
<div class="card">
    <div class="card-header">
        <div class="col-6 card-title">
            Liste de demandes d'inscription de médecins traitants:</h3>
        </div>
        <div class="col-6">
            <div class="input-group input-group-merge">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i data-feather="search" class="text-muted"></i></span>
                </div>
                <input type="text" class="form-control" id="myInput" onkeyup="myFunction()" placeholder="Rechercher médecin" aria-label="Search..." aria-describedby="email-search" />
            </div>
        </div>
    </div>
    <div class="card-body table-responsive">
        <table class="table" id="myTable">
            <thead>
                <tr>
                    <th>Nom et prénom</th>
                    <th>Specialité</th>
                    <th>Adresse</th>
                    <th>Tel</th>
                    <th>Sexe</th>
                    <th>Organisme</th>
                    <th>E-mail</th>
                    <th>Vérifié</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($liste_demande as $liste_demande)
                <tr>
                    <td><a href="{{url('administrateur/showMedecin/'.$liste_demande->id)}}" class="btn btn-primary">{{$liste_demande->nom}} {{$liste_demande->prenom}}</a></td>
                    <td>@if($liste_demande->specialite){{$liste_demande->Specialite->lib}}@endif</td>
                    <td>{{$liste_demande->rue}} {{$liste_demande->cp}} @if($liste_demande->ville){{$liste_demande->Ville->name}}@endif @if($liste_demande->pays){{$liste_demande->country->lib}}@endif</td>
                    <td>{{$liste_demande->tel}}</td>
                    <td>{{$liste_demande->Sexe->lib}}</td>
                    <td>@if($liste_demande->organisme){{$liste_demande->Organisme->lib}}@endif</td>
                    <td><a href="{{url('mailto:'.$liste_demande->email)}}">{{$liste_demande->email}}</a></td>
                    <td>
                        @if($liste_demande->hasVerifiedEmail())
                        <span class="badge badge-pill badge-light-success mr-1">Email vérifié</span>
                        @else
                        <span class="badge badge-pill badge-light-danger mr-1">Email non vérifié</span>
                        @endif
                    </td>
                    <td>
                        @if($liste_demande->hasVerifiedEmail())
                        <a class="btn btn-primary mr-1" href="{{url('administrateur/approuverMedecins/'.$liste_demande->id.'/')}}"><i data-feather="check"></i></a>
                        @else
                        <a class="btn btn-primary mr-1 disabled" href="{{url('administrateur/approuverMedecins/'.$liste_demande->id.'/')}}"><i data-feather="check"></i></a>
                        @endif
                        <a class="btn btn-danger" href="{{url('administrateur/annulerMedecins/'.$liste_demande->id.'/')}}"><i data-feather="x" class="mr-1"></i></a>
                    </td>
                </tr>
                @empty <span class="badge badge-danger">Liste de demande vide !</span>
                @endforelse
            </tbody>
        </table>
    </div>
    <script>
        function myFunction() {
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("myInput");
            filter = input.value.toUpperCase();
            table = document.getElementById("myTable");
            tr = table.getElementsByTagName("tr");
            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[1];
                if (td) {
                    txtValue = td.textContent || td.innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                }
            }
        }
    </script>
    @endsection
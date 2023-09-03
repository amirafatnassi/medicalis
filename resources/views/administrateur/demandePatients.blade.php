@extends('layouat.layoutAdmin')
@section('contenu')
<div class="card">
    <div class="card-header">
        <div class="col-6 card-title">Liste de demandes d'inscriptions de patients</div>
        <div class="col-6">
            <div class="input-group input-group-merge">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i data-feather="search" class="text-muted"></i></span>
                </div>
                <input type="text" class="form-control" id="myInput" onkeyup="myFunction()" placeholder="Rechercher consultation" aria-label="Search..." aria-describedby="email-search" />
            </div>
        </div>
    </div>
    <div class="card-body table-responsive">
        <table class="table" id="myTable">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom et prénom</th>
                    <th>Adresse</th>
                    <th>Tel</th>
                    <th>Sexe</th>
                    <th>E-mail</th>
                    <th>Email vérifié</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($liste_demande as $patient)
                <tr>
                    <td><a href="{{url('administrateur/showPatient/'.$patient->id)}}" class="btn btn-primary">{{$patient->id}}</a></td>
                    <td>{{$patient->nom}} {{$patient->prenom}}</td>
                    <td>{{$patient->rue}} {{$patient->cp}} {{$patient->Ville->name}}{{$patient->Country->lib}}</td>
                    <td>{{$patient->tel}}</td>
                    <td>@if($patient->sexe){{$patient->Sexe->lib}}@endif</td>
                    <td><a href="{{url('mailto:'.$patient->email)}}">{{$patient->email}}</a></td>
                    <td>
                        @if($patient->hasVerifiedEmail())
                        Email vérifié
                        @else
                        Email non vérifié
                        @endif
                    </td>
                    <td>
                        @if($patient->hasVerifiedEmail())
                        <a class="btn btn-primary mr-1" href="{{ url('administrateur/approuverPatients/'.$patient->id) }}"><i data-feather="check"></i></a>
                        @else
                        <a class="btn btn-primary mr-1 disabled" href="#"><i data-feather="check"></i></a>
                        @endif
                        <a class="btn btn-danger" href="{{url('administrateur/annulerPatients/'.$patient->id.'/')}}"><i data-feather="x"></i></a>
                    </td>
                </tr>
                @empty <span class="badge badge-danger">Liste de demande vide !</span>
                @endforelse
            </tbody>
        </table>
    </div>
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
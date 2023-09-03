@extends('layouat.layoutCoordinateur')
@section('contenu')

<div class="card">
    <div class="card-header">
        <div class="card-title col-12">
            <h3>Liste de médecins sur la platforme:</h3>
        </div>
        <div class="col-4">
            <div class="input-group input-group-merge">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i data-feather="search" class="text-muted"></i></span>
                </div>
                <input type="text" class="form-control" id="myInput" onkeyup="myFunction()" placeholder="Rechercher médecin selon nom et prénom.." aria-label="Search..." aria-describedby="email-search" />
            </div>
        </div>
        <div class="col-4">
            <div class="input-group input-group-merge">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i data-feather="search" class="text-muted"></i></span>
                </div>
                <input type="text" class="form-control" id="myInput1" onkeyup="myFunction1()" placeholder="Rechercher médecin selon spécialité.." aria-label="Search..." aria-describedby="email-search" />
            </div>
        </div>
        <div class="col-4">
            <div class="input-group input-group-merge">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i data-feather="search" class="text-muted"></i></span>
                </div>
                <input type="text" class="form-control" id="myInput2" onkeyup="myFunction2()" placeholder="Rechercher médecin selon adresse.." aria-label="Search..." aria-describedby="email-search" />
            </div>
        </div>
    </div>

    <div class="card-body table-responsive">
        <table id="myTable" class="table table-striped">
            <thead>
                <tr>
                    <td>Medecin</td>
                    <td>Spécialité</td>
                    <td>Adresse</td>
                    <td>Organisme</td>
                    <td>Tel</td>
                    <td>E-mail</td>
                </tr>
            </thead>
            <tbody>
                @foreach($medecins as $med)
                <tr class="list-goup-item">
                    <td><a href="{{url('coordinateur/medecins/show',$med->id)}}">{{$med->prenom}} {{$med->nom}}</a></td>
                    <td>{{$med -> Specialite->lib}} </td>
                    <td>@if($med->ville_id){{$med->Ville->name}}@endif @if($med->country_id){{$med->Country->lib}}@endif</td>
                    <td>@if($med->organisme_id){{$med->Organisme->lib}}@endif</td>
                    <td>{{$med->tel}}</td>
                    <td>{{$med->email}}</td>
                </tr>
                @endforeach
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

    function myFunction1() {
        var input, filter, table, tr, td, i, txtValue;
        input = document.getElementById("myInput1");
        filter = input.value.toUpperCase();
        table = document.getElementById("myTable");
        tr = table.getElementsByTagName("tr");
        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[2];
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

    function myFunction2() {
        var input, filter, table, tr, td, i, txtValue;
        input = document.getElementById("myInput2");
        filter = input.value.toUpperCase();
        table = document.getElementById("myTable");
        tr = table.getElementsByTagName("tr");
        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[3];
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
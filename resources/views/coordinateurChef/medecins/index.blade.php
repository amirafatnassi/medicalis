@extends('menus.layoutCoordinateurChef')
@section('contenu')

<div class="row">
    <div class="col-12">
        <h3>Liste de médecins sur la platforme:</h3>
    </div>
    <div class="col-3">
        <a href="{{url('coordinateur/medecins/create')}}" class="btn btn-outline-primary">
            <i data-feather="user-plus" class="text-primary"></i> Nouveau médecin
        </a>
    </div>
    <div class="col-3">
        <div class="input-group input-group-merge">
            <div class="input-group-prepend">
                <span class="input-group-text"><i data-feather="search" class="text-muted"></i></span>
            </div>
            <input type="text" class="form-control" id="myInput" onkeyup="myFunction()" placeholder="Rechercher médecin selon nom et prénom.." aria-label="Search..." aria-describedby="email-search" />
        </div>
    </div>
    <div class="col-3">
        <div class="input-group input-group-merge">
            <div class="input-group-prepend">
                <span class="input-group-text"><i data-feather="search" class="text-muted"></i></span>
            </div>
            <input type="text" class="form-control" id="myInput1" onkeyup="myFunction1()" placeholder="Rechercher médecin selon spécialité.." aria-label="Search..." aria-describedby="email-search" />
        </div>
    </div>
    <div class="col-3">
        <div class="input-group input-group-merge">
            <div class="input-group-prepend">
                <span class="input-group-text"><i data-feather="search" class="text-muted"></i></span>
            </div>
            <input type="text" class="form-control" id="myInput2" onkeyup="myFunction2()" placeholder="Rechercher médecin selon adresse.." aria-label="Search..." aria-describedby="email-search" />
        </div>
    </div>
</div>
<br>
<table id="myTable" class="table table-striped">
    <tr>
        <td>ID</td>
        <td>Medecin</td>
        <td>Spécialité</td>
        <td>Adresse</td>
        <td>Organisme</td>
        <td>Tel</td>
        <td>E-mailllll</td>
    </tr>
    @foreach($medecins as $med)
    <tr class="list-goup-item">
        <td><a type="button" class="btn btn-outline-primary" href="{{url('coordinateur/medecins/show',$med->id)}}"> {{$med -> id}}</a></td>
        <td>{{$med->prenom}} {{$med->nom}}</td>
        <td>{{$med -> specialite}} </td>
        <td>{{$med->ville}} {{$med->pays}}</td>
        <td>{{$med->organisme}}</td>
        <td>{{$med->tel}}</td>
        <td>{{$med->email}}</td>
    </tr>
    @endforeach
</table>


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
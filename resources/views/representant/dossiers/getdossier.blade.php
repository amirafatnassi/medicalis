@extends('menus.layoutRepresentant')
@section('contenu')
<div class="row">
    <div class="col-2">
        <h3>Liste de patients:</h3>
    </div>
    <div class="col-2">
       
    </div>
    <div class="col-4">
        <div class="input-group input-group-merge">
            <div class="input-group-prepend">
                <span class="input-group-text"><i data-feather="search" class="text-muted"></i></span>
            </div>
            <input type="text" class="form-control" id="myInput" onkeyup="myFunction()" placeholder="Rechercher patients selon nom et prénom.." aria-label="Search..." aria-describedby="email-search" />
        </div>
    </div>
    <div class="col-4">
        <div class="input-group input-group-merge">
            <div class="input-group-prepend">
                <span class="input-group-text"><i data-feather="search" class="text-muted"></i></span>
            </div>
            <input type="text" class="form-control" id="myInput1" onkeyup="myFunction1()" placeholder="Rechercher patients selon conventions.." aria-label="Search..." aria-describedby="email-search" />
        </div>
    </div>
</div>
<br>
<table id="myTable" class="table table-bordered">
    <thead class="thead-light">
        <tr>
            <th>ID</th>
            <th>Patient</th>
            <th>Date Naissance</th>
            <th>Lieu Naissance</th>
            <th>E-mail</th>
            <th>Tel</th>
            <th>Pays</th>
            <th>Avatar</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @forelse($dossiers as $dossier)
        <tr>
            <td style="width:15%"><a href="" class="btn btn-primary">ID:{{$dossier->id}}</a></td>
            <td style="width:15%">{{$dossier->prenom}} {{$dossier->nom}}</td>
            <td style="width:10%">{{$dossier->datenaissance}}</td>
            <td style="width:10%">{{$dossier->lieunaissance}}</td>
            <td style="width:15%">{{$dossier->email}}</td>
            <td style="width:5%">{{$dossier->tel}}</td>
            <td style="width:5%">{{$dossier->pays}}</td>
            <td style="width:10%"><img src="{{asset('uploads/dossier/'.$dossier->image)}}" width="50px;" height="50px;" alt="Avatar"></td>
            <td style="width:10%"><a href="{{url('representant/dossiers/'.$dossier->id.'/ajouterdossier')}}" class="btn btn-success">Ajouter</a></td>
        </tr>
        @empty<span class="badge badge-danger">Liste de patients vide !</span>
        @endforelse
    </tbody>
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
</script>

<script>
    $(document).ready(function() {
        $('#myTable').dataTable();
    });

    function deleteData(id) {
        var id = id;
        var url = '{{route("representant.deleteDossier",":id")}}';
        url = url.replace(':id', id);
        $("#deleteForm").attr('action', url);
    }

    function formSubmit() {
        $("#deleteForm").submit();
    }
</script>
@endsection
@extends('layouat.layoutAdmin')
@section('contenu')
<div class="card">
    <div class="card-header row">
        <div class="card-title col-4">Liste de patients</div>
        <div class="input-group input-group-merge col-8">
            <div class="input-group-prepend">
                <span class="input-group-text"><i data-feather="search" class="text-muted"></i></span>
            </div>
            <input type="text" class="form-control" id="myInput" onkeyup="myFunction()" placeholder="Rechercher patients selon nom et prénom.." aria-label="Search..." aria-describedby="email-search" />
        </div>
        <div class="col-4">
            <a class="btn btn-outline-primary" href="{{url('administrateur/dossiers/create')}}"><i class="mr-1" data-feather="plus"></i><span class="align-middle">Nouveau dossier</span></a>
        </div>
        <div class="input-group input-group-merge col-8">
            <div class="input-group-prepend">
                <span class="input-group-text"><i data-feather="search" class="text-muted"></i></span>
            </div>
            <input type="text" class="form-control" id="myInput1" onkeyup="myFunction1()" placeholder="Rechercher patients selon conventions.." aria-label="Search..." aria-describedby="email-search" />
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive" id="basic-table">
            <table id="myTable" class="table">
                <thead>
                    <tr>
                        <th>Identifiant</th>
                        <th>Patient</th>
                        <th>Convention</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($dossiers as $dossier)
                    <tr>
                        <td>
                            <img src="{{asset('uploads/dossier/'.($dossier->image??'user.png'))}}" height="40" width="40" /><a href="{{url('administrateur/dossiers/show/'.$dossier->id)}}">{{$dossier->id}}</a>
                        </td>
                        <td>{{$dossier->prenom}} {{$dossier->nom}}</td>
                        <td>{{$dossier->convention}}</td>
                        <td>
                            <a href="{{ url('administrateur/dossiers/'.$dossier->id.'/effetsmarquants')}}" class="mr-1" data-toggle="tooltip" data-placement="left" title="Effets marquants"><i data-feather='archive'></i></a>
                            <a href="{{url('administrateur/forumMedPatient/createbyid/'.$dossier->id)}}" class="mr-1" data-toggle="tooltip" data-placement="left" title="Antécédants">
                                <i data-feather="message-square"></i>
                            </a>
                            <a href="{{ url('administrateur/dossiers/'.$dossier->id.'/historiques')}}" class="mr-1" data-toggle="tooltip" data-placement="left" title="Historiques">
                                <i data-feather="clock"></i>
                            </a>
                            <a href="{{url('administrateur/dossiers/edit/'.$dossier->id)}}" data-toggle="tooltip" data-placement="left" title="Edit">
                                <i data-feather="edit-3"></i>
                            </a>
                        </td>
                    </tr>
                    @empty<span class="badge badge-danger">Liste de patients vide !</span>
                    @endforelse
                </tbody>
            </table>
        </div>
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
</script>
@endsection
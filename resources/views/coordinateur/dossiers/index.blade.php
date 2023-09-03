@extends('layouat.layoutCoordinateur')
@section('contenu')
<div class="card">
    <div class="card-header row">
        <div class="content-header-left col-11">
            <div class="row">
                <h2 class="card-title col-4">Liste de patients</h2>
                <div class="input-group input-group-merge col-4">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i data-feather="search" class="text-muted"></i></span>
                    </div>
                    <input type="text" class="form-control" id="myInput" onkeyup="myFunction()" placeholder="Rechercher patients selon nom et prénom.." aria-label="Search..." aria-describedby="email-search" />
                </div>

                <div class="input-group input-group-merge col-4">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i data-feather="search" class="text-muted"></i></span>
                    </div>
                    <input type="text" class="form-control" id="myInput1" onkeyup="myFunction1()" placeholder="Rechercher patients selon conventions.." aria-label="Search..." aria-describedby="email-search" />
                </div>
            </div>
        </div>
        <div class="content-header-right text-md-right col-1 d-md-block d-none">
            <div class="form-group breadcrumb-right">
                <div class="dropdown">
                    <button class="btn-icon btn btn-primary btn-round btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i data-feather="grid"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item" href="{{url('coordinateur/dossiers/create')}}"><i class="mr-1" data-feather="plus"></i><span class="align-middle">Nouveau dossier</span></a>
                        <a class="dropdown-item" href="{{url('coordinateur/dossiers/search')}}"><i class="mr-1" data-feather="search"></i><span class="align-middle">Chercher dossier</span></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card-body table-responsive">
        <table id="myTable" class="table">
            <thead>
                <tr>
                    <th>Identifiant</th>
                    <th>Patients</th>
                    <th>Convention</th>
                    <th>Historiques</th>
                    <th>Antécédants</th>
                    <th>Discussion</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($dossiers as $dossier)
                <tr>
                    <td>
                        <img src="{{asset('uploads/users/'.($dossier->user->image??'user.png'))}}" class="mr-75" height="40" width="40" alt="" />
                        <a href="{{url('coordinateur/dossiers/show/'.$dossier->id)}}">ID:{{$dossier->id}}</a>
                    </td>
                    <td>{{$dossier->user->prenom}} {{$dossier->user->nom}}</td>
                    <td>@if($dossier->convention_id){{$dossier->Convention->lib}}@endif</td>
                    <td><a href="{{ url('coordinateur/dossiers/'.$dossier->id.'/historiques')}}" class="nav-link"><i data-feather='clock'></i></a></td>
                    <td><a href="{{ url('coordinateur/dossiers/'.$dossier->id.'/effetsmarquants')}}" class="nav-link"><i data-feather='archive'></i></a></td>
                    <td>
                        <a href="{{url('coordinateur/discussionsCoordPatient/createbyid/'.$dossier->id)}}" class="nav-link">
                            <i data-feather="message-square"></i>
                        </a>
                    </td>
                    <td>
                        <div class="row">
                            <a class="btn" href="{{url('coordinateur/dossiers/edit/'.$dossier->id)}}">
                                <i data-feather="edit-3" class="text-success"></i>
                            </a>
                            <form action="{{ route('coordinateur.deleteDossier', $dossier->id) }}" method="POST" style="display:inline;"> {{ csrf_field() }} {{ method_field('DELETE') }}
                                <button type="submit" class="btn" onclick="return confirm('Êtes-vous sûr de vouloir écarter ce patient: {{ $dossier->prenom }} {{$dossier->nom}} de votre liste de patients  ?')">
                                    <i data-feather="trash" class="text-danger"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty<span class="badge badge-danger">Liste de patients vide !</span>
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
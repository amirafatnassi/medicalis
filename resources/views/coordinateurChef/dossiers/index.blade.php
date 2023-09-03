@extends('menus.layoutCoordinateurChef')
@section('contenu')
<div class="content-header row">
    <div class="content-header-left col-11">
        <div class="row breadcrumbs-top">
            <div class="col-12">
                <h2 class="content-header-title float-left mb-0">Liste de patients</h2>
                <div class="breadcrumb-wrapper col-12">
                    <div class="row">
                        <div class="input-group input-group-merge col-6">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i data-feather="search" class="text-muted"></i></span>
                            </div>
                            <input type="text" class="form-control" id="myInput" onkeyup="myFunction()" placeholder="Rechercher patients selon nom et prénom.." aria-label="Search..." aria-describedby="email-search" />
                        </div>

                        <div class="input-group input-group-merge col-6">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i data-feather="search" class="text-muted"></i></span>
                            </div>
                            <input type="text" class="form-control" id="myInput1" onkeyup="myFunction1()" placeholder="Rechercher patients selon conventions.." aria-label="Search..." aria-describedby="email-search" />
                        </div>
                    </div>
                </div>
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
                    <a class="dropdown-item" href="{{url('coordinateurChef/dossiers/create')}}"><i class="mr-1" data-feather="plus"></i><span class="align-middle">Nouveau dossier</span></a>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="content-body">
    <!-- Basic Tables start -->
    <div class="row" id="basic-table">
        <div class="col-12">
            <div class="card">
                <div class="table-responsive">
                    <table id="myTable" class="table">
                        <thead>
                            <tr>
                                <th>Identifiant</th>
                                <th>Patient</th>
                                <th>Convention</th>
                                <th>Antécédants</th>
                                <th>Discussion</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($dossiers as $dossier)
                            <tr>
                                <td>
                                    <img src="{{asset('uploads/dossier/'.$dossier->image)}}" class="mr-75" height="40" width="40" alt="" />
                                    <a href="{{url('coordinateurChef/dossiers/show/'.$dossier->id)}}" class="btn btn-primary">ID:{{$dossier->id}}</a>
                                </td>
                                <td>{{$dossier->prenom}} {{$dossier->nom}}</td>
                                <td>{{$dossier->convention}}</td>
                                <td><a href="{{ url('coordinateurChef/dossiers/'.$dossier->id.'/effetsmarquants')}}" class="nav-link"><i data-feather='archive'></i></a></td>
                                <td>
                                    <a href="{{url('/coordinateurChef/forumMedPatient/createbyid/'.$dossier->id)}}" class="nav-link">
                                        <i data-feather="message-square"></i>
                                    </a>
                                </td>
                                <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn btn-sm dropdown-toggle hide-arrow" data-toggle="dropdown">
                                            <i data-feather="more-vertical"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a href="{{ url('coordinateurChef/dossiers/'.$dossier->id.'/historiques')}}" class="dropdown-item">
                                                <i data-feather="clock" class="mr-50"></i>Historiques
                                            </a>
                                            <a class="dropdown-item" href="{{url('coordinateurChef/dossiers/edit/'.$dossier->id)}}">
                                                <i data-feather="edit-2" class="mr-50"></i>
                                                <span>Edit</span>
                                            </a>
                                            <a class="dropdown-item" href="javascript:void(0);" data-toggle="modal" data-target="#danger" class="btn btn-danger" onclick="deleteData('{{$dossier->id}}')">
                                                <i data-feather="trash" class="mr-50"></i>
                                                <span>Delete</span>
                                            </a>
                                        </div>
                                    </div>
                                </td>
                                <!-- Modal -->
                                <div class="modal fade modal-danger text-left" id="danger" tabindex="-1" role="dialog" aria-labelledby="myModalLabel120" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <form action="" id="deleteForm" method="post">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="myModalLabel120">Confirmation de suppression:</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">{{csrf_field()}} {{method_field('DELETE')}}
                                                    <p class="text-center">Vous avez demandez d'écarter ce patient de votre liste de patients,
                                                        <br>voulez-vous confirmez ?
                                                    </p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-success" data-dismiss="modal">Annuler</button>
                                                    <button type="submit" class="btn btn-danger" data-dismiss="modal" onclick="formSubmit()">Oui, Suspendre!</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </tr>
                            @empty<span class="badge badge-danger">Liste de patients vide !</span>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
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

<script>
    $(document).ready(function() {
        $('#myTable').dataTable();
    });

    function deleteData(id) {
        var id = id;
        var url = '{{route("coordinateurChef.deleteDossier",":id")}}';
        url = url.replace(':id', id);
        $("#deleteForm").attr('action', url);
    }

    function formSubmit() {
        $("#deleteForm").submit();
    }
</script>
@endsection
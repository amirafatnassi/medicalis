@extends('menus.layoutRepresentant')
@section('contenu')

<div class="card user-card">
    <div class="card-body">
        <div class="row">
            <div class="col-xl-6 col-lg-12 d-flex flex-column justify-content-between border-container-lg">
                <div class="user-avatar-section">
                    <div class="d-flex justify-content-start">
                        <img class="img-fluid rounded" src="{{asset('uploads/dossier/'.$dossier->image)}}" height="104" width="104" alt="User avatar" />
                        <div class="d-flex flex-column ml-1">
                            <div class="user-info mb-1">
                                <h4 class="mb-0">Dossier médical n°: {{$dossier->id}}: {{$dossier->nom}} {{$dossier->prenom}}</h4>
                                <span class="card-text">{{$dossier->email}}</span>
                            </div>
                            <div class="d-flex flex-wrap">
                                <a href="" class="btn btn-primary"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pen" viewBox="0 0 16 16">
                                        <path d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001zm-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708l-1.585-1.585z" />
                                    </svg></a>
                                <a class="btn btn-outline-primary ml-1" href="">
                                    <i data-feather="printer" class="mr-1"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-xl-6 col-lg-12 mt-2 mt-xl-0">
                <div class="user-info-wrapper">
                    <div class="d-flex flex-wrap my-50">
                        <div class="user-info-title">
                            <i data-feather="flag" class="mr-1"></i>
                            <span class="card-text user-info-title font-weight-bold mb-0">Pays: </span>
                        </div>
                        <p class="card-text mb-0">{{$dossier->pays}}</p>
                    </div>
                    <div class="d-flex flex-wrap">
                        <div class="user-info-title">
                            <i data-feather="phone" class="mr-1"></i>
                            <span class="card-text user-info-title font-weight-bold mb-0">Tel: </span>
                        </div>
                        <p class="card-text mb-0">{{$dossier->tel}}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-3">
        <h3>Antécédants:</h3>
    </div>
    <div class="col-3"><a href="{{url('representant/dossiers/'.$dossier->id.'/listeSupprimer')}}" class="btn btn-primary">Liste des antécédants Supprimés</a>&nbsp;</div>
    <div class="col-6">
        <div class="input-group input-group-merge">
            <div class="input-group-prepend">
                <span class="input-group-text"><i data-feather="search" class="text-muted"></i></span>
            </div>
            <input type="text" class="form-control" id="myInput" onkeyup="myFunction()" placeholder="Rechercher effet marquant selon date.." title="Type in a name">
        </div>
    </div>
    <div class="col-12">
        <table class="table" id="myTable">
            <thead>
                <tr>
                    <th style="width:5%">ID</th>
                    <th style="width:10%">Date</th>
                    <th style="width:70%">Antécédant</th>
                    <th style="width:10%">Pièces jointes</th>
                    <th style="width:5%">Supprimer</th>
                </tr>
            </thead>
            <tbody>
                @foreach($liste_consultations as $consultation)
                <tr>
                    <td><a href="{{url('medecin/'.$id_dossier.'/consultation/'.$consultation->id.'/show')}}" class="btn btn-primary">ID:{{$consultation->id}}</a></td>
                    <td>{{date('d/m/Y',strtotime($consultation->date))}}</td>
                    <td>{{$consultation->effet_marquant_txt}}</td>
                    <td>
                        @if(!is_null($consultation->downloads))
                        <a href="{{url('medecin/'.$id_dossier.'/consultation/showExamenfiles/'.$consultation->id)}}"><i data-feather="paperclip"></i></a>
                        @endif
                    </td>
                    <td><a href="javascript:;" data-toggle="modal" data-target="#danger" class="btn btn-danger" onclick="deleteData({{$consultation->id}})"><i data-feather="trash-2"></i></a></td>
                    <!-- Modal -->
                    <div class="modal fade modal-danger text-left" id="danger" tabindex="-1" role="dialog" aria-labelledby="myModalLabel120" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <form action="" id="deleteForm" method="post">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="myModalLabel120">Annulation de suppression:</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">{{csrf_field()}} {{method_field('DELETE')}}
                                        <p class="text-center">Vous allez annuler la suppression d'un antécédant,
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
</script>

<script>
    $(document).ready(function() {
        $('#myTable').dataTable();
    });

    function deleteData(id) {
        var id = id;
        var url = '{{route("representant.dossiers.deleteHistorique",":id")}}';
        url = url.replace(':id', id);
        $("#deleteForm").attr('action', url);
    }

    function formSubmit() {
        $("#deleteForm").submit();
    }
</script>
@endsection
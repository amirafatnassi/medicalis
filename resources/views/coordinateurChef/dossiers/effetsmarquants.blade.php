@extends('menus.layoutCoordinateurChef')
@section('contenu')

<div class="row">
    <div class="col-3">
        <h3>Antécédants:</h3>
    </div>
    <div class="col-3"><a href="{{url('coordinateurChef/dossiers/'.$id_dossier.'/listeSupprimer')}}" class="btn btn-primary">Liste des antécédants Supprimés</a>&nbsp;</div>
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
        var url = '{{route("coordinateurChef.dossiers.deleteHistorique",":id")}}';
        url = url.replace(':id', id);
        $("#deleteForm").attr('action', url);
    }

    function formSubmit() {
        $("#deleteForm").submit();
    }
</script>
@endsection
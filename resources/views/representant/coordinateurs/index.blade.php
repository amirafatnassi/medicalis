@extends('menus.layoutRepresentant')
@section('contenu')

<div class="row">
    <div class="col-6">
        <h3>Liste de coordinateurs sur la platforme:</h3>
    </div>
    <div class="col-6">
        <div class="input-group input-group-merge">
            <div class="input-group-prepend">
                <span class="input-group-text"><i data-feather="search" class="text-muted"></i></span>
            </div>
            <input type="text" class="form-control" id="myInput" onkeyup="myFunction()" placeholder="Rechercher médecin selon nom et prénom.." aria-label="Search..." aria-describedby="email-search" />
        </div>
    </div>
</div>
<br>
<table id="myTable" class="table table-striped">
    <tr>
        <td>ID</td>
        <td>Nom et prénom</td>
        <td>Role</td>
        <td>Tel</td>
        <td>E-mail</td>
        <td>Actions</td>
    </tr>
    @foreach($mesCoordinateurs as $c)
    <tr class="list-goup-item">
        <td><a type="button" class="btn btn-outline-primary" href="{{url('representant/representants/show',$c->id)}}"> {{$c -> id}}</a></td>
        <td>{{$c->prenom}} {{$c->nom}}</td>
        <td>{{$c->role}}</td>
        <td>{{$c->tel}}</td>
        <td>{{$c->email}}</td>
        <td>
            <a href="javascript:;" data-toggle="modal" data-target="#danger" class="btn btn-danger" onclick="deleteData({{$c->repcoord}})">Désactiver</a>
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
                            <p class="text-center">Vous avez demandez de désactiver ce représentant de votre liste de correspondance,
                                <br>voulez-vous confirmez ?
                            </p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-success" data-dismiss="modal">Annuler</button>
                            <button type="submit" class="btn btn-danger" data-dismiss="modal" onclick="formSubmit()">Oui, Désactiver!</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </tr>
    @endforeach
    @foreach($coordinateurs as $coord)
    <tr class="list-goup-item">
        <td><a type="button" class="btn btn-outline-primary" href="{{url('coordinateur/representants/show',$coord->id)}}"> {{$coord -> id}}</a></td>
        <td>{{$coord->prenom}} {{$coord->nom}}</td>
        <td>{{$coord->role}}</td>
        <td>{{$coord->tel}}</td>
        <td>{{$coord->email}}</td>
        <td>
            <form method="POST" action="{{url('representant/coordinateurs/activer/'.$coord->repcoord)}}" enctype="multipart/form-data"> {{csrf_field()}}
                <button class="btn btn-secondary" type="submit" id="b_submit">Activer</button>
            </form>
        </td>
    </tr>
    @endforeach
    @foreach($others as $o)
    <tr class="list-goup-item">
        <td><a type="button" class="btn btn-outline-primary" href="{{url('representant/coordinateurs/show',$o->id)}}"> {{$o -> id}}</a></td>
        <td>{{$o->prenom}} {{$o->nom}}</td>
        <td>{{$o->role}}</td>
        <td>{{$o->tel}}</td>
        <td>{{$o->email}}</td>
        <td>
            <form method="POST" action="{{url('representant/coordinateurs/ajouter/'.$o->id)}}" enctype="multipart/form-data"> {{csrf_field()}}
                <button class="btn btn-success" type="submit" id="b_submit">Ajouter</button>
            </form>
        </td>
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
</script>

<script>
    $(document).ready(function() {
        $('#myTable').dataTable();
    });

    function deleteData(id) {
        var id = id;
        var url = '{{route("representant.coordinateurs.supprimer",":id")}}';
        url = url.replace(':id', id);
        $("#deleteForm").attr('action', url);
    }

    function formSubmit() {
        $("#deleteForm").submit();
    }
</script>
@endsection
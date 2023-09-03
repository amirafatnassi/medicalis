@extends('menus.layoutAdmin')
@section('contenu')

<div class="row">
    <div class="col-3">
        <h5>Liste des Type Radio :</h3>
    </div>
    <div class="col-3">
        <a href="{{url('administrateur/radiotypes/create')}}" class="btn btn-outline-primary">
            Nouveau Type Radio
        </a>
    </div>
                <div class="col-6">
                    <div class="input-group input-group-merge">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i data-feather="search" class="text-muted"></i></span>
                        </div>
                        <input type="text" class="form-control" id="myInput" onkeyup="myFunction()" placeholder="Rechercher consultation selon libellé.." aria-label="Search..." aria-describedby="email-search" />
                    </div>
                </div>
            </div>
            <br>
            <table id="myTable" class="table table-striped">
                <thead>
                    <tr>
                        <th style="width:25%">ID</th>
                        <th style="width:30%">Libelle</th>
                        <th style="width:40%">Actions</th>
                        <th style="width:60%">Remarques</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($liste_Radiotype as $radiotypes)
                    <tr>
                        <td><a href="{{url('administrateur/radio/'.$radiotypes->id.'/index')}}" class="btn btn-outline-primary">{{$radiotypes->id}}</a></td>
                        <td>{{$radiotypes->lib}}</td>
                        <td>
                            <a href="{{url('administrateur/radiotypes/edit',$radiotypes->id)}}" class="btn btn-primary">
                                <i data-feather="edit" class="mr-1"></i>
                            </a>
                            <a type="button" class="btn btn-danger" data-toggle="modal" data-target="#danger" onclick="deleteData({{$radiotypes->id}})">
                                <i data-feather="trash" class="mr-1"></i>
                            </a>
                        </td>
                        <td></td>
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
                                            <p class="text-center">Vous avez demandez ce organisme,<br>voulez-vous confirmez ?</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-success" data-dismiss="modal">Annuler</button>
                                            <button type="submit" class="btn btn-danger" data-dismiss="modal" onclick="formSubmit()">Oui, supprimer!</button>
                                        </div>
                                    </div>
                            </div>
                            </form>
                        </div>
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
            </script>

            <script>
                $(document).ready(function() {
                    $('#myTable').dataTable();
                });

                function deleteData(id) {
                    var id = id;
                    var url = '{{route("radiotypes.deleteradiotypes",":id")}}';
                    url = url.replace(':id', id);
                    $("#deleteForm").attr('action', url);
                }

                function formSubmit() {
                    $("#deleteForm").submit();
                }
            </script>
            </section>
            <!-- Dashboard Ecommerce ends -->
        </div>
    </div>
</div>
<!-- END: Content-->
@endsection
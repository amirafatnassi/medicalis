@extends('layouat.layoutCoordinateurChef')
@section('contenu')

<div class="card">
    <div class="card-header">
        <div class="card-title">Mes coordinateurs</div>
    </div>
    <div class="card-body table-responsive">
        <table id="myTable" class="table table-striped">
            <thead>
                <tr>
                    <td>Nom et prénom</td>
                    <td>Role</td>
                    <td>Tel</td>
                    <td>E-mail</td>
                    <!-- <td>Actions</td> -->
                </tr>
            </thead>
            <tbody>
                @foreach($coordinateurs as $c)
                <tr class="list-goup-item">
                    <td><a href="{{url('coordinateurChef/coordinateurs/show',$c->id)}}">{{$c->prenom}} {{$c->nom}}</a></td>
                    <td>{{$c->Role->lib}}</td>
                    <td>{{$c->tel}}</td>
                    <td>{{$c->email}}</td>
                    <!-- <td>
                        <a href="javascript:;" data-toggle="modal" data-target="#danger" class="btn btn-danger" onclick="deleteData({{$c->coord}})">Désactiver</a>
                        
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

                        <form method="POST" action="{{url('coordinateurChef/coordinateurs/activer/'.$c->coord)}}" enctype="multipart/form-data"> {{csrf_field()}}
                            <button class="btn btn-secondary" type="submit" id="b_submit">Activer</button>
                        </form>


                        <form method="POST" action="{{url('coordinateurChef/coordinateurs/ajouter/'.$c->id)}}" enctype="multipart/form-data"> {{csrf_field()}}
                            <button class="btn btn-success" type="submit" id="b_submit">Ajouter</button>
                        </form>
                    </td> -->
                </tr>
                @endforeach
            </tbody>

        </table>
    </div>
</div>
@endsection
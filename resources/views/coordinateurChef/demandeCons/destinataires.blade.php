@extends('menus.layoutCoordinateurChef')
@section('contenu')
<div class="card user-card">
    <div class="card-body">
        <div class="row">
            <div class="col-xl-6 col-lg-12 d-flex flex-column justify-content-between border-container-lg">
                <div class="user-avatar-section">
                    <div class="d-flex justify-content-start">
                        <img class="img-fluid rounded" src="{{asset('uploads/dossier/'.$dossier->image)}}" height="110" width="110" alt="avatar" />
                        <div class="d-flex flex-column ml-1">
                            <div class="user-info mb-1">
                                <h4 class="mb-0">Dossier médical n°: {{$dossier->id}}: {{$dossier->nom}} {{$dossier->prenom}}</h4>
                                <span class="card-text">{{$dossier->email}}</span>
                            </div>
                            <div class="d-flex flex-wrap">
                                <a href="{{url('coordinateurChef/dossiers/edit/'.$dossier->id)}}" class="btn btn-primary"> <i data-feather="edit-2"></i></a>
                                <a class="btn btn-outline-primary ml-1" href="">
                                    <i data-feather="printer"></i>
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
    <div class="col-12">
        <ul class="list-group">Liste de destinataires:</ul>
        @foreach($temps as $t)
        <li class="list-group-item d-flex justify-content-between align-items-center">
            {{$t->id_medecin}} : {{$t->display_name}}
            <form method="POST" action="{{url('coordinateurChef/demandeDevis/supprimer-destinataire/'.$t->id_medecin)}}" enctype="multipart/form-data"> {{csrf_field()}}
                <button class="btn btn-link" type="submit" data-mdb-toggle="tooltip" title="submit">
                    <i data-feather="trash"></i>
                </button>
            </form>
        </li>
        @endforeach
        <label for="">Ajoutez destinataires:</label>
        <table class="table">
            <tbody>

                @foreach($medecins as $m)
                <tr>
                    <td>{{$m->id}} : {{$m->display_name}}</td>
                    <td>
                        <form method="POST" action="{{url('coordinateurChef/demandeDevis/ajouter-destinataire/'.$m->id.'/'.$demande_devis)}}" enctype="multipart/form-data"> {{csrf_field()}}
                            <button class="btn btn-link" type="submit" data-mdb-toggle="tooltip" title="submit">
                                <i data-feather="check"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="d-flex justify-content-center">
            {!! $medecins->links() !!}
        </div>
    </div>
    <a class="btn btn-primary" type="button" href="{{url('coordinateurChef/demandeDevis/'.$demande_devis.'/resume')}}">
        envoyer
    </a>

</div>
@endsection
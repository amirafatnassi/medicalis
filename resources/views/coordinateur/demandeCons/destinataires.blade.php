@extends('layouat.layoutCoordinateur')
@section('contenu')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-6">
                <div class="user-avatar-section">
                    <div class="d-flex justify-content-start">
                        @if($dossier->image!=null)
                        <img class="img-fluid rounded" src="{{asset('uploads/dossier/'.$dossier->image)}}" height="105" width="105" alt="avatar" />
                        @else
                        <img class="img-fluid rounded" src="{{asset('uploads/dossier/user.png')}}" height="105" width="105" alt="avatar" />
                        @endif
                        <div class="d-flex flex-column ml-1">
                            <div class="user-info mb-1">
                                <h4 class="mb-0">Dossier médical n°: {{$dossier->id}}: {{$dossier->nom}} {{$dossier->prenom}}</h4>
                                <span class="card-text">{{$dossier->email}}</span>
                            </div>
                            <div class="d-flex flex-wrap">
                                <a href="" class="btn btn-primary">
                                    <i data-feather="edit-2"></i>
                                </a>
                                <a class="btn btn-outline-primary ml-1" href="">
                                    <i data-feather="printer"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6">
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
<div class="card">
    <div class="card-header">
        <div class="card-title">Liste de destinataires</div>
    </div>
    <div class="card-body">
        <ul class="list-group"></ul>
        @foreach($temps as $t)
        <li class="list-group-item d-flex justify-content-between align-items-center">
            {{$t->id_medecin}} : {{$t->display_name}}
            <form method="POST" action="{{url('coordinateur/demandeDevis/supprimer-destinataire/'.$t->id_medecin)}}" enctype="multipart/form-data"> {{csrf_field()}}
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
                        <form method="POST" action="{{url('coordinateur/demandeDevis/ajouter-destinataire/'.$m->id.'/'.$demande_devis)}}" enctype="multipart/form-data"> {{csrf_field()}}
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
    <div class="card-footer">
        <a class="btn btn-primary" type="button" href="{{url('coordinateur/demandeDevis/'.$demande_devis.'/resume')}}">
            envoyer
        </a>
    </div>
</div>
@endsection
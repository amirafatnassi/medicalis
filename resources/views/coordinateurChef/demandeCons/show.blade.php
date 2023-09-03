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
</div>
<div class="card">
    <div class="table-responsive">
        <table id="myTable" class="table">
            <thead>
                <tr>
                    <th>Identifiant</th>
                    <th>Status demande</th>
                    <th>coordinateur en charge</th>
                    <th>Utilisateur</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($demandes as $demande)
                <tr">
                    <td>
                        <a href="{{url('coordinateurChef/demandeCons/demande/'.$demande->id)}}" class="btn btn-outline-primary">ID:{{$demande->id}}</a>
                    </td>
                    <td>
                        @if($demande->status_id===1) <span class="badge badge-pill badge-light-danger mr-1">
                            @elseif($demande->status_id===2) <span class="badge badge-pill badge-light-success mr-1">
                                @elseif($demande->status_id===3) <span class="badge badge-pill badge-light-warning mr-1">
                                    @elseif(($demande->status_id===4) || ($demande->status_id===5)) <span class="badge badge-pill badge-light-secondary mr-1">
                                        @elseif($demande->status_id===6) <span class="badge badge-pill badge-light-success mr-1">
                                            @elseif($demande->status_id===9) <span class="badge badge-pill badge-light-success mr-1">
                                                @endif {{$demande->status}}</span>
                    </td>
                    <td>{{$demande->coordinateurEnCharge}}</td>
                    <td>{{$demande->user}}</td>
                    <td>
                        @if($demande->coordinateur_en_charge===Auth::user()->id)
                        @if($demande->status_id===1)
                        <div class="row">
                            <form method="POST" action="{{url('coordinateurChef/prendre-en-charge/'.$demande->id)}}" enctype="multipart/form-data"> {{csrf_field()}}
                                <button class="btn btn-link" type="submit" data-md-toggle="tooltip" title="Prendre en charge">
                                    <i data-feather="check"></i>
                                </button>
                            </form>
                        </div>
                        @elseif($demande->status_id===2)
                        <div class="row">
                            <form method="GET" action="{{url('coordinateurChef/demandeCons/'.$demande->id.'/demande-devis')}}" enctype="multipart/form-data"> {{csrf_field()}}
                                <button class="btn btn-link" type="submit" data-md-toggle="tooltip" title="Lancer demande devis">
                                    <i data-feather="pen-tool"></i>
                                </button>
                            </form>
                            &nbsp;
                            <a class="btn btn-link" data-md-toggle="tooltip" title="Demande infos complémentaires" href="{{url('coordinateurChef/demandeCons/'.$demande->id.'/enAttenteInfos')}}">
                                <i data-feather="help-circle"></i>
                            </a>
                        </div>
                        @elseif(($demande->status_id===3)||($demande->status_id===9))
                        <div class="row">
                            <form method="GET" action="{{url('coordinateurChef/demandeCons/'.$demande->id.'/demande-devis')}}" enctype="multipart/form-data"> {{csrf_field()}}
                                <button class="btn btn-link" type="submit" data-md-toggle="tooltip" title="Lancer demande devis">
                                    <i data-feather="pen-tool"></i>
                                </button>
                            </form>
                            &nbsp;
                            <a class="btn btn-link" type="submit" data-md-toggle="tooltip" title="Ré-affecter" href="{{url('coordinateurChef/demandeCons/'.$demande->id.'/affecter')}}">
                                <i data-feather="corner-down-right"></i>
                            </a>
                            &nbsp;
                            <form method="POST" action="{{url('coordinateurChef/demandeCons/'.$demande->id.'/cloturer')}}" enctype="multipart/form-data"> {{csrf_field()}}
                                <button class="btn btn-link" type="submit" data-mdb-toggle="tooltip" title="Cloturer">
                                    <i data-feather="lock"></i>
                                </button>
                            </form>
                            &nbsp;
                            <a class="btn btn-link" data-md-toggle="tooltip" title="Liste demandes infos complémentaires" href="{{url('coordinateurChef/demandeCons/'.$demande->id.'/liste_demandes_infos')}}">
                                <i data-feather="list"></i>
                            </a>
                        </div>
                        @elseif(($demande->status_id===4)||($demande->status_id===5))
                        @elseif($demande->status_id===6)
                        <div class="row">
                            <form method="GET" action="{{url('coordinateurChef/demandeCons/'.$demande->id.'/demande-devis')}}" enctype="multipart/form-data"> {{csrf_field()}}
                                <button class="btn btn-link" type="submit" data-md-toggle="tooltip" title="Lancer demande devis">
                                    <i data-feather="pen-tool"></i>
                                </button>
                            </form>
                            &nbsp;
                            <a class="btn btn-link" type="submit" data-md-toggle="tooltip" title="Demande infos complémentaires" href="{{url('coordinateurChef/demandeCons/'.$demande->id.'/enAttenteInfos')}}">
                                <i data-feather="help-circle"></i>
                            </a>
                            &nbsp;
                            <a class="btn btn-link" type="submit" data-md-toggle="tooltip" title="Ré-affecter" href="{{url('coordinateurChef/demandeCons/'.$demande->id.'/affecter')}}">
                                <i data-feather="corner-down-right"></i>
                            </a>
                            &nbsp;
                            <form method="POST" action="{{url('coordinateurChef/demandeCons/'.$demande->id.'/cloturer')}}" enctype="multipart/form-data"> {{csrf_field()}}
                                <button class="btn btn-link" type="submit" data-md-toggle="tooltip" title="Cloturer">
                                    <i data-feather="lock"></i>
                                </button>
                            </form>
                        </div>
                        @endif
                        @endif
                    </td>
                    </tr>
                    @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
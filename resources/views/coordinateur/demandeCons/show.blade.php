@extends('layouat.layoutCoordinateur')
@section('contenu')
<div class="card">
    <div class="card-body row">
        <div class="col-6">
            <div class="user-avatar-section">
                <div class="d-flex justify-content-start">
                    <img class="img-fluid rounded" src="{{asset('uploads/users/'.($dossier->user->image??'user.png'))}}" height="55px" width="55px" alt="avatar" />
                    <div class="d-flex flex-column ml-1">
                        <div class="user-info mb-1">
                            <h4 class="mb-0">Dossier médical n°: {{$dossier->id}}: {{$dossier->user->prenom}} {{$dossier->user->nom}}</h4>
                            <span class="card-text">{{$dossier->user->email}}</span>
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
                    <p class="card-text mb-0">{{$dossier->user->Country->lib}}</p>
                </div>
                <div class="d-flex flex-wrap">
                    <div class="user-info-title">
                        <i data-feather="phone" class="mr-1"></i>
                        <span class="card-text user-info-title font-weight-bold mb-0">Tel: </span>
                    </div>
                    <p class="card-text mb-0">{{$dossier->user->tel}}</p>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="card">
    <div class="card-body table-responsive">
        <table id="myTable" class="table">
            <thead>
                <tr>
                    <th>Objet</th>
                    <th>Status demande</th>
                    <th>coordinateur en charge</th>
                    <th>Utilisateur</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($demandes as $demande)
                <tr>
                    <td>
                        <a href="{{url('coordinateur/demandeCons/demande/'.$demande->id)}}">{{$demande->objet}}</a>
                    </td>
                    <td>
                        @switch($demande->status_id)
                        @case(1) <span class="badge badge-rounded badge-light-danger mr-1"> {{$demande->Status->lib}}</span> @break
                        @case(2) <span class="badge badge-rounded badge-light-success mr-1">{{$demande->Status->lib}}</span> @break
                        @case(3) <span class="badge badge-rounded badge-light-warning mr-1">{{$demande->Status->lib}}</span> @break
                        @case(5) <span class="badge badge-rounded badge-light-secondary mr-1">{{$demande->Status->lib}}</span> @break
                        @case(6) <span class="badge badge-rounded badge-light-success mr-1">{{$demande->Status->lib}}</span> @break
                        @case(9) <span class="badge badge-rounded badge-light-success mr-1">{{$demande->Status->lib}}</span> @break
                        @default {{$demande->Status->lib}} @break
                        @endswitch
                    </td>
                    <td>@if($demande->coordinateur_en_charge)
                        {{$demande->coordinateurEnCharge->prenom}} {{$demande->coordinateurEnCharge->nom}}
                        @endif
                    </td>
                    <td>{{$demande->user}}</td>
                    <td>
                        @if(($demande->coordinateur_en_charge===null)&&($demande->status_id===1))
                        <div class="row">
                            <form method="POST" action="{{url('coordinateur/prendre-en-charge/'.$demande->id)}}" enctype="multipart/form-data"> {{csrf_field()}}
                                <button class="btn btn-link" type="submit" data-md-toggle="tooltip" title="Prendre en charge">
                                    <i data-feather="check"></i>
                                </button>
                            </form>
                        </div>
                        @elseif($demande->coordinateur_en_charge===Auth::user()->id)
                        @if($demande->status_id===2)
                        <div class="row">
                            <form method="GET" action="{{url('coordinateur/demandeCons/'.$demande->id.'/demande-devis')}}" enctype="multipart/form-data"> {{csrf_field()}}
                                <button class="btn btn-link" type="submit" data-md-toggle="tooltip" title="Lancer demande devis">
                                    <i data-feather="pen-tool"></i>
                                </button>
                            </form>
                            <a class="btn btn-link" type="submit" data-md-toggle="tooltip" title="Demande infos complémentaires" href="{{url('coordinateur/demandeCons/'.$demande->id.'/enAttenteInfos')}}">
                                <i data-feather="help-circle"></i>
                            </a>
                        </div>
                        @elseif(($demande->status_id===3)||($demande->status_id===9))
                        <div class="row">
                            <div class="col-4">
                                <form method="GET" action="{{url('coordinateur/demandeCons/'.$demande->id.'/demande-devis')}}" enctype="multipart/form-data"> {{csrf_field()}}
                                    <button class="btn btn-link" type="submit" data-md-toggle="tooltip" title="Lancer demande devis">
                                        <i data-feather="pen-tool"></i>
                                    </button>
                                </form>
                            </div>
                            <div class="col-4">
                                <form method="POST" action="{{url('coordinateur/demandeCons/'.$demande->id.'/cloturer')}}" enctype="multipart/form-data"> {{csrf_field()}}
                                    <button class="btn btn-link" type="submit" data-mdb-toggle="tooltip" title="Cloturer">
                                        <i data-feather="lock"></i>
                                    </button>
                                </form>
                            </div>
                            <div class="col-4">
                                <a class="btn btn-link" data-md-toggle="tooltip" title="Ré-affecter" href="{{ url('coordinateur/demandeCons/'.$demande->id.'/affecter') }}">
                                    <i data-feather="corner-down-right"></i>
                                </a>
                            </div>
                        </div>
                        @elseif(($demande->status_id===4)||($demande->status_id===5))
                        @elseif($demande->status_id===6)
                        <div class="row">
                            <form method="GET" action="{{url('coordinateur/demandeCons/'.$demande->id.'/demande-devis')}}" enctype="multipart/form-data"> {{csrf_field()}}
                                <button class="btn btn-link" type="submit" data-md-toggle="tooltip" title="Lancer demande devis">
                                    <i data-feather="pen-tool"></i>
                                </button>
                            </form>
                            <a class="btn btn-link" type="submit" data-md-toggle="tooltip" title="Demande infos complémentaires" href="{{url('coordinateur/demandeCons/'.$demande->id.'/enAttenteInfos')}}">
                                <i data-feather="help-circle"></i>
                            </a>
                            <a class="btn btn-link" data-md-toggle="tooltip" title="Ré-affecter" href="{{ url('coordinateur/demandeCons/'.$demande->id.'/affecter') }}">
                                <i data-feather="corner-down-right"></i>
                            </a>
                            <form method="POST" action="{{url('coordinateur/demandeCons/'.$demande->id.'/cloturer')}}" enctype="multipart/form-data"> {{csrf_field()}}
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
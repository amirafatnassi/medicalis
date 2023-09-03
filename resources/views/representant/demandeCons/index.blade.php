@extends('menus.layoutRepresentant')
@section('contenu')
<div class="content-body">
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
                                <th>Demandes de consultations</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($dossiers as $dossier)
                            <tr>
                                <td>
                                    @if($dossier->image!==null)
                                    <img src="{{asset('uploads/dossier/'.$dossier->image)}}" class="mr-75" height="40" width="40" alt="" />
                                    @else
                                    <img src="{{asset('uploads/dossier/user.png')}}" class="mr-75" height="40" width="40" alt="" />
                                    @endif
                                    {{$dossier->id}}
                                </td>
                                <td>{{$dossier->prenom}} {{$dossier->nom}}</td>
                                </td>
                                <td>{{$dossier->convention}}</td>
                                <td>
                                    @if($dossier->nb_demandes!==0)
                                    <a href="{{ url('representant/demandeCons/'.$dossier->id.'/show')}}" class="nav-link" role="button">
                                        Demandes de consultations
                                        <span class="badge bg-danger ms-2">{{$dossier->nb_demandes}}</span>
                                    </a>
                                    @endif
                                </td>
                                <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn btn-sm dropdown-toggle hide-arrow" data-toggle="dropdown">
                                            <i data-feather="more-vertical"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a href="{{ url('representant/demandeCons/'.$dossier->id.'/create')}}" class="dropdown-item">
                                                <i data-feather="plus-circle" class="mr-50"></i>Nouvelle demande de consultation
                                            </a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
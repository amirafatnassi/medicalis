@extends('layouat.layaoutPatient')
@section('contenu')

<div class="col-12">
    <a href="{{ url('patient/demandeCons/'.$dossier->id.'/create')}}" class="btn btn-primary">
        <i data-feather="plus-circle" class="mr-50"></i>Nouvelle demande de consultation
    </a>
</div>
<div class="card">
    <div class="card-body table-responsive">
        <table class="table align-middle mb-0 bg-white">
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
                @forelse($demandes as $demande)
                <tr>
                    <td>
                        <a href="{{url('patient/demandeCons/demande/'.$demande->id)}}">{{$demande->objet}}</a>
                    </td>
                    <td class="align-middle">
                        @switch($demande->status_id)
                        @case(1) <span class="badge badge-pill badge-light-danger mr-1">{{$demande->Status->lib}}</span>
                        @break
                        @case(2) <span class="badge badge-pill badge-light-success mr-1">{{$demande->Status->lib}}</span>
                        @break
                        @case(3) <span class="badge badge-pill badge-light-warning mr-1">{{$demande->Status->lib}}</span>
                        @break
                        @case(4) <span class="badge badge-pill badge-light-secondary mr-1">{{$demande->Status->lib}}</span>
                        @break
                        @case(6) <span class="badge badge-pill badge-light-success mr-1">{{$demande->Status->lib}}</span>
                        @break
                        @case(7) <span class="badge badge-pill badge-light-success mr-1"> {{$demande->Status->lib}}</span>
                        @break
                        @case(8) <span class="badge badge-pill badge-light-success mr-1"> {{$demande->Status->lib}}</span>
                        @break
                        @case(9) <span class="badge badge-pill badge-light-success mr-1"> {{$demande->Status->lib}}</span>
                        @break
                        @default {{$demande->Status->lib}} @break
                        @endswitch
                    </td>
                    <td>@if($demande->coordinateur_en_charge){{$demande->coordinateurEnCharge->prenom}} {{$demande->coordinateurEnCharge->nom}}@endif</td>
                    <td>{{$demande->createdBy->prenom}} {{$demande->createdBy->nom}}</td>
                    <td>
                        @switch($demande->status_id)
                        @case(1)
                        @case(2)
                        @case(3)
                        @case(6)
                        @case(9)
                        <div class="row">
                            <form method="POST" action="{{url('patient/demandeCons/'.$demande->id.'/cloturer')}}" enctype="multipart/form-data"> {{csrf_field()}}
                                <button class="btn btn-link" type="submit" data-md-toggle="tooltip" title="Cloturer">
                                    <i data-feather="lock"></i>
                                </button>
                            </form>
                        </div>
                        @default
                        @endswitch
                    </td>
                </tr>
                @empty<span class="badge badge-danger">Liste de patients vide !</span>
                @endforelse
            </tbody>
        </table>
    </div>

</div>
@endsection
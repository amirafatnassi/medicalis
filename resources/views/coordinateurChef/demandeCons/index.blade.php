@extends('menus.layoutCoordinateurChef')
@section('contenu')
<div class="card">
    <div class="table-responsive">
        <table id="myTable" class="table">
            <thead>
                <tr>
                    <th>Patient</th>
                    <th>Convention</th>
                    <th>Demandes de consultations</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($dossiers as $dossier)
                <tr>
                    <td>
                        @if($dossier->image!==null)
                        <img src="{{asset('uploads/dossier/'.$dossier->image)}}" class="shadow-1-strong rounded-circle" alt="avatar 1" style="width: 40px; height: 40px;">
                        @else
                        <img src="{{asset('uploads/dossier/user.png')}}" class="shadow-1-strong rounded-circle" style="width: 40px; height: 40px;">
                        @endif
                        <span class="ms-2">{{$dossier->id}}: {{$dossier->prenom}} {{$dossier->nom}}</span>
                    </td>
                    <td>{{$dossier->convention}}</td>
                    <td>
                        @if($dossier->nb_demandes!==0)
                        <a href="{{ url('coordinateurChef/demandeCons/'.$dossier->id.'/show')}}" class="btn btn-link" role="button">
                            Demandes de consultations
                            <span class="badge bg-danger ms-2">{{$dossier->nb_demandes}}</span>
                        </a>
                        @endif
                    </td>
                    <td>
                        @if($dossier->created_by===Auth()->user()->id)
                        <div class="row">
                            <a class="btn btn-link" href="{{ url('coordinateurChef/demandeCons/'.$dossier->id.'/create')}}" data-mdb-toggle="tooltip" title="add">
                                <i data-feather="plus-circle"></i>
                            </a>
                        </div>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
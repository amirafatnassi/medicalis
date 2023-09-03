@extends('layouat.layaoutMedecin')
@section('contenu')
<div class="card">
    <div class="card-header">
        <div class="card-title">Mes patients</div>
    </div>
    <div class="card-body table-responsive">
        <table id="myTable" class="table">
            <thead>
                <tr>
                    <th>Identifiant</th>
                    <th>Patients</th>
                    <th>Convention</th>
                    <th>Historiques</th>
                    <th>Antécédants</th>
                    <th>Discussion</th>
                    <th>Edit</th>
                    <th>Suspendre</th>
                    <th>Avatar</th>
                </tr>
            </thead>
            <tbody>
                @forelse($dossiers as $dossier)
                <tr>
                    <td><a href="{{url('medecin/show/'.$dossier->id)}}" class="btn btn-primary">ID:{{$dossier->id}}</a></td>
                    <td>{{$dossier->user->prenom}} {{$dossier->user->nom}}</td>
                    <td>@if($dossier->convention_id){{$dossier->Convention->lib}}@endif</td>
                    <td><a href="{{ url('medecin/'.$dossier->id.'/historiques')}}" class="btn btn-primary">Historiques</a></td>
                    <td><a href="{{ url('medecin/'.$dossier->id.'/effetsmarquants')}}" class="btn btn-primary">Antécédants</a></td>
                    <td>
                        <a href="{{url('/medecin/forumMedPatient/createbyid/'.$dossier->id)}}" class="form-control btn btn-info">
                            <i data-feather="mail"></i>
                        </a>
                    </td>
                    <td><a href="{{url('medecin/edit/'.$dossier->id)}}" class="btn btn-primary">
                            <i data-feather="edit"></i></a></td>
                    <td>
                        <form action="{{ route('medecin.destroymedecin', $dossier->id) }}" method="POST" style="display:inline;"> {{ csrf_field() }} {{ method_field('DELETE') }}
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir écarter ce patient: {{ $dossier->prenom }} {{$dossier->nom}} de votre liste de patients  ?')"><i data-feather="trash"></i></button>
                        </form>
                    </td>
                    <td><img src="{{asset('uploads/dossier/'.$dossier->image)}}" width="50px;" height="50px;" alt="Avatar"></td>
                </tr>
                @empty<span class="badge badge-danger">Liste de patients vide !</span>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
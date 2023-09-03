@extends('layouat.layoutAdmin')
@section('contenu')

<div class="card">
    <div class="card-header">
        <div class="card-title col-9">Liste de médecins</div>
        <div class="col-3">
            <a href="{{url('administrateur/medecins/create')}}" class="btn btn-outline-primary">
            <i data-feather="user-plus" class="text-primary"></i> Nouveau médecin
            </a>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table id="myTable" class="table">
            <tr>
                <td>Medecin</td>
                <td>Spécialité</td>
                <td>Adresse</td>
                <td>Organisme</td>
                <td>Tel</td>
                <td>E-mail</td>
                <td>Actions</td>
            </tr>
            @foreach($medecins as $medecin)
            <tr>
                <td><a href="{{url('administrateur/medecins/show',['medecin'=>$medecin->id])}}">{{$medecin->prenom}} {{$medecin->nom}}</a></td>
                <td>{{$medecin ->Specialite->lib}} </td>
                <td>{{$medecin->Ville->name}} {{$medecin->Country->lib}}</td>
                <td>{{$medecin->Organisme->lib}}</td>
                <td>{{$medecin->tel}}</td>
                <td>{{$medecin->email}}</td>
                <td> 
                    <div class="row d-flex align-items-center justify-content-center">
                        <a class="text-success mr-1" href="{{url('administrateur/medecins/edit',['medecin'=>$medecin->id])}}"><i data-feather="edit-3"></i></a>
                        <form action="{{ route('admin.medecins.delete', $medecin->id) }}" method="POST" style="display:inline;"> {{ csrf_field() }} {{ method_field('DELETE') }}
                            <button type="submit" class="btn btn-link text-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce médecin: {{ $medecin->prenom }} {{ $medecin->nom }} ?')">
                                <i data-feather="trash"></i>
                            </button>
                        </form>
                    </div> 
                </td>
            </tr>
            @endforeach
            </table>
        </div>
    </div>
</div>
@endsection
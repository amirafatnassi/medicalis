@extends('layouat.layaoutMedecin')
@section('contenu')
<div class="card user-card">
    <div class="card-body row">
        <div class="col-6">
            <div class="user-avatar-section">
                <div class="d-flex justify-content-start">
                    <img class="img-fluid rounded" src="{{asset('uploads/users/'.($dossier->user->image??'user.png'))}}" height="104" width="104" alt="User avatar" />
                    <div class="d-flex flex-column ml-1">
                        <div class="user-info mb-1">
                            <h4 class="mb-0">Dossier médical n°: {{$dossier->id}}: {{$dossier->user->prenom}} {{$dossier->user->nom}}</h4>
                            <span class="card-text">{{$dossier->user->email}}</span>
                        </div>
                        <div class="d-flex flex-wrap">
                            <a href="" class="btn btn-primary"><i data-feather="edit-3"></i></a>
                            <a class="btn btn-outline-primary ml-1" href=""><i data-feather="printer"></i></a>
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
                    <p class="card-text mb-0">{{$dossier->user->country->lib}}</p>
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
    <div class="card-header"><div class="card-title">Examen bio n°{{$examenbio->id}}</div></div>
    <div class="card-body">
        <li class="list-group-item">
            @if($examenbio->medecin)<i data-feather="user"></i><b>Médecin: </b>{{$examenbio->medecin->prenom}} {{$examenbio->medecin->nom}}@endif
            @if($examenbio->medecin && $examenbio->medecin->specialite_id) <b>Spécialité: </b>{{$examenbio->medecin->Specialite->lib}}@endif
     @if(!is_null($examenbio->remarques))
            <b>Remarques: </b> <a href="#" class="badge badge-danger">{{$examenbio->remarques}}</a>
            @endif
        </li>
        <li class="list-group-item"><i data-feather="calendar"></i> <b>Date: </b>{{date('d/m/Y',strtotime($examenbio->date))}}</li>
        @if(!is_null($examenbio->url_bio))
        <li class="list-group-item"><b>URL Bio :</b><a href="{{url('medecin/examenbio/urlBio/'.$examenbio->id)}}">{{$examenbio->url_bio}}</a></li>
        @endif <li class="list-group-item"><b>Observation: </b>{!!$examenbio->lettre!!}

            @if($examenbio->files->count()>0)
            <div class="card-header">
                <div class="card-title">Liste de téléchargement</div>
            </div>
            <div class="card-body">
                @foreach($examenbio->files as $f)
                <div class="row">
                    <a href="{{asset('uploads/exbio/'.$f->downloads)}}"><i data-feather="paperclip" at="mr-1"></i> {{$f->downloads}}</a>
                </div>
                @endforeach
            </div>
            @endif
        </li>
        <li class="list-group-item"><b>Crée le: </b>{{date('d/m/Y',strtotime($examenbio->created_at))}} , <b>Mis à jour le: </b>{{date('d/m/Y',strtotime($examenbio->updated_at))}}</li>
    </div>
    @if (Auth::user()->id == $examenbio->id_medecin)
    <div class="card-footer">
        <a href="{{url('medecin/examenbio/edit/'.$examenbio->id)}}" class="btn  btn-block btn-primary">
            <i data-feather="edit" class="mr-1"></i> Modifier examen biologique
        </a>
    </div>
    @endif
</div>
@endsection
@extends('layouat.layaoutPatient')
@section('contenu')

<div class="card">
    <div class="card-header">
        <div class="card-title">Examen bio n° {{$examenbio->id}}</div>
    </div>
    <div class="card-body">
        <ul class="timeline">
            <li class="list-group-item">
                <b>Médecin: </b>
                @if($examenbio->id_medecin)
                {{$examenbio->medecin->prenom}} {{$examenbio->medecin->nom}}
                @endif
                @if($examenbio->id_medecin && $examenbio->medecin->specialite_id)
                <b>Spécialité: </b> {{$examenbio->medecin->Specialite->lib}}
                @endif
                @if(!is_null($examenbio->remarques))
                <a href="#" class="badge badge-danger">{{$examenbio->remarques}}</a>
                @endif
            </li>
            <li class="list-group-item"><b>Date: </b>{{date('d/m/Y',strtotime($examenbio->date))}}</li>
            <li class="list-group-item"><b>Observation: </b>{!!$examenbio->lettre!!}</li>
            @if(!is_null($examenbio->url_bio))
            <li class="list-group-item"><b>URL Bio :</b><a href="{{url('patient/examenbios/urlBio/'.$examenbio->id)}}">{{$examenbio->url_bio}}</a></li>
            @endif
            <li class="list-group-item"><b>Crée le: </b>{{date('d/m/Y',strtotime($examenbio->created_at))}} / <b>Mis à jour le: </b>{{date('d/m/Y',strtotime($examenbio->updated_at))}}</li>
        </ul>
        @if($examenbio->files->count()!=0)
        <div class="card-header">
            <div class="card-title">Liste de téléchargements</div>
        </div>
        <div class="card-body">
            @foreach($examenbio->files as $f)
            <div class="row">
                <a href="{{url('uploads/exbio/'.$f->downloads)}}"> <i data-feather="paperclip"></i> {{$f->downloads}}</a>
            </div>
            @endforeach
        </div>
        @endif
    </div>
    <div class="card-footer">
        @if($examenbio->remarques == "saisie par le patient !")
        <a href="{{url('patient/examenbios/edit/'.$examenbio->id)}}" class="btn  btn-block btn-primary">
            <i data-feather="edit" class="mr-1"></i> Modifier examen biologique
        </a>
        @endif
    </div>
</div>
@endsection
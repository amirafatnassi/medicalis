@extends('menus.layoutRepresentant')
@section('contenu')
<div class="card user-card">
    <div class="card-body">
        <div class="row">
            <div class="col-xl-6 col-lg-12 d-flex flex-column justify-content-between border-container-lg">
                <div class="user-avatar-section">
                    <div class="d-flex justify-content-start">
                        <img class="img-fluid rounded" src="{{asset('uploads/dossier/'.$dossier->image)}}" height="104" width="104" alt="User avatar" />
                        <div class="d-flex flex-column ml-1">
                            <div class="user-info mb-1">
                                <h4 class="mb-0">Dossier médical n°: {{$dossier->id}}: {{$dossier->nom}} {{$dossier->prenom}}</h4>
                                <span class="card-text">{{$dossier->email}}</span>
                            </div>
                            <div class="d-flex flex-wrap">
                                <a href="" class="btn btn-primary"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pen" viewBox="0 0 16 16">
                                        <path d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001zm-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708l-1.585-1.585z" />
                                    </svg></a>
                                <a class="btn btn-outline-primary ml-1" href="">
                                    <i data-feather="printer" class="mr-1"></i>
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
<ul class="timeline">
    @if(!is_null($examenbio->med))
    <div class="row"><i data-feather="user"></i><b><u>Médecin: </u></b>{{$examenbio->med}} &nbsp; <b><u>Spécialité: </u></b> {{$examenbio->specialite}}</div>
    @endif
    <div class="row"><i data-feather="calendar"></i> <b><u>Date: </u></b>{{date('d/m/Y',strtotime($examenbio->date))}}</div>
    @if(!is_null($examenbio->url_bio))
    <div class="row"><b><u>URL Bio :</u></b><a href="https://{{$examenbio->url_bio}}" target="_blank">{{$examenbio->url_bio}}</a></div>
    @endif
    <div class="row"><b><u>Observation: </u></b></div>
    <div>{!!$examenbio->lettre!!}</div>
    @if(!$files->isEmpty())
    <div class="row"><b><u>Liste de téléchargement:</u></b></div>
    @foreach($files as $f)
    <div class="row">
        <a href="{{url('/uploads/exbio/'.$f->downloads)}}"><i data-feather="paperclip"></i> {{$f->downloads}}</a>
    </div>
    @endforeach
    @endif
    <div class="row"><b><u>Date de création: </u></b>{{date('d/m/Y',strtotime($examenbio->created_at))}} </div>
    <div class="row"><b><u>Dernière mise à jour: </u></b>{{date('d/m/Y',strtotime($examenbio->updated_at))}}</div>
    <div class="row"><b> <u>Saisie par:</b></u> {{$examenbio->user}}</b></div>
</ul>
@if ((Auth::user()->id == $examenbio->med) || (Auth::user()->id == $examenbio->created_by))
<div class="row">
    <a href="{{url('representant/dossiers/examenbios/edit/'.$examenbio->id)}}" class="btn  btn-block btn-primary">
        <i data-feather="edit" class="mr-1"></i> Modifier examen biologique
    </a>
</div>
@endif
</section>
</div>
</div>
</div>
@endsection
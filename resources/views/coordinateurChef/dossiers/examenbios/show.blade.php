@extends('menus.layoutCoordinateurChef')
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
                                <a href="{{url('coordinateurChef/dossiers/edit/'.$dossier->id)}}" class="btn btn-primary"> <i data-feather="edit-2"></i></a>
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
    @if(!is_null($examenbio->medecin))
    <div class="row"><i data-feather="user"></i><b><u>Médecin: </u></b>{{$examenbio->medecin}} &nbsp; <b><u>Spécialité: </u></b> {{$examenbio->specialite}}</div>
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
    <a href="{{url('coordinateurChef/dossiers/examenbios/edit/'.$examenbio->id)}}" class="btn  btn-block btn-primary">
        <i data-feather="edit" class="mr-1"></i> Modifier examen biologique
    </a>
</div>
@endif
</section>
</div>
</div>
</div>
@endsection
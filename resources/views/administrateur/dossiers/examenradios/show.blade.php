@extends('layouat.layoutAdmin')
@section('contenu')
<div class="card user-card">
    <div class="card-body row">
        <div class="col-6">
            <div class="user-avatar-section">
                <div class="d-flex justify-content-start">
                    @if($dossier->image!=null)
                    <img class="img-fluid rounded" src="{{asset('uploads/dossier/'.$dossier->image)}}" height="105" width="105" alt="avatar" />
                    @else
                    <img class="img-fluid rounded" src="{{asset('uploads/dossier/user.png')}}" height="105" width="105" alt="avatar" />
                    @endif
                    <div class="d-flex flex-column ml-1">
                        <div class="user-info mb-1">
                            <h4 class="mb-0">Dossier médical n°: {{$dossier->id}}: {{$dossier->nom}} {{$dossier->prenom}}</h4>
                            <span class="card-text">{{$dossier->email}}</span>
                        </div>
                        <div class="d-flex flex-wrap">
                            <a href="" class="btn btn-primary"><i data-feather="edit-3"></i></a>
                            <a class="btn btn-outline-primary ml-1">
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
<div class="card">
    <div class="card-header">
        <div class="card-title">Examen radio</div>
    </div>
    <div class="card-body">
        @if($examenradio->id_medecin)
        <div class="row"><i data-feather="user"></i><b><u>Médecin: </u></b>{{$examenradio->medecin->prenom}} {{$examenradio->medecin->nom}}</div>
        @endif
        <div class="row"><i data-feather="calendar"></i> <b><u>Date: </u></b>{{date('d/m/Y',strtotime($examenradio->date))}}</div>
        @if($examenradio->url_radio)
        <div class="row"><b><u>URL Radio :</u></b><a href="https://{{$examenradio->url_radio}}" target="_blank">{{$examenradio->url_radio}}</a></div>
        @endif
        <div class="row"><b><u>Modalité: </u></b>{{$examenradio->typeradio->lib}} &nbsp; <b><u>Radio: </u></b>{{$examenradio->Radio->lib}} @if(!is_null($examenradio->radio2)) &nbsp; {{$examenradio->radio2}} @endif</div>
        @if($examenradio->lettre)
        <div class="row"><b><u>Observation: </u></b>{!!$examenradio->lettre!!}</div>
        @endif
        @if($examenradio->imagerie)
        <div class="row">
            <b><u>Imagerie: </u></b>
            <a href="{{url('/uploads/imagerie/'.$examenradio->imagerie)}}" class="ml-2"><i data-feather="paperclip"></i> {{$examenradio->imagerie}}</a>
        </div>
        @endif
        @if(!empty($files))
        <div class="card">
            <div class="card-header">
                <div class="card-title">Liste de téléchargement</div>
            </div>
            <div class="card-body">
                @foreach($files as $f)
                <div class="row">
                    <a href="{{url('/uploads/exradio/'.$f->downloads)}}" class="ml-2"><i data-feather="paperclip"></i> {{$f->downloads}}</a>
                </div>
                @endforeach
            </div>

        </div>
        @endif
        <div class="row"><b><u>Date de création: </u></b>{{date('d/m/Y',strtotime($examenradio->created_at))}} </div>
        <div class="row"><b><u>Dernière mise à jour: </u></b>{{date('d/m/Y',strtotime($examenradio->updated_at))}}</div>
        @if($examenradio->createdBy)
        <div class="row"><b> <u>Saisie par:</b></u> {{$examenradio->createdBy->prenom}} {{$examenradio->createdBy->prenom}}</b></div>
        @endif

        <div class="row">
            <a href="{{url('administrateur/dossiers/examenradios/edit/'.$examenradio->id)}}" class="btn  btn-block btn-primary">
                <i data-feather="edit" class="mr-1"></i> Modifier examen radio
            </a>
        </div>
    </div>
</div>
@endsection
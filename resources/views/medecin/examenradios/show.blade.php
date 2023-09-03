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
    <div class="card-header">
        <div class="card-title">Examen radio</div>
    </div>
    <div class="card-body">
        <div class="row">
            @if($examenradio->medecin)
            <i data-feather="user"></i> <b>Médecin: </b>{{$examenradio->medecin->prenom}} {{$examenradio->medecin->nom}} 
            @endif
            @if($examenradio->medecin && $examenradio->medecin->specialite_id)
            <b>Spécialité: </b>{{$examenradio->medecin->Specialite->lib}} {{$examenradio->medecin->nom}}
            @endif
            @if($examenradio->remarques)
            <a href="#" class="badge badge-danger">{{$examenradio->remarques}}</a>
            @endif
        </div>
        <div class="row"><i data-feather="calendar"></i> <b>Date: </b>{{date('d/m/Y',strtotime($examenradio->date))}}</div>
        @if($examenradio->url_radio)
        <div class="row"><b>URL Radio :</b><a href="{{$examenradio->url_radio}}" target="_blank">{{$examenradio->url_radio}}</a></div>
        @endif
        <div class="row"><b>Modalité: </b>{{$examenradio->typeradio->lib}}</div>
        <div class="row"><b>Radio: </b>{{$examenradio->Radio->lib}} @if(!is_null($examenradio->radio2)) &nbsp; {{$examenradio->radio2}} @endif</div>
        <div class="row"><b>Observation: </b></div>
        <div class="row">{!!$examenradio->lettre!!}</div>

        @if($examenradio->files->count()!=0)
        <div class="card-header"><div class="card-title">Liste de téléchargements</div></div>
        <div class="card-body">
            @foreach($examenradio->files as $f)
            <div class="row">
                <a href="{{url('/uploads/exradio/'.$f->downloads)}}"> <i data-feather="paperclip"></i> {{$f->downloads}}</a>
            </div>
            @endforeach
        </div>
        @endif

        <div class="row"><b>Crée le: </b>{{date('d/m/Y',strtotime($examenradio->created_at))}} ,<b>Mis à jour le: </b>{{date('d/m/Y',strtotime($examenradio->updated_at))}}</div>
    </div>

    @if (Auth::user()->id == $examenradio->id_medecin)
    <div class="card-footer">
        <a href="{{url('medecin/examenradio/edit/'.$examenradio->id)}}" class="btn  btn-block btn-primary">
            <i data-feather="edit"></i> Modifier examen radio
        </a>
    </div>
    @endif
</div>
@endsection
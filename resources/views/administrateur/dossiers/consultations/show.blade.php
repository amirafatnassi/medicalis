@extends('layouat.layoutAdmin')
@section('contenu')
<div class="card user-card">
    <div class="card-body">
        <div class="row">
            <div class="col-6">
                <div class="user-avatar-section">
                    <div class="d-flex justify-content-start">
                        @if($dossier->image!=null)
                        <img class="img-fluid rounded" src="{{asset('uploads/dossier/'.$dossier->image)}}" height="105" width="105" alt="avatar" />
                        @else
                        <img class="img-fluid rounded" src="{{asset('uploads/dossier/user.png')}}" height="105" width="105" alt="avatar" />
                        @endif <div class="d-flex flex-column ml-1">
                            <div class="user-info mb-1">
                                <h4 class="mb-0">Dossier médical n°: {{$dossier->id}}: {{$dossier->nom}} {{$dossier->prenom}}</h4>
                                <span class="card-text">{{$dossier->email}}</span>
                            </div>
                            <div class="d-flex flex-wrap">
                                <a href="" class="btn btn-primary">
                                    <i data-feather="edit-2"></i>
                                </a>
                                <a class="btn btn-outline-primary ml-1" href="">
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
</div>
<div class="card">
    <div class="card-header">
        <div class="card-title">Consultation</div>
    </div>
    <div class="card-body">
        @if(!is_null($consultation->medecin))
        <div class="row">
            <i data-feather="user"></i> <b><u>Médecin: </u></b> {{$consultation->medecin->prenom}} {{$consultation->medecin->nom}} <b class="ml-2"><u>Spécialité: </u></b> {{$consultation->medecin->specialty->lib}}
        </div>
        @endif
        @if($consultation->motif)
        <div class="row"><b><u>Motif: </u></b> {{$consultation->Motif->lib}}</div>
        @endif
        <div class="row">
            @if($consultation->taille)
            <div class="col-4 text-center">
                <p><b>Taille</b></p>
                <h2><span class="badge bg-secondary">{{$consultation->taille}}</span></h2>
            </div>
            @endif
            @if($consultation->poids)
            <div class="col-4 text-center">
                <p><b>Poids</b></p>
                <h2><span class="badge bg-secondary">{{$consultation->poids}}</span></h2>
            </div>
            @endif
            @if($consultation->ta)
            <div class="col-4 text-center">
                <p><b>TA</b></p>
                <h2><span class="badge bg-secondary">{{$consultation->ta}}</span></h2>
            </div>
            @endif
        </div>
        <div class="row">
            <b><u>Date:</u> </b>
            {{date('d/m/Y',strtotime($consultation->date))}}
        </div>
        <div class="row"><b><u>Observation: </u></b></div>
        <div class="row">
            {!!$consultation->observation!!}
        </div>
        @if($consultation->files->count()>0)
        <div class="row"><b><u>Liste de téléchargement:</u></b></div>
        @foreach($consultation->files as $f)
        <div class="row">
            <a href="{{url('/uploads/consultation/'.$f->downloads)}}"><i data-feather="paperclip"></i> {{$f->downloads}}</a>
        </div>
        @endforeach
        @endif
        @if(($consultation->observation_prive)&&($consultation->id_medecin==Auth::user()->id))
        <div class="row">
            <b style="color:red"><u>Observation privée: </u></b>
            <small>( affiché pour vous uniquement ):</small>
            {!!$consultation->observation_prive!!}
        </div>
        @endif
        @if($consultation->effet_marquant_txt)
        <div class="row">
            <b style="color:red"><u>Antécédant: </u></b>
            <small>( tout ce qui est affiché en antécédent sera répertorié dans l'historique du patient ):</small>
            {!!$consultation->effet_marquant_txt!!}
        </div>
        @endif
        <div class="row"><b><u>Date de création: </u></b>{{date('d/m/Y',strtotime($consultation->created_at))}} </div>
        <div class="row"><b><u>Dernière mise à jour: </u></b>{{date('d/m/Y',strtotime($consultation->updated_at))}}</div>
        <div class="row"><b> <u>Saisie par:</b></u> {{$consultation->remarques}}</b></div>
    </div>
    <div class="card-footer">
        <div class="row">
            <div class="col-6">
                <a href="{{url('administrateur/dossiers/consultations/edit/'.$consultation->id)}}" class="btn  btn-block btn-primary">
                    <i data-feather="edit" class="mr-1"></i> Modifier consultation
                </a>
            </div>
            <div class="col-6">
                <a href="{{url('administrateur/dossiers/consultations/imprimer/'.$consultation->id)}}" class="btn  btn-block btn-primary">
                    <i data-feather="printer"></i> Imprimer consultation
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
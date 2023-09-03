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
    @if(!is_null($consultation->medecin))
    <div class="row">
        <i data-feather="user"></i> <b><u>Médecin: </u></b> {{$consultation->medecin}} &nbsp; <b><u>Spécialité: </u></b> {{$consultation->specialite}}
    </div>
    @endif
    @if(!is_null($consultation->motif))
    <div class="row"><b><u>Motif: </u></b> {{$consultation->motif}}</div>
    @endif
    <div class="row">
        @if(!is_null($consultation->taille))
        <div class="col-4">
            <center>
                <p><b>Taille</b></p>
                <h2><span class="badge bg-secondary">{{$consultation->taille}}</span></h2>
            </center>
        </div>
        @endif
        @if(!is_null($consultation->poids))
        <div class="col-4">
            <center>
                <p><b>Poids</b></p>
                <h2><span class="badge bg-secondary">{{$consultation->poids}}</span></h2>
            </center>
        </div>
        @endif
        @if(!is_null($consultation->ta))
        <div class="col-4">
            <center>
                <p><b>TA</b></p>
                <h2><span class="badge bg-secondary">{{$consultation->ta}}</span></h2>
            </center>
        </div>
        @endif
    </div>
    <div class="row">
        <b><u>Date:</u> </b>
        {{date('d/m/Y',strtotime($consultation->date))}}
    </div>
    <div class="row">
        <b><u>Observation: </u></b>
    </div>
    <div>
        {!!$consultation->observation!!}
    </div>
    @if(!$files->isEmpty())
    <div class="row"><b><u>Liste de téléchargement:</u></b></div>
    @foreach($files as $f)
    <div class="row">
        <a href="{{url('/uploads/consultation/'.$f->downloads)}}"><i data-feather="paperclip"></i> {{$f->downloads}}</a>
    </div>
    @endforeach
    @endif
    @if(!is_null($consultation->observation_prive)&&($consultation->id_medecin==Auth::user()->id))
    <div class="row">
        <b style="color:red"><u>Observation privée: </u></b>
        <small>( affiché pour vous uniquement ):</small>
        {!!$consultation->observation_prive!!}
    </div>
    @endif
    @if(!is_null($consultation->effet_marquant_txt))
    <div class="row">
        <b style="color:red"><u>Antécédant: </u></b>
        <small>( tout ce qui est affiché en antécédent sera répertorié dans l'historique du patient ):</small>
        {!!$consultation->effet_marquant_txt!!}
    </div>
    @endif
    <div class="row"><b><u>Date de création: </u></b>{{date('d/m/Y',strtotime($consultation->created_at))}} </div>
    <div class="row"><b><u>Dernière mise à jour: </u></b>{{date('d/m/Y',strtotime($consultation->updated_at))}}</div>
    <div class="row"><b> <u>Saisie par:</b></u> {{$consultation->user}}</b></div>
</ul>

<div class="row">
    @if ((Auth::user()->id == $consultation->id_medecin) || (Auth::user()->id == $consultation->created_by))
    <div class="col-6"> <a href="{{url('representant/dossiers/consultations/edit/'.$consultation->id)}}" class="btn  btn-block btn-primary">
            <i data-feather="edit" class="mr-1"></i> Modifier consultation
        </a></div>
    @endif
    <div class="col-6">
        <a href="{{url('representant/dossiers/consultations/imprimer/'.$consultation->id)}}" class="btn  btn-block btn-primary">
            <i data-feather="printer" class="mr-1"></i> Imprimer consultation
        </a>
    </div>
</div>
</section>
</div>
</div>
</div>
@endsection
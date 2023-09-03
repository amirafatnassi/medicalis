@extends('layouat.layoutCoordinateur')
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
                            <a href="" class="btn btn-primary"> <i data-feather="edit-3"></i></a>
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
                    <p class="card-text mb-0">{{$dossier->user->Country->lib}}</p>
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
        <div class="card-title">Consultation n° {{$consultation->id}}</div>
    </div>
    <li class="list-group-item">
        @if ($consultation->medecin && $consultation->medecin->role_id==3)
        <b>Médecin: </b>{{$consultation->medecin->prenom}} {{$consultation->medecin->nom}}
        @endif
        @if ($consultation->medecin && $consultation->medecin->specialite_id)
        <b>Spécialité: </b>{{$consultation->medecin->Specialite->lib}}
        @endif
        @if($consultation->remarques)
        <b>Remarques:</b> <a href="#" class="badge badge-danger">{{$consultation->remarques}}</a>
        @endif
    </li>
    @if($consultation->motif)
    <li class="list-group-item"><b>Motif:</b> {{$consultation->Motif->lib}}</li>
    @endif
    <li class="list-group-item">
        <div class="card-group">
            @if($consultation->taille)
            <div class="card">
                <div class="card-body text-center">
                    <p class="card-title"><b>Taille</b></p>
                    <a href="#" class="btn btn-primary">{{$consultation->taille}}</a>
                </div>
            </div>
            @endif
            @if($consultation->poids)
            <div class="card">
                <div class="card-body text-center">
                    <p class="card-title"><b>Poids</b></p>
                    <a href="#" class="btn btn-primary">{{$consultation->poids}}</a>
                </div>
            </div>
            @endif
            @if($consultation->ta)
            <div class="card">
                <div class="card-body text-center">
                    <p class="card-title"><b>TA</b></p>
                    <a href="#" class="btn btn-primary">{{$consultation->ta}}</a>
                </div>
            </div>
            @endif
        </div>
    </li>
    <li class="list-group-item"><b>Date: </b>{{date('d/m/Y',strtotime($consultation->date))}}</li>
    <div class="list-group-item"><b>Observation: </b>{!!$consultation->observation!!}</div>
    @if($consultation->files->count()!=0)
    <div class="card-header">
        <div class="card-title">Liste de téléchargements</div>
    </div>
    <div class="card-body">

        @foreach($consultation->files as $f)
        <div class="row">
            <td><a href="{{url('/uploads/consultation/'.$f->downloads)}}"> <i data-feather="paperclip"></i> {{$f->downloads}}</a></td>
        </div>
        @endforeach
    </div>
    @endif
    @if($consultation->observation_prive && $consultation->id_medecin==Auth::user()->id)
    <li class="list-group-item"><b>Observation privée: <small><b class="red">( affiché pour vous uniquement )</b></small> </b>{!!$consultation->observation_prive!!}</li>
    @endif
    @if($consultation->effet_marquant && $consultation->effet_marquant_txt)
    <li class="list-group-item"><b>Antécédant: </b><small><b class="red">( tout ce qui est affiché en antécédent sera répertorié dans l'historique du patient ) </b></small>{!!$consultation->effet_marquant_txt!!}</li>
    @endif
    <li class="list-group-item"><b>Crée le: </b>{{date('d/m/Y',strtotime($consultation->created_at))}} / <b>Mis à jour le: </b>{{date('d/m/Y',strtotime($consultation->updated_at))}}</li>

    <div class="card-footer">
        <a href="{{url('coordinateur/consultation/'.$consultation->id.'/imprimer')}}" class="btn  btn-block btn-primary">
            <i data-feather="save"></i> Imprimer consultation
        </a>
    </div>
</div>
@endsection
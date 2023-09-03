@extends('layouat.layoutAdmin')
@section('contenu')

<div class="content-wrapper row">
    <div class="col-xl-3 col-12 order-1 order-lg-1">
        <div class="card">
            @if($dossier->image!==null)
            <img src=" {{asset('uploads/dossier/'.$dossier->image)}}" class="card-img-top" alt="avtar" style="height: 300px; object-fit: cover;">
            @else
            <img src=" {{asset('uploads/dossier/user.png')}}" class="card-img-top" alt="avatar" style="height: 300px; object-fit: cover;">
            @endif
            <div class="card-body text-center">
                <div class="card-text ">N° dossier: {{$dossier->id}}</div>
                <div>
                    <a href="{{ url('administrateur/dossiers/'.$dossier->id.'/effetsmarquants')}}" class="btn btn-outline-primary">
                        <i data-feather='archive'></i>
                    </a>
                    <a href="{{url('administrateur/forumMedPatient/createbyid/'.$dossier->id)}}" class="btn btn-outline-primary">
                        <i data-feather="message-square"></i>
                    </a>
                    <a href="{{ url('administrateur/dossiers/'.$dossier->id.'/historiques')}}" class="btn btn-outline-primary">
                        <i data-feather="clock"></i>
                    </a>
                    <a class="btn btn-outline-primary" href="{{url('administrateur/dossiers/edit/'.$dossier->id)}}">
                        <i data-feather="edit-2"></i>
                    </a>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <div class="card-title">Informations personnelles</div>
            </div>
            <div class="card-body">
                <p class="card-text">
                    <i data-feather="user"></i><b>Patient: </b>{{$dossier->patient}} @if($dossier->sexe)({{$dossier->Sexe->lib}}) @endif
                </p>
                <p class="card-text"><i data-feather="calendar"></i><b> Date de naissance: </b>{{date('d/m/Y',strtotime($dossier->datenaissance))}}</p>
                <p class="card-text"><i data-feather="map-pin"></i><b>Lieu de naissance: </b>{{$dossier->lieunaissance}}</p>
                <p class="card-text">
                    @if ($dossier->email)
                    <i data-feather="mail"></i><b> E-mail: </b><a href="{{url('mailto:'.$dossier->email)}}">{{$dossier->email}}</a>
                    @endif
                </p>
                <p class="card-text"><b><i data-feather="phone"></i> Tel: </b>{{$dossier->tel}}</p>
                <p class="card-text">@if($dossier->profession) <i data-feather="briefcase"></i> <b>Profession: </b>{{$dossier->Profession->lib}}@endif</p>
                <p class="card-text">@if($dossier->convention) <b> Convention: </b>{{$dossier->Convention->lib}}@endif</p>
                <p class="card-text">@if($dossier->contactdurgence)<i data-feather="user"></i>  <b>Contact d'urgence: </b>{{$dossier->contactdurgence}}@endif</p>
                <p class="card-text">@if($dossier->pays) <i data-feather="flag"></i><b> Pays: </b>{{$dossier->country->lib}}@endif</p>
                <p class="card-text">@if($dossier->ville) <i data-feather="map-pin"></i><b> Ville: </b>{{$dossier->Ville->name}}@endif @if($dossier->cp) <b>Code postal: </b>{{$dossier->cp}}@endif</p>
                <p class="card-text">@if($dossier->rue) {{$dossier->rue}}@endif
                <p class="card-text">@if($dossier->tel) <i data-feather="phone"></i><b> Tel: </b>{{$dossier->tel}}@endif</p>
            </div>
        </div>
    </div>
    <div class="col-xl-6 col-12 order-2 order-lg-2">
        <div class="card">
            <div class="card-body text-center">
                <a href="{{ url('administrateur/dossiers/'.$dossier->id.'/consultations/index')}}" class="btn btn-outline-secondary"><i data-feather="clipboard"></i> Consultations</a>
                <a href="{{ url('administrateur/dossiers/'.$dossier->id.'/examenbios/index')}}" class="btn btn-outline-secondary"><i data-feather="clipboard"></i> Examen bio</a>
                <a href="{{ url('administrateur/dossiers/'.$dossier->id.'/examenradios/index')}}" class="btn btn-outline-secondary"><i data-feather="clipboard"></i> Examen radio</a>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <div class="card-title">Antécédents médicaux</div>
            </div>
            <div class="card-body">
                <p class="card-text">{!!$dossier->antecedants_med!!} </p>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <div class="card-title">Antécédents chirurgicaux</div>
            </div>
            <div class="card-body">
                <p class="card-text">{!!$dossier->antecedants_chirg!!} </p>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <div class="card-title">Antécédents familiaux</div>
            </div>
            <div class="card-body">
                <p class="card-text">{!!$dossier->antecedants_fam!!} </p>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <div class="card-title">Allergies</div>
            </div>
            <div class="card-body">
                <p class="card-text">{!!$dossier->allergies!!}</p>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <div class="card-title">Indicateurs biologiques</div>
            </div>
            <div class="card-body">
                <p class="card-text">{!!$dossier->indicateur_bio!!} </p>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <div class="card-title">Traitements chroniques</div>
            </div>
            <div class="card-body">
                <p class="card-text">{!!$dossier->traitement_chr!!} </p>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-12 order-3">
        @if($dossier->files->count() === 0)
        <div class="alert alert-info">
            Ce dossier ne contient pas des compléments d'informations.
        </div>
        @else
        <div class="card">
            <div class="card-body">
                <div class="card-title">Compléments d'informations</div>
                @foreach($dossier->files as $file)
                <div class="row"><a href="{{url('/uploads/dossierFiles/'.$file->downloads)}}"><i data-feather="paperclip"></i> {{$file->downloads}}</a></div>
                @endforeach
            </div>
        </div>
        @endif
        <div class="card">
            <div class="card-header">
                <div class="card-title">Catégories</div>
            </div>
            <div class="card-body">
                <div>
                    Groupe sanguin: {{$dossier->bloodtype->lib}}
                </div>
                <div>
                    Taille: {{$dossier->taille}}
                </div>
                <div>
                    <i class="fa fa-balance-scale" aria-hidden="true"></i> Poids: {{$dossier->poids}}
                </div>
                <div>
                    Tension artérielle: {{$dossier->ta}}
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <div class="card-title">Création de dossier</div>
            </div>
            <div class="card-body">
                <div>
                    Crée le: {{date('d/m/Y',strtotime($dossier->created_at))}}
                </div>
                <div>
                    Dernière mise à jour le: {{date('d/m/Y',strtotime($dossier->updated_at))}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@extends('layouat.layoutPatientNoHeader')
@section('contenu')
    <div class="row">
        <div class="col-lg-3 col-12 order-1 order-lg-1">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-center">
                    <img src="{{ asset('uploads/users/' . ($dossier->user->image ?? 'user.png')) }}" class="card-img-top" alt="avatar" style="object-fit: cover;">
</div>
                    <div class="d-flex justify-content-center mt-1">
                        <a class="btn btn-outline-primary mx-1" href="{{url('patient/editmondossier')}}"><i data-feather="edit-2"></i></a>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header"> <div class="card-title">Informations personnelles</div> </div>
                <div class="card-body">
                    <p class="card-text"><b>Patient: </b>{{$dossier->user->prenom}} {{$dossier->user->nom}} @if(isset($dossier->user->sexe))({{$dossier->user->Sexe->lib}})@endif</p>
                    <p class="card-text"><i data-feather="calendar"></i><b> Date de naissance: </b>:{{date('d/m/Y',strtotime($dossier->user->datenaissance))}}</p>
                    <p class="card-text"><b>Lieu de naissance: </b>{{$dossier->user->lieunaissance}}</p>
                    <p class="card-text">
                        @if(isset($dossier->email))
                        <i data-feather="mail"></i><b> E-mail: </b><a href="{{url('mailto:'.$dossier->user->email)}}">{{$dossier->email}}</a>
                        @endif
                    </p>
                    <p class="card-text"><b><i data-feather="phone"></i> Tel: </b>{{$dossier->user->tel}}</p>
                    <p class="card-text">@if($dossier->user->profession) <b>Profession: </b>{{$dossier->user->Profession->lib}}@endif</p>
                    <p class="card-text">@if($dossier->convention) <b> Convention: </b>{{$dossier->convention}}@endif</p>
                    <p class="card-text">@if($dossier->contactdurgence) <b>Contact d'urgence: </b>{{$dossier->contactdurgence}}@endif</p>
                    <p class="card-text">@if($dossier->user->country_id) <i data-feather="flag"></i><b> Pays: </b>{{$dossier->user->Country->lib}}@endif</p>
                    <p class="card-text">@if($dossier->user->ville_id) <i data-feather="map-pin"></i><b> Ville: </b>{{$dossier->user->Ville->name}}@endif</p>
                    <p class="card-text">@if($dossier->user->cp) <b>Code postal: </b>{{$dossier->user->cp}}@endif</p>
                    <p class="card-text">@if($dossier->user->tel) <i data-feather="phone"></i><b> Tel: </b>{{$dossier->user->tel}}@endif</p>
                </div>
            </div>
        </div>

        <div class="col-lg-6 col-12 order-2 order-lg-2">
            <div class="card">
                <div class="card-body d-flex justify-content-center">
                    <a href="{{ url('patient/consultations/index')}}" class="btn btn-outline-secondary mr-1"><i data-feather="clipboard"></i> Consultations</a>
                    <a href="{{ url('patient/examenbios/index')}}" class="btn btn-outline-secondary mr-1"><i data-feather="clipboard"></i> Examen bio</a>
                    <a href="{{ url('patient/examenradios/index')}}" class="btn btn-outline-secondary"><i data-feather="clipboard"></i> Examen radio</a>
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
                    <p class="card-text">{!!$dossier->allergies!!} </p>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <div class="card-title">Indicateur biologiques</div>
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

        <div class="col-lg-3 col-12 order-3">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Compléments d'informations</div>
                </div>
                <div class="card-body">
                    @if(!empty($files))
                    @foreach($files as $f)
                    <div class="d-flex justify-content-start align-items-center mt-2">
                        <div class="avatar mr-75">
                            <img src="../../../app-assets/images/paperclip.png" alt="avatar" height="40" width="40" />
                        </div>
                        <div class="profile-user-info">
                            <a href="{{url('/uploads/dossierFiles/'.$f->downloads)}}">{{$f->downloads}}</a>
                        </div>
                    </div>
                    @endforeach
                    @endif
                </div>
            </div>

            <div class="card">
                <div class="card-header"><div class="card-title">Categories</div></div>
                <div class="card-body">
                    <div class="d-flex justify-content-start align-items-center mb-75">
                        <i data-feather="droplet"></i> Groupe sanguin: @if($dossier->bloodtype){{$dossier->bloodtype->lib}}@endif
                    </div>
                    <div class="d-flex justify-content-start align-items-center mb-75">
                        <i data-feather="info"></i> Taille: {{$dossier->taille}}
                    </div>
                    <div class="d-flex justify-content-start align-items-center mb-75">
                        <i data-feather="info"></i> Poids: {{$dossier->poids}}
                    </div>
                    <div class="d-flex justify-content-start align-items-center mb-75">
                        <i data-feather="info"></i> Tension artérielle: {{$dossier->ta}}
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header"><div class="card-title">Création de dossier</div></div>
                <div class="card-body">
                    <div>Crée le: {{date('d/m/Y',strtotime($dossier->created_at))}}</div>
                    <div>Mise à jour le: {{date('d/m/Y',strtotime($dossier->updated_at))}}</div>
                </div>
            </div>
        </div>
    </div>
@endsection
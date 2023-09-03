@extends('layouat.layoutCoordinateur')
@section('contenu')
<div class="content-wrapper row">
    <div class="col-xl-3 col-12 order-1 order-lg-1">
        <div class="card mb-1">
            <img src="{{ asset('uploads/users/' . ($dossier->user->image ?? 'user.png')) }}" class="card-img-top" alt="avatar" style="object-fit: cover;">
            <div class="card-body text-center">
                <div class="card-text ">N° dossier: {{$dossier->id}}</div>
                <div>
                    <a href="{{ url('coordinateur/dossiers/'.$dossier->id.'/effetsmarquants')}}" class="btn btn-outline-primary">
                        <i data-feather="archive"></i>
                    </a>
                    <a href="{{url('coordinateur/discussionsCoordPatient/createbyid/'.$dossier->id)}}" class="btn btn-outline-primary">
                        <i data-feather="message-square"></i>
                    </a>
                    <a href="{{ url('coordinateur/dossiers/'.$dossier->id.'/historiques')}}" class="btn btn-outline-primary">
                        <i data-feather="clock"></i>
                    </a>
                    <a class="btn btn-outline-primary" href="{{url('coordinateur/dossiers/edit/'.$dossier->id)}}">
                        <i data-feather="edit-2"></i>
                    </a>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <div class="card-title"> Informations personnelles</div>
            </div>
            <div class="card-body">
                <p class="card-text">
                    <b>Patient: </b>{{$dossier->user->prenom}} {{$dossier->user->nom}} @if($dossier->user->sexe_id)({{$dossier->user->Sexe->lib}}) @endif
                </p>
                <p class="card-text"><i data-feather="calendar"></i><b> Date de naissance: </b>:{{date('d/m/Y',strtotime($dossier->datenaissance))}}</p>
                <p class="card-text"><b>Lieu de naissance: </b>{{$dossier->user->lieunaissance}}</p>
                <p class="card-text">
                    @if ($dossier->user->email)
                    <i data-feather="mail"></i><b> E-mail: </b><a href="{{url('mailto:'.$dossier->email)}}">{{$dossier->user->email}}</a>
                    @endif
                </p>
                <p class="card-text"><b><i data-feather="phone"></i> Tel: </b>{{$dossier->user->tel}}</p>
                <p class="card-text">@if($dossier->user->Profession) <b>Profession: </b>{{$dossier->user->Profession->lib}}@endif</p>
                <p class="card-text">@if($dossier->contactdurgence) <b>Contact d'urgence: </b>{{$dossier->contactdurgence}}@endif</p>
                <p class="card-text">@if($dossier->user->country_id) <i data-feather="flag"></i><b> Pays: </b>{{$dossier->user->Country->lib}}@endif</p>
                <p class="card-text">@if($dossier->user->ville_id) <i data-feather="map-pin"></i><b> Ville: </b>{{$dossier->user->Ville->name}}@endif</p>
                <p class="card-text">@if($dossier->user->cp) <b>Code postal: </b>{{$dossier->user->cp}}@endif</p>
                <p class="card-text">@if($dossier->user->rue) <b>Rue: </b>{{$dossier->user->rue}}@endif</p>
            </div>
        </div>
    </div>

    <div class="col-xl-6 col-12 order-2 order-lg-2">
        <div class="card">
            <div class="card-body d-flex justify-content-center">
                <a href="{{ url('coordinateur/'.$dossier->id.'/consultation')}}" class="btn btn-outline-secondary mr-1"><i data-feather="clipboard"></i> Consultations</a>
                <a href="{{ url('coordinateur/'.$dossier->id.'/examenbio')}}" class="btn btn-outline-secondary mr-1"><i data-feather="clipboard"></i> Examen bio</a>
                <a href="{{ url('coordinateur/'.$dossier->id.'/examenradio')}}" class="btn btn-outline-secondary"><i data-feather="clipboard"></i> Examen radio</a>
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

    <div class="col-xl-3 col-12 order-3">
        @if($dossier->files->count() === 0)
        <div class="alert alert-info">
            Ce dossier ne contient pas des compléments d'informations.
        </div>
        @else
        <div class="card mb-1">
            <div class="card-header">
                <div class="card-title">Compléments d'informations</div>
            </div>
            <div class="card-body">
                @foreach($dossier->files as $f)
                <div class="row mb-1">
                    <a href="{{url('/uploads/dossierFiles/'.$f->downloads)}}"><i data-feather="paperclip"></i> {{$f->downloads}}</a>
                </div>
                @endforeach
            </div>
        </div>
        @endif

        <div class="card mb-1">
            <div class="card-header">
                <div class="card-title">Categories</div>
            </div>
            <div class="card-body">
                <div>
                    <i data-feather="droplet"></i> Groupe sanguin: @if($dossier->groupe_sanguin){{$dossier->bloodtype->lib}}@endif
                </div>
                <div>
                    <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 256 512">
                        <path d="M0 48C0 21.5 21.5 0 48 0H208c26.5 0 48 21.5 48 48V96H176c-8.8 0-16 7.2-16 16s7.2 16 16 16h80v64H176c-8.8 0-16 7.2-16 16s7.2 16 16 16h80v64H176c-8.8 0-16 7.2-16 16s7.2 16 16 16h80v64H176c-8.8 0-16 7.2-16 16s7.2 16 16 16h80v48c0 26.5-21.5 48-48 48H48c-26.5 0-48-21.5-48-48V48z" />
                    </svg> Taille: {{$dossier->taille}}
                </div>
                <div>
                    <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512">
                        <path d="M128 176a128 128 0 1 1 256 0 128 128 0 1 1 -256 0zM391.8 64C359.5 24.9 310.7 0 256 0S152.5 24.9 120.2 64H64C28.7 64 0 92.7 0 128V448c0 35.3 28.7 64 64 64H448c35.3 0 64-28.7 64-64V128c0-35.3-28.7-64-64-64H391.8zM296 224c0-10.6-4.1-20.2-10.9-27.4l33.6-78.3c3.5-8.1-.3-17.5-8.4-21s-17.5 .3-21 8.4L255.7 184c-22 .1-39.7 18-39.7 40c0 22.1 17.9 40 40 40s40-17.9 40-40z" />
                    </svg> Poids: {{$dossier->poids}}
                </div>
                <div>
                    <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 576 512">
                        <path d="M142.4 21.9c5.6 16.8-3.5 34.9-20.2 40.5L96 71.1V192c0 53 43 96 96 96s96-43 96-96V71.1l-26.1-8.7c-16.8-5.6-25.8-23.7-20.2-40.5s23.7-25.8 40.5-20.2l26.1 8.7C334.4 19.1 352 43.5 352 71.1V192c0 77.2-54.6 141.6-127.3 156.7C231 404.6 278.4 448 336 448c61.9 0 112-50.1 112-112V265.3c-28.3-12.3-48-40.5-48-73.3c0-44.2 35.8-80 80-80s80 35.8 80 80c0 32.8-19.7 61-48 73.3V336c0 97.2-78.8 176-176 176c-92.9 0-168.9-71.9-175.5-163.1C87.2 334.2 32 269.6 32 192V71.1c0-27.5 17.6-52 43.8-60.7l26.1-8.7c16.8-5.6 34.9 3.5 40.5 20.2zM480 224a32 32 0 1 0 0-64 32 32 0 1 0 0 64z" />
                    </svg> Tension artérielle: {{$dossier->ta}}
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
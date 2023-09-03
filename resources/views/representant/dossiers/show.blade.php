@extends('menus.layoutRepresentant')
@section('contenu')

<!-- BEGIN: Content-->
<div class="content-wrapper">
    <!-- profile info section -->
    <section id="profile-info">
        <div class="row">
            <!-- left profile info section -->
            <div class="col-lg-3 col-12 order-2 order-lg-1">

                <!-- about -->
                <div class="card">
                    <div class="card-body">
                        <div class="card profile-header mb-2">
                            <div class="position-relative">
                                <div class="profile-img-container d-flex align-items-center">
                                    @if($dossier->image!==null)
                                        <img src=" {{asset('uploads/dossier/'.$dossier->image)}}" class="mr-75" height="400" width="300">
                                    @else
                                    <img class="rounded img-fluid" alt="Card image" src="{{asset('uploads/dossier/user.png')}}" height="400" width="300">
                                    @endif                                   
                                </div>
                            </div>

                            <div class="row">
                                <a href="{{ url('representant/dossiers/'.$dossier->id.'/effetsmarquants')}}" class="btn btn-outiline-primary">
                                    <i data-feather='archive'></i>
                                </a>
                                <a href="{{url('representant/forumMedPatient/createbyid/'.$dossier->id)}}" class="btn btn-outiline-primary">
                                    <i data-feather="message-square"></i>
                                </a>
                                <a href="{{ url('representant/dossiers/'.$dossier->id.'/historiques')}}" class="btn btn-outiline-primary">
                                    <i data-feather="clock" class="mr-50"></i>
                                </a>
                                <a class="btn btn-outiline-primary" href="{{url('representant/dossiers/edit/'.$dossier->id)}}">
                                    <i data-feather="edit-2" class="mr-50"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <!--/ about -->


                <!-- about -->
                <div class="card">
                    <div class="card-body">
                        <div class="mt-2">
                            <h1 class="mb-75"><u><b> Informations personnelles</b></u></h1>
                            <p class="card-text">
                                <b>Patient: </b>{{$dossier->patient}} @if(!is_null($dossier->sexe))({{$dossier->sexe}}) @endif
                            </p>
                            <p class="card-text"><i data-feather="calendar"></i><b> Date de naissance: </b>:{{date('d/m/Y',strtotime($dossier->datenaissance))}}</p>
                            <p class="card-text"><b>Lieu de naissance: </b>{{$dossier->lieunaissance}}</p>
                            <p class="card-text">
                                @if (!is_null($dossier->email))
                                <i data-feather="mail"></i><b> E-mail: </b><a href="{{url('mailto:'.$dossier->email)}}">{{$dossier->email}}</a>
                                @endif
                            </p>
                            <p class="card-text"><b><i data-feather="phone"></i> Tel: </b>{{$dossier->tel}}</p>
                            <p class="card-text">@if(!is_null($dossier->profession)) <b>Profession: </b>{{$dossier->profession}}@endif</p>
                            <p class="card-text">@if(!is_null($dossier->convention)) <b> Convention: </b>{{$dossier->convention}}@endif</p>
                            <p class="card-text">@if(!is_null($dossier->contactdurgence)) <b>Contact d'urgence: </b>{{$dossier->contactdurgence}}@endif</p>
                            <p class="card-text">@if(!is_null($dossier->pays)) <i data-feather="flag"></i><b> Pays: </b>{{$dossier->pays}}@endif</p>
                            <p class="card-text">@if(!is_null($dossier->ville)) <i data-feather="map-pin"></i><b> Ville: </b>{{$dossier->ville}}@endif</p>
                            <p class="card-text">@if(!is_null($dossier->cp)) <b>Code postal: </b>{{$dossier->cp}}@endif</p>
                            <p class="card-text">@if(!is_null($dossier->tel)) <i data-feather="phone"></i><b> Tel: </b>{{$dossier->tel}}@endif</p>
                        </div>
                    </div>
                    <!--/ about -->
                </div>
                <!--/ left profile info section -->
            </div>
            <!-- center profile info section -->
            <div class="col-lg-6 col-12 order-1 order-lg-2">
                 <!-- post 1 -->
                 <div class="card">
                    <div class="card-body">
                        <center>
                            <a href="{{ url('representant/dossiers/'.$dossier->id.'/consultations/index')}}" class="btn btn-outline-secondary"><i data-feather="clipboard"></i> Consultations</a>
                            <a href="{{ url('representant/dossiers/'.$dossier->id.'/examenbios/index')}}" class="btn btn-outline-secondary"><i data-feather="clipboard"></i> Examen bio</a>
                            <a href="{{ url('representant/dossiers/'.$dossier->id.'/examenradios/index')}}" class="btn btn-outline-secondary"><i data-feather="clipboard"></i> Examen radio</a>
                        </center>
                    </div>
                </div>
                <!--/ post 1 -->


                <!-- post 1 -->
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-start align-items-center mb-1">
                            <div class="profile-user-info">
                                <h3 class="mb-0"><b>Antécédents médicaux:</b></h3>
                            </div>
                        </div>
                        <p class="card-text">{!!$dossier->antecedants_med!!} </p>
                    </div>
                </div>
                <!--/ post 1 -->

                <!-- post 1 -->
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-start align-items-center mb-1">
                            <div class="profile-user-info">
                                <h3 class="mb-0"><b>Antécédents chirurgicaux:</b></h3>
                            </div>
                        </div>
                        <p class="card-text">{!!$dossier->antecedants_chirg!!} </p>
                    </div>
                </div>
                <!--/ post 1 -->


                <!-- post 1 -->
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-start align-items-center mb-1">
                            <div class="profile-user-info">
                                <h3 class="mb-0"><b>Antécédents familiaux:</b></h3>
                            </div>
                        </div>
                        <p class="card-text">{!!$dossier->antecedants_fam!!} </p>
                    </div>
                </div>
                <!--/ post 1 -->

                <!-- post 1 -->
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-start align-items-center mb-1">
                            <div class="profile-user-info">
                                <h3 class="mb-0"><b>Allergies:</b></h3>
                            </div>
                        </div>
                        <p class="card-text">{!!$dossier->allergies!!} </p>
                    </div>
                </div>
                <!--/ post 1 -->

                <!-- post 1 -->
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-start align-items-center mb-1">
                            <div class="profile-user-info">
                                <h3 class="mb-0"><b> Indicateur biologiques:</b></h3>
                            </div>
                        </div>
                        <p class="card-text">{!!$dossier->indicateur_bio!!} </p>
                    </div>
                </div>
                <!--/ post 1 -->

                <!-- post 1 -->
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-start align-items-center mb-1">
                            <div class="profile-user-info">
                                <h3 class="mb-0"><b>Traitements chroniques:</b></h3>
                            </div>
                        </div>
                        <p class="card-text">{!!$dossier->traitement_chr!!} </p>
                    </div>
                </div>
                <!--/ post 1 -->

               
            </div>
            <!--/ center profile info section -->

            <!-- right profile info section -->
            <div class="col-lg-3 col-12 order-3">
                <!-- suggestion -->
                <div class="card">
                    <div class="card-body">
                        <h1><b><u>Compléments d'informations</u></b></h1>
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
                <!--/ suggestion -->


                <!-- Categories -->
                <div class="blog-categories mt-3">
                    <h6 class="section-label">Categories</h6>
                    <div class="mt-1">
                        <div class="d-flex justify-content-start align-items-center mb-75">
                            <img src="../../../app-assets/images/sang.png" alt="avatar" height="40" width="40" />
                            <a href="javascript:void(0);">
                                <div class="blog-category-title text-body">Groupe sanguin: {{$dossier->groupe_sanguin}}</div>
                            </a>
                        </div>
                        <div class="d-flex justify-content-start align-items-center mb-75">
                            <img src="../../../app-assets/images/taille.png" alt="avatar" height="40" width="40" />
                            <a href="javascript:void(0);">
                                <div class="blog-category-title text-body">Taille: {{$dossier->taille}}</div>
                            </a>
                        </div>
                        <div class="d-flex justify-content-start align-items-center mb-75">
                            <img src="../../../app-assets/images/kg.png" alt="avatar" height="40" width="40" />
                            <a href="javascript:void(0);">
                                <div class="blog-category-title text-body">Poids: {{$dossier->poids}}</div>
                            </a>
                        </div>
                        <div class="d-flex justify-content-start align-items-center mb-75">
                            <img src="../../../app-assets/images/ta.png" alt="avatar" height="40" width="40" />
                            <a href="javascript:void(0);">
                                <div class="blog-category-title text-body">Tension artérielle: {{$dossier->ta}}</div>
                            </a>
                        </div>
                    </div>
                </div>
                <!--/ Categories -->

                <!-- polls card -->
                <div class="card">
                    <div class="card-body">
                        <h1 class="mb-1"><b><u>Création de dossier:</u></b></h1>
                        <!-- polls -->
                        <div class="profile-polls-info mt-2">
                            <!-- custom radio -->
                            <div class="d-flex justify-content-between">
                                <div class="custom-control custom-radio">
                                    <label class="custom-control-label" for="bestActorPoll1"><b>Crée le: </b></label>
                                </div>
                                <div class="text-right">{{date('d/m/Y',strtotime($dossier->created_at))}}</div>
                            </div>
                            <div class="d-flex justify-content-between">
                                <div class="custom-control custom-radio">
                                    <label class="custom-control-label" for="bestActorPoll1"><b>Mise à jour le: </b></label>
                                </div>
                                <div class="text-right">{{date('d/m/Y',strtotime($dossier->updated_at))}}</div>
                            </div>
                            <!--/ custom radio -->

                        </div>
                    </div>

                    <!--/ polls -->
                </div>
            </div>
            <!--/ polls card -->
        </div>
        <!--/ right profile info section -->
</div>

</section>
<!--/ profile info section -->
</div>
<!-- END: Content-->

@endsection
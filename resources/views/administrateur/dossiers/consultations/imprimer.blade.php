@extends('layouat.layaoutMedecin')

@section('contenu')

<body class="horizontal-layout horizontal-menu blank-page navbar-floating footer-static  " data-open="hover" data-menu="horizontal-menu" data-col="blank-page">
    <!-- BEGIN: Content-->
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <div class="invoice-print p-3">
                    <div class="d-flex justify-content-between flex-md-row flex-column pb-2">
                        <div>
                            <div class="d-flex mb-1">
                                <h3 class="text-primary font-weight-bold ml-1">DMP</h3>
                            </div>
                            <p class="mb-25">Adresse: Tunisie</p>
                            <p class="mb-25">E-mail: contact@dmp.com</p>
                            <p class="mb-0">Tel (+216) 11 11 11 11 </p>
                        </div>
                        <div class="mt-md-0 mt-2">
                            <h4 class="font-weight-bold text-right mb-1">INVOICE #3492</h4>
                            <div class="invoice-date-wrapper">
                                <span class="invoice-date-title">Date:</span>
                                <span class="font-weight-bold">{{$date}}</span>
                            </div>
                        </div>
                    </div>

                    <hr class="my-2" />
                    @foreach($dossier as $dossier)
                    <div class="row pb-2">
                        <div class="col-sm-4">
                            <img src="{{asset('/uploads/dossier/'.$dossier->image)}}" height="104" width="104" alt="User avatar" />
                        </div>
                        <div class="col-sm-4">
                            <h6 class="mb-1">Dossier Médical:</h6>
                            <p class="mb-25">ID: {{$dossier->idD}}</p>
                            <p class="mb-25">{{$dossier->id_patient}}</p>
                            <p class="mb-25">Sexe: {{$dossier->sexe}}</p>
                            <p class="mb-0">E-mail: {{$dossier->email}}</p>
                            <p class="mb-0">Tel: {{$dossier->tel}}</p>

                        </div>
                        <div class="col-sm-4 mt-sm-0 mt-2">
                            <p class="mb-25">Date et lieu de naissance: {{date('d/m/Y',strtotime($dossier->datenaissance))}} , {{$dossier->lieunaissance}}</p>
                            <p class="mb-25">Groupe sanguin: </b></h5>{{$dossier->groupe_sanguin}}</p>
                            <p class="mb-25">Taille: {{$dossier->taille}}</p>
                            <p class="mb-25">Poids: {{$dossier->poids}}</p>
                            <p class="mb-0">Profession: {{$dossier->profession}}</p>
                            <p class="mb-0">Adresse: {{$dossier->ville}} {{$dossier->pays}}</p>
                        </div>
                    </div>

                    <ul class="timeline">
                        @foreach($resultats as $c)
                        <li class="list-group-item">
                            <p class="font-weight-semibold mb-25">ID de consultation :</p>
                            <p class="text-muted text-nowrap">
                                {{$c->id}}
                            </p>
                        </li>
                        <li class="list-group-item">
                            <p class="font-weight-semibold mb-25">Date :</p>
                            <p class="text-muted text-nowrap">
                                {{date('d/m/Y',strtotime($c->date))}}
                            </p>
                        </li>
                        <li class="list-group-item">
                            <p class="font-weight-semibold mb-25">Motif :</p>
                            <p class="text-muted text-nowrap">
                                {{$c->motif}}
                            </p>
                        </li>
                        <li class="list-group-item">
                            <p class="font-weight-semibold mb-25">Taille :</p>
                            <p class="text-muted text-nowrap">
                                {{$c->taille}}
                            </p>
                        </li>
                        <li class="list-group-item">
                            <p class="font-weight-semibold mb-25">Poids :</p>
                            <p class="text-muted text-nowrap">
                                {{$c->poids}}
                            </p>
                        </li>
                        <li class="list-group-item">
                            <p class="font-weight-semibold mb-25">TA :</p>
                            <p class="text-muted text-nowrap">
                                {{$c->ta}}
                            </p>
                        </li>
                        <li class="list-group-item">
                            <p class="font-weight-semibold mb-25">Observation :</p>
                            <p class="text-muted text-nowrap">
                                {{$c->observation}}
                            </p>
                        </li>
                        <li class="list-group-item">
                            <p class="font-weight-semibold mb-25">Antécédant :</p>
                            <p class="text-muted text-nowrap">
                                {!!$c->effet_marquant_txt!!}
                            </p>
                        </li>
                        @if(!is_null($c->remarques))
                        <li class="list-group-item">
                            <p class="font-weight-semibold mb-25">Observation privée :</p>
                            <p class="text-muted text-nowrap">
                                {!!$c->observation_prive!!}
                            </p>
                        </li>
                        @endif
                        <li class="list-group-item">
                            <p class="font-weight-semibold mb-25"> Médecin :</p>
                            <p class="text-muted text-nowrap">
                                {!!$c->med!!}
                                @if(!is_null($c->remarques))
                                <a href="#" class="badge badge-danger">{{$c->remarques}}</a>
                                @endif
                            </p>
                        </li>
                        <li class="list-group-item">
                            <p class="font-weight-semibold mb-25">Crée le: :</p>
                            <p class="text-muted text-nowrap">
                                {{date('d/m/Y',strtotime($c->created_at))}}
                            </p>
                        </li>
                        <li class="list-group-item">
                            <p class="font-weight-semibold mb-25">Date :</p>
                            <p class="text-muted text-nowrap">
                                {{date('d/m/Y',strtotime($c->date))}}
                            </p>
                        </li>
                        <li class="list-group-item">
                            @if(!empty($files))
                            <p>Compléments d'informations:</p>
                            @foreach($files as $f)
                        <li class="list-group-item"><img src="{{public_path('uploads/consultation/'.$f->downloads)}}" width="400px;" height="400px;"></li>
                        @endforeach
                        @endif
                        </li>
                        <li class="list-group-item">
                            <span class="font-weight-bold">Crée le :</span> <span class="ml-75">{{date('d/m/Y',strtotime($dossier->created_at))}}</span>
                            <span class="font-weight-bold">Mis à jour le :</span> <span class="ml-75">{{date('d/m/Y',strtotime($dossier->updated_at))}}</span>
                        </li>
                        @endforeach
                    </ul>
                    @endforeach
                    <hr class="my-2" />

                    <div class="row">
                        <div class="col-12">
                            <span class="font-weight-bold">Note:</span>
                            <span>Merci pour votre visite !</span>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- END: Content-->


    <!-- BEGIN: Vendor JS-->
    <!--<script src="../../../app-assets/vendors/js/vendors.min.js"></script>-->
    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Page Vendor JS-->
    <!--<script src="../../../app-assets/vendors/js/ui/jquery.sticky.js"></script>-->
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="../../../app-assets/js/core/app-menu.js"></script>
    <script src="../../../app-assets/js/core/app.js"></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    <script src="../../../app-assets/js/scripts/pages/app-invoice-print.js"></script>
    <!-- END: Page JS-->

    <script>
        $(window).on('load', function() {
            if (feather) {
                feather.replace({
                    width: 14,
                    height: 14
                });
            }
        })
    </script>
</body>
@endsection
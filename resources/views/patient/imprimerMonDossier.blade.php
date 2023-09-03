@extends('layouat.layoutPatientPrint')

@section('contenu')

<body class="horizontal-layout horizontal-menu blank-page navbar-floating footer-static  " data-open="hover" data-menu="horizontal-menu" data-col="blank-page">
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
                            <p class="mb-25"><i data-feather="map-pin"></i> Adresse: Tunisie</p>
                            <p class="mb-25"><i data-feather="at-sign"></i> E-mail: contact@dmp.com</p>
                            <p class="mb-0"><i data-feather="phone"></i> Tel (+216) 11 11 11 11 </p>
                        </div>
                        <div class="mt-md-0 mt-2">
                            <h4 class="font-weight-bold text-right mb-1">INVOICE #3492</h4>
                            <div class="invoice-date-wrapper">
                                <span class="invoice-date-title">Date:</span>
                                <span class="font-weight-bold">{{$date}}</span>
                            </div>
                        </div>
                    </div>

                    @foreach($data as $d)
                    <div class="row">
                        <div class="col-sm-4">
                            <img src="{{asset('/uploads/dossier/'.$d->image)}}" height="104" width="104" alt="User avatar" />
                        </div>
                        <div class="col-sm-4">
                            <h6 class="mb-1">Dossier Médical:</h6>
                            <p class="mb-25">ID: {{$d->id}}</p>
                            <p class="mb-25">{{$d->id_patient}}</p>
                            <p class="mb-25">Sexe: {{$d->sexe}}</p>
                            <p class="mb-0"><i data-feather="at-sign"></i> E-mail: {{$d->email}}</p>
                            <p class="mb-0"><i data-feather="phone"></i> Tel: {{$d->tel}}</p>

                        </div>
                        <div class="col-sm-4 mt-sm-0 mt-2">
                            <p class="mb-25">Date et lieu de naissance: {{date('d/m/Y',strtotime($d->datenaissance))}} , {{$d->lieunaissance}}</p>
                            <p class="mb-25"><i data-feather="droplet"></i> Groupe sanguin: </b></h5>{{$d->groupe_sanguin}}</p>
                            <p class="mb-25">Taille: {{$d->taille}}</p>
                            <p class="mb-25">Poids: {{$d->poids}}</p>
                            <p class="mb-0">Profession: {{$d->profession}}</p>
                            <p class="mb-0"><i data-feather="map-pin"></i> Adresse: {{$d->ville}} {{$d->pays}}</p>
                        </div>
                        <div class="col-12">
                            <ul class="timeline">
                                <li class="list-group-item">
                                    <p class="font-weight-semibold mb-25"> <i data-feather="star"></i><b> Antécédents médicaux:</b></p>
                                    <p class="text-muted text-nowrap">
                                        {!!$d->antecedants_med!!}
                                    </p>
                                </li>
                                <li class="list-group-item">
                                    <p class="font-weight-semibold mb-25"> <i data-feather="star"></i><b> Antécédents chirurgicaux:</b></p>
                                    <p class="text-muted text-nowrap">
                                        {!!$d->antecedants_chirg!!}
                                    </p>
                                </li>
                                <li class="list-group-item">
                                    <p class="font-weight-semibold mb-25"> <i data-feather="star"></i><b> Antécédents familiaux:</b></p>
                                    <p class="text-muted text-nowrap">
                                        {!!$d->antecedants_fam!!}
                                    </p>
                                </li>
                                <li class="list-group-item">
                                    <p class="font-weight-semibold mb-25"> <i data-feather="star"></i><b> Allergies:</b></p>
                                    <p class="text-muted text-nowrap">
                                        {!!$d->allergies!!}
                                    </p>
                                </li>
                                <li class="list-group-item">
                                    <p class="font-weight-semibold mb-25"> <i data-feather="star"></i><b> Indicateur biologiques:</b></p>
                                    <p class="text-muted text-nowrap">
                                        {!!$d->indicateur_bio!!}
                                    </p>
                                </li>
                                <li class="list-group-item">
                                    <p class="font-weight-semibold mb-25"> <i data-feather="star"></i><b> Traitements chroniques:</b></p>
                                    <p class="text-muted text-nowrap">
                                        {!!$d->traitement_chr!!}
                                    </p>
                                </li>
                                <li class="list-group-item">
                                    <span class="font-weight-bold">Crée le :</span> <span class="ml-75">{{date('d/m/Y',strtotime($d->created_at))}}</span>
                                    <span class="font-weight-bold">, Mis à jour le :</span> <span class="ml-75">{{date('d/m/Y',strtotime($d->updated_at))}}</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                    @endforeach
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